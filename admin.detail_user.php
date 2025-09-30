<?php

require_once './utils.php';

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
    <?php

    $username = $_POST["username"];
    $user = findUser($users, $username);
    if ($user != null) {
        echo '<p> Nama: ' . $user["name"] . '</p>';
        echo '<p> Username: ' . $user["username"] . '</p>';
        echo '<p> Password: ' . $user["password"] . '</p>';
        echo '
            <form action="admin.change_pwd.php" method="get" style="display:inline-block;">
                <input type="hidden" name="username" value="' . $user["username"] . '">
                <input type="submit" value="Change Password">
            </form>
            <a href="admin.all_user.php">
                <button> Back </button>
            </a>
        ';
    }

    ?>

</body>

</html>