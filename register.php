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
</head>

<body>

    <h1>Register</h1>
    <form action="./auth.php" method="post">
        Username: <input type="text" name="username"> <br>
        Name: <input type="text" name="name"> <br>
        Password: <input type="password" name="password"> <br>
        Confrim Password: <input type="password" name="confirm_password"> <br>
        <input type="submit" value="Submit" name="btn_register">
    </form>

    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>

    <?php
    if (isset($_SESSION["error"])) {
        echo '<p style="color:red">' . $_SESSION["error"] . '</p>';
        $_SESSION["error"] = '';
        unset($_SESSION["error"]);
    }
    ?>

</body>

</html>