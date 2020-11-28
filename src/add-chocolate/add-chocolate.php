<?php

require_once('../models/chocolate.php');
require_once('../models/transaction.php');

$id_chocolate = $_POST["id"];
$amount = $_POST["amount"];

$chocolate = new Chocolate();
$chocolate_name = ($chocolate->get_choco_name_by_id($id_chocolate));
// $add_stock_msg = $chocolate->add_amount_by_id($id_chocolate, $amount);

// request add chocolate ke ws factory
// add data ke add_stock dengan id yang didapat dari dari ws factory

$xml_data = "<Envelope xmlns=\"http://schemas.xmlsoap.org/soap/envelope/\">
            <Body>
                <addStock xmlns=\"http://service.willywangky/\">
                    <arg0 xmlns=\"\">".$chocolate_name."</arg0>
                    <arg1 xmlns=\"\">".$amount."</arg1>
                </addStock>
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
    $id_transaction = (int)$match[1];
}

if ((int)$output >= 0){
    $transaction = new Transaction();
    $msg = $transaction->add_stock($id_transaction, $id_chocolate, $amount);
    $msg = "Menunggu approval dari pabrik.  ".$msg;
} else {
    $msg = "Add stock gagal";
}

header("location: ../dashboard/dashboard.php?buy_msg=".$msg);

?>