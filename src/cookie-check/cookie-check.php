<?php
require_once("../models/user.php");

class CookieChecker {
    public function __construct() {
        // nggatau mau construct apa
    }

    public function check_cookie_exists() {
        if (isset($_COOKIE["username"]) and isset($_COOKIE["role"])) {
            $username = $_COOKIE["username"];
            $role = $_COOKIE["role"];
            return array("username" => $username, "role" => $role);
        } else {
            return false;
        }
    }
}

$username = "";
$role = "";

// langsung jalanin disini aja ya?
$CookieChecker = new CookieChecker();
$cookie_dict = $CookieChecker->check_cookie_exists();
if (!$cookie_dict and (strpos($_SERVER['REQUEST_URI'], 'login') === false and strpos($_SERVER['REQUEST_URI'], 'register') === false)) {
    header('Location: /src/login/login.php');
    exit();
} else if ($cookie_dict) {
    if ($cookie_dict["username"]) {
        $username = $cookie_dict["username"];
    }
    if ($cookie_dict["role"]) {
        $role = $cookie_dict["role"];
        if (strpos($_SERVER['REQUEST_URI'], 'add-chocolate') !== false and $role !== "SUPER_USER") {
            header('Location: /src/404/404.php');
            exit();
        }
    }
    if (strpos($_SERVER['REQUEST_URI'], 'login') !== false or strpos($_SERVER['REQUEST_URI'], 'register') !== false) {
        header('Location: /src/dashboard/dashboard.php');
        exit();
    }
}

?>