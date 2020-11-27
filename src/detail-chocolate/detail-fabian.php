<?php
require_once('../cookie-check/cookie-check.php');
include('../../components/navbar/navbar.php');
require_once('../models/chocolate.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/styles/global-style.css">
    <link rel="stylesheet" href="detail-fabian.css">
    <title>Chocolate Detail</title>
</head>
<body>
    <?php
        $id = $_GET["id"];
        $chocolate = new Chocolate();
        $chocolate_details = $chocolate->get_by_id($id)[0];
        $name = $chocolate_details[1];
        $price = $chocolate_details[2];
        $amount = $chocolate_details[3];
        $amount_sold = $chocolate_details[4];
        $description = $chocolate_details[5];
        $image_path = $chocolate_details[6];
    ?>
    <div class="container">
        <h1><?php echo $name; ?></h1>
        <div class="content">
            <div class="image">
                <div class="chocolate-image"
                    style="background-image: url('<?php echo "../../public/images/" . $image_path; ?>');"
                >&nbsp</div>
            </div>
            <div class="chocolate-details">
                <p class="non-description">Amount sold: <span><?php echo $amount_sold; ?></span></p>
                <p class="non-description">Price: <span>Rp <?php echo $price; ?>,00</span></p>
                <p class="non-description">Amount: <span><?php echo $amount; ?></span></p>
                <p class="non-description">Description: </p>
                <p class="description">
                    <?php echo $description; ?>
                </p>                
            </div>
        </div>
    </div>
    <div class="container-button">
        <div class="buy-button-container">
            <a href="../buy-chocolate/buy-chocolate.php">
                <input type="button" value="Buy Now">
            </a>
        </div>
    </div>
</body>
</html>