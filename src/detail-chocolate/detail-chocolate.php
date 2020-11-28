<?php 
    include("../cookie-check/cookie-check.php");
    include('../../components/navbar/navbar.php');
    $id = $_GET['id'];
    $user = new User();
    if ($user->get_role($_COOKIE["username"]) == "SUPER_USER"){
        header("location: ./detail-chocolate-su.php?id=$id");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Chocolate</title>
    <link rel="stylesheet" href="../../public/styles/global-style.css">
    <link rel="stylesheet" href="detail-chocolate.css">
<body>
    <?php
        
        require_once('../models/chocolate.php');
        $chocolate = new Chocolate();
        $result = $chocolate->get_by_id($id);
        if ($result){
            // echo var_dump($result[0][3]);
            $name = $result[0][1];
            $price = $result[0][2];
            $amount = $result[0][3];
            $sold = $result[0][4];
            $description = $result[0][5];
            $filename = $result[0][6];
        } else {
            echo "Chocholate not found";
        }
    ?>
    <br><br>
    
    <p class="title"><?php echo $name?></p>
    
    <form id="input-data" action="../buy-chocolate/buy-chocolate.php" method='POST'> 
        <div class="card">
            <img src="../../public/images/<?php echo $filename;?>"></img>
            <div class="details">
                <p class="amount">Amount sold: <?php echo $sold;?></p>
                <p class="price">Price: Rp <?php echo $price;?>,00</p>
                <p class="amount">Amount remaining: <?php echo $amount;?></p>
                <p class="desc">
                    Description:<br/><?php echo $description;?>
                </p>
                <table class="buy-form">
                    <tr>
                        <th> Amount to buy :</th>
                        <th style="padding-left: 20px;"> Price :</th>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" href="" onclick="subtractAmount()">-</button>
                            <input style="width: 50px;" id="amount" name="amount" type="number" value="1" readonly>
                            <button type="button" href="" onclick="addAmount()">+</button>
                        </td>
                        <td style="padding-left: 20px;">Rp.<span id="choco-price"><?php echo $price?></span></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="container buy-form">
            <label for="address"> Address :</label> <br>
            <textarea name="address" id="address" cols="30" rows="10" required></textarea>
            <input type="hidden" value="<?php echo $id?>" name="id">
        </div>
        <div class="buy-form container">
            <button class="buttons" >Buy</button>
            <button type="button" class="buttons" onclick="hideForm()">Cancel</button>
        </div>
        <div class="buy container">
            <button id="buy-now-button" type="button" class="buttons" onclick="showForm()">Buy Now</button>
        </div>
    </form>


    <script>
        window.onload = function(){
            if (Number(<?php echo $amount?>) == 0){
                document.getElementById("buy-now-button").disabled = true;
                document.getElementById("buy-now-button").innerHTML = "Out of Stock";
                document.getElementById("buy-now-button").style.background = "grey";
            }
        };
        
        function showForm(){
            var temp2 = document.getElementsByClassName("buy");
            for (let div2 of temp2){
                div2.style.display = "none";
            }
            var form_div = document.getElementsByClassName("buy-form");
            for (let div of form_div){
                div.style.display = "block";
            }
        }

        function hideForm(){
            var form_div = document.getElementsByClassName("buy");
            for (let div of form_div){
                div.style.display = "block";
            }
            var temp2 = document.getElementsByClassName("buy-form");
            for (let div2 of temp2){
                div2.style.display = "none";
            }
        }

        function addAmount(){
            var update = Number(document.getElementById("amount").value) + 1;
            if (Number(<?php echo $amount?>) >= update){
                document.getElementById("amount").value = update;
            }
            updatePrice();
        }

        function subtractAmount(){
            if (Number(document.getElementById("amount").value) > 1){
                document.getElementById("amount").value = Number(document.getElementById("amount").value) - 1;
            }
            updatePrice();
        }

        function updatePrice(){
            document.getElementById("choco-price").textContent = Number(document.getElementById("amount").value) * Number(<?php echo $price?>);
        }
    </script>
</body>
</html>