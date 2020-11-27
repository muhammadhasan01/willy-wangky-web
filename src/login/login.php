<?php
require_once("../cookie-check/cookie-check.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../public/styles/global-style.css">
    <link rel="stylesheet" href="../../public/styles/register.css">
</head>
<body>
    <div class="login-container">
        <div class="title">
            <h1>Willy Wangky Web</h1>
            <br><br>
            <p>Anda mungkin sudah tahu mengenai pabrik coklat terbesar seantero dunia, Willy Wangky. Akan tetapi, produsen terbaik tidak akan sukses tanpa konsumen dan distributor terbaik. Sebab coklat dari Willy Wangky sangat disenangi konsumen, maka Willy Wangky membutuhkan distributor yang handal dalam menangani penjualan coklat. Untungnya, Willy Wangky mengenal Jan. Jan sudah sangat pengalaman dengan distribusi makanan dan minuman ringan. Bahkan, Jan sudah memiliki usaha sendiri bernama Jan’s Cook.</p>
        </div>
        <div class="login-card">
            <div class="box">
                <h2>Login</h2>
            </div>
            <div class="box">
                <p class="fail-upload" id="fail-upload"></p>
                <?php
                    if (isset($_POST["email"]) and isset($_POST["password"])) {
                        $user_model_path = "../models/user.php";
                        require_once($user_model_path);
                        $User = new User();

                        $email = $_POST["email"];
                        $password = $_POST["password"];
                        $result = $User->get_user_by_email($email, $password);
                        if ($result) {
                            $role = $result[0][3];
                            $username = $result[0][1];
                            // echo $role;
                            setcookie("username", $username, time() + (86400 * 30), "/"); // 30 hari, "/" artinya cookie buat seluruh website
                            setcookie("role", $role, time() + (86400 * 30), "/"); 
                            header("Location: /src/dashboard/dashboard.php");
                            exit();
                        } else {
                            // echo "<p>Enter the correct uname and password</p>";
                        }
                    } else {
                        // echo "<p>Enter your username and password</p>";
                    }
                ?>
            </div>
            <div class="box">
                <form action="login.php" method="post" class="column-flex" id="login-form">
                    <!-- <label for="username">Username</label>
                    <input type="text" id="username" name="username"> -->

                    <label for="email">Email</label>
                    <input type="text" id="email" name="email">
    
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    
                    <div class="buttons row-flex">
                        <a href="../register/register.php">Register</a>
                        <input type="button" value="Login" id="login-button">
                    </div>
                </form>
            </div>
        </div>  
    </div>
    <div class="background">&dbsp</div>

    <script src="../../public/js/login.js"></script>
</body>
</html>