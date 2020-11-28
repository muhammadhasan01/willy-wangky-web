<?php
header("Access-Control-Allow-Origin: *");
require_once("../models/transaction.php");
$transaction = new Transaction();
echo json_encode($transaction->get_all_transaction());
?>