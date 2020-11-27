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
    <link rel="stylesheet" href="search-result.css">
    <title>Search Result</title>
</head>
<body>
    <div class="container">
        <div class="pagination">
            <p class="page" id="1">1</p>
        </div>
        <?php
            $Chocolate = new Chocolate();
            if (isset($_GET["name"])) {
                $name = $_GET["name"];
                if ($name !== false) {
                    $search_result = $Chocolate->search($name);
                    // print_r($search_result);
                    if ($search_result != "No result.") {
                        $result_length = count($search_result);
                        for ($i = 0; $i < $result_length; $i++) {
                            $choco_id = $search_result[$i][0];
                            $choco_name = $search_result[$i][1];
                            $price = $search_result[$i][2];
                            $amount_remaining = $search_result[$i][3];
                            $amount_sold = $search_result[$i][4];
                            $description = $search_result[$i][5];
                            $image_path = $search_result[$i][6];
                            include('../../components/card/search-result-card.php');
                        }
                    } else {
                        echo $search_result;
                    }
                }
            }
        ?>
    </div>
    <script src="../../public/js/search-result.js"></script>
</body>
</html>
