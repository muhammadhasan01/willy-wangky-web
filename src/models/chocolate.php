<?php
require_once('config_db.php');

class Chocolate {
    private $db;
    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    }

    public function checkAddStock() {
        // select yang masih pending
        // tembak satu2 ke WS Factory
        // kalau approve, ubah di db dan tambah stock coklat
        $query = "SELECT id, id_chocolate, jumlah FROM add_stock WHERE status='PENDING'";
        $result = $this->db->query($query)->fetch_all();
        foreach ($result as $row) {
            $xml_data = "<Envelope xmlns=\"http://schemas.xmlsoap.org/soap/envelope/\">
            <Body>
                <checkStatus xmlns=\"http://service.willywangky/\">
                    <arg0 xmlns=\"\">".$row[0]."</arg0>
                </checkStatus>
            </Body>
            </Envelope>";
            $URL = "http://localhost:8081/api/stock?wsdl";

            $ch = curl_init($URL);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);

            if (preg_match('/<return>(.*?)<\/return>/',(string) $output, $match) == 1) {
                $status = (string)$match[1];
            }
            if (isset($status) and $status === "APPROVED"){
                $this->db->query("UPDATE add_stock SET status='APPROVED' WHERE id=$row[0]");
                $this->add_amount_by_id($row[1], $row[2]);
            }
        }
    }
    /*
    Mengembalikan semua coklat terurut berdasarkan sold amount
    hasil : matriks 
        0    1    2     3     4       5           6
        id name price amount sold description file_name
    obj->get_all()[0][6] : mengembalikan row pertama kolom file_name
    */
    public function get_all(){
        $query = "SELECT * FROM chocolate ORDER BY sold DESC";
        $result = $this->db->query($query);
        // if ($result->num_rows != 0){
        return ($result->fetch_all());
        // } else {
        //     return "Chocolate is empty";
        // }
    }

    // Mengembalikan detail coklat berdasar id
    public function get_by_id($id){
        $query = "SELECT * FROM chocolate WHERE id=$id";
        $result = $this->db->query($query);
        // echo var_dump($result);
        if (!empty($result) && $result->num_rows > 0){
            return ($result->fetch_all());
        } else {
            return false;
        }
    }

    public function get_choco_name_by_id($id){
        $query = "SELECT name FROM chocolate WHERE id=$id";
        return $this->db->query($query)->fetch_all()[0][0];
    }

    // mengembalikan semua coklat hasil search
    public function search($search_key){
        $query = "SELECT * FROM chocolate WHERE name LIKE '%$search_key%'";
        $result = $this->db->query($query);
        if ($result->num_rows != 0){
            return ($result->fetch_all());
        } else {
            return "No result.";
        }
    }

    // memasukkan chocolate baru
    public function insert($name, $price, $amount, $description, $file_name){
        $query = "INSERT INTO chocolate(name, price, amount, description, file_name)
                    VALUES('$name', $price, $amount, '$description', '$file_name')";
        if ($this->db->query($query) === TRUE){
            return true;
        } else {
            return false;
        }
    }

    // menambahkan stock
    public function add_amount_by_id($id, $amount){
        $query = "UPDATE chocolate SET amount = amount + $amount WHERE id = $id";
        if ($this->db->query($query) === TRUE){
            return "Penambahan stok berhasil.";
        } else {
            return "Penambahan stok gagal.";
        }
    }

    // fungsi untuk menjual (menambah jumlah terjual dan mengurangi jumlah stok)
    public function sell($id, $amount_sold){
        $query = "UPDATE chocolate SET amount = amount - $amount_sold, sold = sold + $amount_sold WHERE id = $id";
        if ($this->db->query($query) === TRUE){
            return true;
        } else {
            return false;
        }
    }
}
?>