<?php
require_once("../cookie-check/cookie-check.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../../public/styles/global-style.css">
    <link rel="stylesheet" href="../../public/styles/register.css">
</head>
<body>
    <div class="login-container">
        <div class="title">
            <h1>Willy Wangky</h1>
            <h2>Choco Factory</h2>
            <br><br><br><br>
            <p>Anda mungkin sudah tahu mengenai pabrik coklat terbesar seantero dunia, Willy Wangky. Akan tetapi, produsen terbaik tidak akan sukses tanpa konsumen dan distributor terbaik. Sebab coklat dari Willy Wangky sangat disenangi konsumen, maka Willy Wangky membutuhkan distributor yang handal dalam menangani penjualan coklat. Untungnya, Willy Wangky mengenal Jan. Jan sudah sangat pengalaman dengan distribusi makanan dan minuman ringan. Bahkan, Jan sudah memiliki usaha sendiri bernama Jan’s Cook.</p>
        </div>
        <div class="login-card">
            <div class="box">
                <h2>Register</h2>
            </div>
            <div class="box">
                <p class="fail-upload" id="fail-upload"></p>
                <?php
                    if (isset($_POST["username"]) and isset($_POST["email"]) and isset($_POST["password"]) and isset($_POST["confirm-password"])) {
                        $user_model_path = "../models/user.php";
                        require_once($user_model_path);
                        $User = new User();

                        $username = $_POST["username"];
                        $email = $_POST["email"];
                        $password = $_POST["password"];
                        $confirmpassword = $_POST["confirm-password"];
                        if ($password == $confirmpassword) {
                            $search_user = $User->get_user_id($username);
                            if ($search_user !== false) {
                                echo "<p>Your username is already registered.</p>";
                            } else {
                                if ($User->insert_user($username, $password, $email)) {
                                    setcookie("username", $username, time() + (86400 * 30), "/"); // 30 hari, "/" artinya cookie buat seluruh website
                                    setcookie("role","USER", time() + (86400 * 30), "/"); 
                                    header("Location: ./dashboard/dashboard.php");
                                    exit();
                                } else {
                                    echo "<p>An error occured while we were registering your account. Pls try again.</p>";
                                }
                            }
                        } else {
                            // echo "<p>Complete all the fields</p>";
                        }
                    } else {
                        // echo "<p>Complete all the fields</p>";
                    }
                ?>
            </div>
            <div class="box">
                <form action="register.php" method="POST" class="column-flex" id="register-form">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username">
    
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
    
                    <label for="password">Password</label>
                    <input type="text" id="password" name="password">
                    
                    <label for="confirm-password">Confirm Password</label>
                    <input type="text" id="confirm-password" name="confirm-password">

                    <div class="buttons row-flex">
                        <a href="../login/login.php">Login</a>
                        <input type="button" value="Register" id="register-button">
                    </div>
                </form>
            </div>
        </div>  
    </div>
    <div class="background">&dbsp</div>

    <script src="../../public/js/register.js"></script>
</body>
</html>