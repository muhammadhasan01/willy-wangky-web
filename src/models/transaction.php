<?php
require_once('config_db.php');
require_once('chocolate.php');

class Transaction {
    private $db;

    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    }

    public function add_stock($id_transaction, $id_chocolate, $amount){
        $query = "INSERT INTO add_stock(id, id_chocolate, jumlah) VALUES($id_transaction, $id_chocolate, $amount)";
        if ($this->db->query($query)){
            return "Add Stock berhasil dicatat di database";
        } else {
            return "Add Stock gagal dicatat di database";
        }
    }

    // mengembalikan semua transaksi urut berdasar tanggal beli (paling baru diatas)
    public function get_all_by_id_user($id_user){
        // select * from 
        $query = "SELECT name, transaction.amount, total_price, date(time) as date, time(time) as time, address
                    FROM transaction join chocolate
                    WHERE id_chocolate = chocolate.id AND id_user = $id_user
                    ORDER BY date DESC";
        return $this->db->query($query)->fetch_all();
    }

    public function get_all_transaction(){
        $query = "SELECT username, name, transaction.amount, total_price, address, time  
        from (transaction inner join user on transaction.id_user=user.id) inner join chocolate on chocolate.id=transaction.id_chocolate order by time desc";
        return $this->db->query($query)->fetch_all();
    }
    
    // fungsi untuk transaksi , memperbaharui stok dan mencatat history transaksi
    public function buy($id_user, $id_chocolate, $amount, $address){
        $chocolate_info_query = "SELECT amount, price FROM chocolate where id = $id_chocolate";
        $res = $this->db->query($chocolate_info_query)->fetch_all();
        $stock = (int) $res[0][0];
        $price = (int) $res[0][1];
        echo $stock . "\n";
        echo $price . "\n";
        if ($stock < $amount){
            return "Stok tidak mencukupi\n";
        } else {
            $chocolate = new Chocolate();
            // update amount coklat
            $chocolate->sell($id_chocolate, $amount);
            $total_price = $amount * $price;
            // tambahkan histori transaksi
            $query = "INSERT INTO transaction(id_user, id_chocolate, amount, total_price, address) 
                    VALUES($id_user, $id_chocolate, $amount, $total_price, '$address')";

            //upade saldo ws factory
            $res = $this->add_saldo($total_price);
            if ($this->db->query($query)){
                return "Transaksi berhasil. ".$res;
            } else {
                return "Transaksi gagal".$res;
            }
        }
    }

    public function add_saldo($total_price){
        $xml_data = "<Envelope xmlns=\"http://schemas.xmlsoap.org/soap/envelope/\">
                        <Body>
                            <addSaldo xmlns=\"http://service.willywangky/\">
                                <arg0 xmlns=\"\">$total_price</arg0>
                            </addSaldo>
                        </Body>
                    </Envelope>";
        $URL = "http://localhost:8081/api/saldo";

        $ch = curl_init($URL);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}


// Test
// $cek = new Transaction();
// $cek->buy(1,2,10, "DIY");

?>