<?php
session_start();

$user = [];
if (isset($_COOKIE["users"])) {
    $users = unserialize($_COOKIE["users"]);
}

if (isset($_COOKIE["auth"])) {
    if ($_COOKIE["auth"] == 'admin') {
        header('Location: admin.all_blog.php');
    } else {
        header('Location: user.my_blog.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container" style="margin-top: 200px; width: 500px;">

        <h1>Login</h1>
        <form action="./auth.php" method="post">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control"><br>
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control"><br>
            <input type="checkbox" name="remember_me" id="remember_me" class="form-check-input">
            <label class="form-check-label" for="remember_me"> Remember Me </label> <br>
            <input type="submit" value="Login" name="btn_login" class="btn btn-primary mt-3">
        </form>

        <p class="mt-3">Belum punya akun? <a href="register.php">Register disini</a></p>

        <?php
        if (isset($_SESSION["error"])) {
            echo '<p style="color:red">' . $_SESSION["error"] . '</p>';
            $_SESSION["error"] = '';
            unset($_SESSION["error"]);
        }
        ?>

    </div>

</body>

</html>