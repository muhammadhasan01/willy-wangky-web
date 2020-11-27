<?php
require_once('config_db.php');
require_once('chocolate.php');

class Transaction {
    private $db;

    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
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
            if ($this->db->query($query)){
                return "Transaksi berhasil";
            } else {
                return "Transaksi gagal";
            }
        }
    }
}

// Test
// $cek = new Transaction();
// $cek->buy(1,2,10, "DIY");

?>