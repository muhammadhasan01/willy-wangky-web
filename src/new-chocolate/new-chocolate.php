<?php
require_once("../cookie-check/cookie-check.php");
include('../../components/navbar/navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Chocolate</title>
    <link rel="stylesheet" href="../../public/styles/global-style.css">
    <link rel="stylesheet" href="new-chocolate.css">
</head>
<body>
    <div class="container">
        <?php
            require_once('../models/chocolate.php');
            $chocolate = new Chocolate();

            if (isset($_POST["submit"])) {
                $allowed_extensions = array('png', 'jpg');
                if (isset($_POST["name"]) and isset($_POST["price"]) and isset($_POST["description"]) and isset($_POST["amount"])) {
                    $name = $_POST["name"];
                    $price = (int)$_POST["price"];
                    $description = $_POST["description"];
                    $amount = $_POST["amount"];

                    $file_extension = strtolower(pathinfo($_FILES["image"]["name"])["extension"]);
                    // $target_file = "../../public/images/" . basename($_FILES["image"]["name"]);
                    if (!in_array($file_extension, $allowed_extensions)) {
                        echo '<p class="fail-upload">Please upload an image of type JPG or PNG</p>';
                    } else {
                        $file_name_in_db = pathinfo($_FILES["image"]["name"])["filename"] . "-" . strval(random_int(0, 99)) . "." . $file_extension;
                        $target_file = "../../public/images/" . $file_name_in_db;
                        while (file_exists($target_file)) {
                            $file_name_in_db = pathinfo($_FILES["image"]["name"])["filename"] . "-" . strval(random_int(0, 99)) . "." . $file_extension;
                            $target_file = "../../public/images/" . $file_name_in_db;
                        }
                        if ($chocolate->insert($name, $price, $amount, $description, $file_name_in_db)) {
                            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                            echo '<p class="successful-upload">Successfully uploaded</p>';
                        }
                    }
                } else {
                    echo '<p class="fail-upload">An error occurred</p>';
                }
            }

        ?>
        <h1>Add New Chocolate</h1>
        <form action="new-chocolate.php" method="POST" enctype="multipart/form-data" class="add-chocolate-form">
            <div class="text-input">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="text-input">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" required>
            </div>
            <div class="text-input">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" required></textarea>
            </div>
            <div class="text-input">
                <label for="amount">Amount</label>
                <input type="number" name="amount" id="amount" required>
            </div>
            <div class="text-input">
                <label for="image">Image</label>
                <input type="file" name="image" id="image">
            </div>
            <input type="hidden" name="submit" value="submit">
            <input type="submit" value="Add Chocolate">
        </form>
    </div>
</body>
</html>