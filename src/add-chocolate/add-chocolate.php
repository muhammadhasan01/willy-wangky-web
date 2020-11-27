<?php

require_once('../models/chocolate.php');

$id_chocolate = $_POST["id"];
$amount = $_POST["amount"];

$chocolate = new Chocolate();
$add_stock_msg = $chocolate->add_amount_by_id($id_chocolate, $amount);

header("location: /src/dashboard/dashboard.php?buy_msg=".$add_stock_msg);

?>