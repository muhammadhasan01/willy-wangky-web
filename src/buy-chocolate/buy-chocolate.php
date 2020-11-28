<?php
ob_start();
require_once('../models/transaction.php');
require_once('../models/user.php');

$username = $_COOKIE["username"];

$user = new User();
$id_user = $user->get_user_id($username);
$address = $_POST["address"];
$id_chocolate = $_POST["id"];
$amount = (int)$_POST["amount"];

if ($id_user){
    // $buy_msg = "Pembelian sukses";
    $transaction = new Transaction();
    $buy_msg = $transaction->buy($id_user, $id_chocolate, $amount, $address);
} else {
    $buy_msg = "Transaksi gagal.";
}

header("location: ../dashboard/dashboard.php?buy_msg=".$buy_msg . $amount);

?>