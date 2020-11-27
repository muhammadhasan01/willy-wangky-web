<?php 
    include("../cookie-check/cookie-check.php");
    include('../../components/navbar/navbar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/styles/global-style.css">
    <link rel="stylesheet" href="detail-zunan.css">
    <title>Document</title>
<body>
    <?php
        $id = $_GET['id'];
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
    <style><?php include 'detail-chocolate.css';?></style>
    
    <p class="title">Choco Name 1</p>
    
    <form id="input-data" action=""> 
        <div class="card">
            <img src="../../public/images/<?php echo $filename;?>"></img>
            <div class="details">
                <p class="price">Price: Rp <?php echo $price;?>,00</p>
                <p class="amount">Amount remaining: <?php echo $amount;?></p>
                <p class="desc">
                    Description:<br/><?php echo $description;?>
                </p>
                <table class="buy-form">
                    <tr>
                        <th> Amount to buy :</th>
                        <th> Price :</th>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" href="" onclick="subtractAmount()">-</button>
                            <input id="amount" name="amount" type="number" value="0" readonly>
                            <button type="button" href="" onclick="addAmount()">+</button>
                        </td>
                        <td>Rp.<span id="choco-price">0</span></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="container buy-form">
            <label for="address"> address </label> <br>
            <textarea name="address" id="address" cols="30" rows="10"></textarea>
        </div>
        <div class="buy-form container">
            <button class="buttons" >Buy</button>
            <button type="button" class="buttons" onclick="hideForm()">Cancel</button>
        </div>
        <div class="buy container">
            <button type="button" class="buttons" onclick="showForm()">Buy Now</button>
        </div>
    </form>


    <script>
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
            document.getElementById("amount").value = Number(document.getElementById("amount").value) + 1;
            updatePrice();
        }

        function subtractAmount(){
            if (Number(document.getElementById("amount").value) > 0){
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