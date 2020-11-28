<?php
require_once("../cookie-check/cookie-check.php");
include('../../components/navbar/navbar.php');
?>

<!DOCTYPE html>
<!-- <style><?php include '../../public/styles/main.bundle.css'?></style> -->
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

            if (isset($_POST["subm"])) {
                $allowed_extensions = array('png', 'jpg');
                if (isset($_POST["name"]) and isset($_POST["price"]) and isset($_POST["description"])) {
                    $name = $_POST["name"];
                    $price = (int)$_POST["price"];
                    $description = $_POST["description"];
                    // $amount = $_POST["amount"];

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
                        if ($chocolate->insert($name, $price, 0, $description, $file_name_in_db)) {
                            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                            echo '<p class="successful-upload">Successfully uploaded</p>';
                        }
                    }
                } else {
                    echo '<p class="fail-upload">An error occurred</p>';
                }
            } else {
                // echo '<p class="fail-upload">No submit detected</p>';
            }

        ?>
        <h1>Add New Chocolate</h1>
        <form action="new-chocolate.php" method="POST" enctype="multipart/form-data" class="add-chocolate-form" id="form-gila">
            <div class="text-input">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <!-- TODO: request bahan material dari web supplier buat dijadiin resep coklat -->
            <div class="text-input">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" required>
            </div>
            <div class="text-input">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" required></textarea>
            </div>
            <div class="text-input">
                <label for="image">Image</label>
                <input type="file" name="image" id="image">
            </div>
            <button type="button" class="btn btn-light" id="tambah-bahan">Tambah Bahan</button>
            <button type="button" class="btn btn-light" id="hapus-bahan">Hapus Bahan</button>
            <input type="hidden" name="subm" value="subm">
            <button type="button" value="Add Chocolate" id="button-submit">Submit</button>
            <button type="submit" id="button-bodoh" style="visibility: hidden;" />
        </form>
    </div>
    <script src="../../public/js/new-chocolate.js"></script>
</body>
</html>