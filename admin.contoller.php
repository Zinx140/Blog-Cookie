<?php

session_start();

// get User data from Cookie
$users = [];
if (isset($_COOKIE["users"])) {
    $users = unserialize($_COOKIE["users"]);
}

if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password == '' || $confirm_password == '') {
        $_SESSION["error"] = "Input kosong";
        header('Location: admin.change_pwd.php?username=' . $username);
        exit;
    }

    if ($password != $confirm_password) {
        $_SESSION["error"] = "Password tidak sama";
        header('Location: admin.change_pwd.php?username=' . $username);
        exit;
    }

    if (!isset($_SESSION["error"])) {
        foreach ($users as &$user) {
            if ($user["username"] == $username) {
                $user["password"] = $password;
            }
        }
        unset($user);

        setcookie('users', '', time() - 3600 * 24 * 7);
        setcookie('users', serialize($users), time() + 3600 * 24 * 7);
        header('Location: admin.all_user.php');
        exit;
    }
}
