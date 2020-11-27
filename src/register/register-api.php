<?php
require_once("../models/user.php");

$User_register = new User();

if (isset($_GET["email"]) and isset($_GET["username"])) {
    $email = $_GET["email"];
    $username = $_GET["username"];
    $result = $User_register->get_user_id_by_email($email);
    $result_2 = $User_register->get_user_id($username);
    if ($result === false and $result_2 === false) {
        echo "ok";
    } else {
        echo "not_ok";
    }
} else {
    echo "not_ok";
}

?>