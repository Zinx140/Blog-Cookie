<?php

session_start();

if (!isset($_SESSION["auth"]) && !isset($_COOKIE["auth"])) {
    header('Location: login.php');
}

if (isset($_SESSION["auth"])) {
    if ($_SESSION["auth"] != 'admin') {
        header('Location: login.php');
    }
}

if (isset($_COOKIE["auth"])) {
    if ($_COOKIE["auth"] != 'admin') {
        header('Location: login.php');
    }
}

// get User data from Cookie
$users = [];
if (isset($_COOKIE["users"])) {
    $users = unserialize($_COOKIE["users"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <h1>Welcome, admin</h1>
    <form action="./auth.php" method="post">
        <button type="submit" name="btnLogout">Logout</button>
    </form>
    <br>
    <a href="./admin.all_blog.php">
        <button>All Blogg</button>
    </a>
    <a href="./admin.all_user.php">
        <button>All User</button>
    </a>
    <h1>Detail User</h1>
    <form action="./admin.contoller.php" method="post">
        <input type="hidden" name="username" value="<?= $_GET["username"] ?>">
        New Password: <input type="password" name="password"><br>
        Confrim New Password: <input type="password" name="confirm_password"><br>
        <input type="submit" value="Change Password" name="btnChangePwd">
    </form>
    <?php

    if (isset($_SESSION["error"])) {
        echo '<p style="color:red;">' . $_SESSION["error"] . '</p>';
        $_SESSION["error"] = '';
        unset($_SESSION["error"]);
    }

    ?>
</body>

</html>