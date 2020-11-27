<?php 
include("../cookie-check/cookie-check.php");
include('../../components/navbar/navbar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../public/styles/global-style.css">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="container">
        <div class="topleft">Hello <?php echo $username; ?></div>
        <a class="topright" id="view-all-chocolates">View less chocolates</a>
        <!-- TODO: Show Chocolates !-->
        <p style="color: blue; text-align: center;" id="buy-msg">
            <?php 
                if (isset($_GET["buy_msg"])){
                    $buy_msg = $_GET["buy_msg"];
                    echo "$buy_msg";
                }
                if (isset($_GET["add_stock_msg"])){
                    $add_stock_msg = $_GET["add_stock_msg"];
                    echo "$add_stock_msg";
                }
            ?> 
        </p>
        <table class="showcase-products">
            <?php 
                require_once('../models/chocolate.php');
                $chocolate = new Chocolate();
                $all_chocolates = $chocolate->get_all();
                if (empty($all_chocolates)) {
                    echo "<tr><td>We're out of Chocolates :(</td></tr>";
                } else {
                    $amount_of_chocolates = count($all_chocolates);
                    $rows = ceil($amount_of_chocolates / 5);
                    
                    for ($row = 0; $row < $rows; $row++) {
                        echo "<tr>";
                        $columns = 0;
                        if ($row == $rows - 1) {
                            $columns = $amount_of_chocolates % 5;
                            if ($columns === 0) {
                                $columns = 5;
                            }
                        } else {
                            $columns = 5;
                        }

                        for ($col = 0; $col < $columns; $col++) {
                            echo "<td>";
                            include '../../components/card/product-card.php';
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                }
            ?>
        </table>
    </div>

    <script>
        setTimeout(function(){
            document.getElementById("buy-msg").style.display = "none"
        }, 3000);
        document.getElementById("view-all-chocolates").addEventListener("click", function() {
            var choco_table = document.querySelector("tbody")
            if (choco_table) {
                if (this.innerText.includes("all")) {
                    this.innerText = "View less chocolates"
                } else {
                    this.innerText = "View all chocolates"
                }
                var choco_table_children = document.querySelector("tbody").children;
                if (choco_table_children.length > 2) {
                    for (var i = 2; i < choco_table_children.length; i++) {
                        if (choco_table_children[i].style.display !== "") {
                            choco_table_children[i].style["display"] = "";
                        } else {
                            choco_table_children[i].style["display"] = "none";
                        }
                    }
                }
            }
        })
        document.getElementById("view-all-chocolates").click();
    </script>
</body>
</html>