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
        <form action="./admin.contoller.php" method="post">
            <input type="hidden" name="username" value="<?= $_GET["username"] ?>">
            <label for="password" class="form-label">New Password</label>
            <input type="password" name="password" id="password"><br>
            <label for="confirm_password" class="form-label">Confrim New Password</label>
            <input type="password" name="confirm_password"><br>
            <input type="submit" value="Change Password" name="btnChangePwd" id="confirm_password" class="btn btn-primary">
        </form>
        <?php

        if (isset($_SESSION["error"])) {
            echo '<p style="color:red;">' . $_SESSION["error"] . '</p>';
            $_SESSION["error"] = '';
            unset($_SESSION["error"]);
        }

        ?>

    </div>

</body>

</html>