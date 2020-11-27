<?php
require_once("../models/user.php");

$User_register = new User();

if (isset($_GET["email"]) and isset($_GET["password"])) {
    $email = $_GET["email"];
    $password = $_GET["password"];
    $result = $User_register->get_user_by_email($email, $password);
    if ($result !== false) {
        echo "ok";
    } else {
        echo "not_ok";
    }
} else {
    echo "not_ok";
}

?>