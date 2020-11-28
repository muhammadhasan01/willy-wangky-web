<?php
    $uri = $_SERVER['REQUEST_URI'];
    ob_start();
?>
<style><?php include 'navbar.css'?></style>
<div class="topnav">
    <a class="<?php if (strpos($uri, 'dashboard')!==false) {echo "active";}?>" href="../../index.php">Home</a>
    <!-- TODO: Handle User and Superuser -->
    <?php
        require_once("../../src/models/user.php");
        $user = new User();
        $role = $user->get_role($_COOKIE["username"]);
    ?>

    <?php if($role == "USER") : ?>
        <a <?php if (strpos($uri, 'transaction-history')!==false){echo "class='active'";}?> href="../../src/transaction-history/transaction-history.php">History</a>
    <?php elseif($role == "SUPER_USER") : ?>
        <a <?php if (strpos($uri, 'new-chocolate')!==false){echo "class='active'";}?> href="../../src/new-chocolate/new-chocolate.php">Add New Chocolate</a>
    <?php endif; ?>
    <input type="text" placeholder="Search" id="search-bar">
    <input type="button" value="" id="search-button">
    <div class="topnav-right">
        <form action="../../components/navbar/navbar.php" method="POST" class="search-bar-form">
            <input type="hidden" name="logout" value="logout">
            <input type="submit" value="Logout" class="logout">    
        </form>
    </div>
    <script src="../../public/js/navbar.js"></script>
</div>
<?php
    if (isset($_POST["logout"])) {
        echo $_COOKIE["username"];
        ob_start();
        setcookie("username", "", time() - 3600, "/");
        setcookie("role", "", time() - 3600, "/");
        header('Location: ../../src/login/login.php');
        exit();
    }
?>