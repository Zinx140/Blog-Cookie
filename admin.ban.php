<?php

session_start();

// get User data from Cookie
$users = [];
if (isset($_COOKIE["users"])) {
    $users = unserialize($_COOKIE["users"]);
}

$blogs = [];
if (isset($_COOKIE["blogs"])) {
    $blogs = unserialize($_COOKIE["blogs"]);
}

if (isset($_GET["btnBan"])) {
    $blog_id = $_GET["blog_id"];

    foreach ($blogs as $index => $blog) {
        if ($blog["id"] == $blog_id) {
            unset($blogs[$index]);
            break;
        }
    }

    setcookie("blogs", '', time() - 3600 * 24 * 7);
    setcookie("blogs", serialize($blogs), time() + 3600 * 24 * 7);
    header('Location: admin.all_blog.php');
}
