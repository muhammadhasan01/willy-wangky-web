<?php
require_once('config_db.php');

class User{
    private $db;
    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    }


    // insert new user
    public function insert_user($username, $password, $email){
        $query = "INSERT INTO user(username, password, email, role) 
                    VALUES('$username', '$password', '$email', 'USER')";
        if ($this->db->query($query) === TRUE){
            return true;
        } else {
            return false;
        }
    }

    public function get_user_id($username){
        $query = "SELECT id FROM user WHERE username = '$username'";
        $result = $this->db->query($query);
        if ($result->num_rows != 0){
            return ($result->fetch_all()[0][0]);
        } else {
            return false;
        }
    }

    public function get_user_id_by_email($email){
        $query = "SELECT id FROM user WHERE email = '$email'";
        $result = $this->db->query($query);
        if ($result->num_rows != 0){
            return ($result->fetch_all()[0][0]);
        } else {
            return false;
        }
    }

    // return user (id, username, email, role)
    public function get_user($username, $password){
        $query = "SELECT id, username, email, role FROM user
                    WHERE username='$username' and password='$password'";
        $result = $this->db->query($query);
        if ($result->num_rows != 0){
            return ($result->fetch_all());
        } else {
            return false;
        }
    }

    // return user (id, username, email, role)
    public function get_user_by_email($email, $password) {
        $query = "SELECT id, username, email, role FROM user
                    WHERE email='$email' and password='$password'";
        $result = $this->db->query($query);
        if ($result->num_rows != 0){
            return ($result->fetch_all());
        } else {
            return false;
        }
    }

    # get role from username
    public function get_role($username){
        $query = "SELECT role FROM user
                    WHERE username='$username'";
        $result = $this->db->query($query);
        if ($result->num_rows != 0){
            return ($result->fetch_all()[0][0]);
        } else {
            return "User not found";
        }
    }
}

//Test
// $cek = new User();
// $cek -> insert_user("zunan", "zunan", "zunanalfikri@gmail.com");
// if ($cek->get_user('zunan', 'zunan')){
//     echo "ada";
// } else {
//     echo "gaada";
// }

?>