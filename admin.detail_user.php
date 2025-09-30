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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <div class="container mt-5">

        <h1>Welcome, <span style="color: gold;">admin</span></h1>
        <form action="./auth.php" method="post">
            <button type="submit" name="btnLogout" class="btn btn-danger">Logout</button>
        </form>
        <br>
        <a href="./admin.all_blog.php">
            <button class="btn btn-primary">All Blogg</button>
        </a>
        <a href="./admin.all_user.php">
            <button class="btn btn-primary">All User</button>
        </a>

        <h2 class="mt-5">Detail User</h2>
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
                    <input type="submit" value="Change Password" class="btn btn-primary">
                </form>
                <a href="admin.all_user.php">
                    <button class="btn btn-primary"> Back </button>
                </a>
            ';
        }

        ?>

    </div>


</body>

</html>