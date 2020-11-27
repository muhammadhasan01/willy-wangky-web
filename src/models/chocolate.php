<?php
require_once('config_db.php');

class Chocolate {
    private $db;
    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
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
// Test
// $cek = new Chocolate();
// echo "lalalal";
// $cek->get_by_id(1);
// ($cek->sell(3,4))
?>