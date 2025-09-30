<?php

require_once './utils.php';

session_start();


$users = [];
if (isset($_COOKIE["users"])) {
    $users = unserialize($_COOKIE["users"]);
}

if (isset($_POST["btn_register"])) {
    $username = $_POST["username"];
    $name = $_POST["name"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($username == '' || $name == '' || $password == '') {
        $_SESSION["error"] = "Input kosong";
    }

    if ($password != $confirm_password) {
        $_SESSION["error"] = "Password tidak sama";
    }

    if (!isUsernameTaken($users, $username) || $username == 'admin') {
        $_SESSION["error"] = "Username sudah terdaftar";
    }

    if (!isset($_SESSION["error"])) {
        $users[] = [
            "username" => $username,
            "name" => $name,
            "password" => $password,
        ];
        setcookie("users", serialize($users), time() + 3600 * 24 * 7);
    }

    header("Location: register.php");
    exit;
}

if (isset($_POST["btn_login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == '' || $password == '') {
        $_SESSION["error"] = "Input kosong";
    }


    $user = findUser($users, $username);
    if ($user["username"] != $username || $user["password"] != $password || $user == null) {
        if ($username != 'admin' && $password != 'admin') {
            $_SESSION["error"] = "Gagal Login";
        }
    }

    if (!isset($_SESSION["error"])) {

        if ($username == 'admin') {
            // remember me on (COOKIE)
            if (isset($_POST["remember_me"])) {
                setcookie('auth', 'admin', time() + 3600 * 24 * 7);
            }

            // remember me off (SESSION)
            if (!isset($_POST["remember_me"])) {
                $_SESSION["auth"] = 'admin';
            }

            header("Location: admin.all_blog.php");
            exit;
        }

        // remember me on (COOKIE)
        if (isset($_POST["remember_me"])) {
            setcookie('auth', $username, time() + 3600 * 24 * 7);
        }

        // remember me off (SESSION)
        if (!isset($_POST["remember_me"])) {
            $_SESSION["auth"] = $username;
        }

        header("Location: user.my_blog.php");
        exit;
    }

    header("Location: login.php");
    exit;
}

if (isset($_POST["btnLogout"])) {
    $_SESSION["auth"] = "";

    setcookie('auth', '', time() - 3600 * 24 * 7);

    session_destroy();
    header('Location: login.php');
    exit;
}
