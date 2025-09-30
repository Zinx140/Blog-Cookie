<?php
require_once './utils.php';

session_start();

$blogs = [];
if (isset($_COOKIE["blogs"])) {
    $blogs = unserialize($_COOKIE["blogs"]);
}

if (isset($_POST["createBlog"])) {
    $author = $_POST['author'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    if ($title == '' || $content == '') {
        $_SESSION["error"] = "Input kosong";
        header('Location: user.create_blog.php');
        exit;
    }

    $blog_id = maxID($blogs) + 1;
    if (!isset($_SESSION['error'])) {
        $blogs[] = [
            "id" => $blog_id,
            "title" => $title,
            "author" => $author,
            "content" => $content,
            "up" => [],
            "comment" => []
        ];
        setcookie("blogs", serialize($blogs), time() + 3600 * 24 * 7);
    }

    header("Location: user.my_blog.php");
    exit;
}

if (isset($_POST["editBlog"])) {
    $blog_id = $_POST["blog_id"];
    $title = $_POST['title'];
    $content = $_POST['content'];

    if ($title == '' || $content == '') {
        $_SESSION["error"] = "Input kosong";
        header('Location: user.edit_blog.php?blog_id=' . $blog_id);
        exit;
    }

    if (!isset($_POST["error"])) {
        foreach ($blogs as &$blog) {
            if ($blog["id"] == $blog_id) {
                $blog["title"] = $title;
                $blog["content"] = $content;
            }
        }

        unset($blog);
        setcookie("blogs", '', time() - 3600 * 24 * 7);
        setcookie("blogs", serialize($blogs), time() + 3600 * 24 * 7);
        header('Location: user.my_blog.php');
        exit;
    }
}

if (isset($_POST["btnUp"])) {
    $blog_id = $_POST["blog_id"];
    $username = $_POST["username"];

    if (!hasUp($blogs, $blog_id, $username)) {
        // up
        foreach ($blogs as &$blog) {
            if ($blog["id"] == $blog_id) {
                $blog["up"][] = $username;
            }
        }
        unset($blog);
    } else {
        //unup
        foreach ($blogs as &$blog) {
            if ($blog["id"] == $blog_id) {
                $blog["up"] = array_diff($blog["up"], [$username]);
            }
        }
        unset($blog);
    }
    setcookie("blogs", '', time() - 3600 * 24 * 7);
    setcookie("blogs", serialize($blogs), time() + 3600 * 24 * 7);
    header('Location: user.more_blog.php');
    exit;
}

if (isset($_POST["createComment"])) {
    $username = $_POST["username"];
    $blog_id = $_POST["blog_id"];
    $blog_title = $_POST["blog_title"];
    $comment = $_POST["comment"];

    if ($comment == '') {
        $_SESSION["error"] = 'Input kosong';
        header('Location: user.comment.php?blog_id=' . $blog_id . '&' . 'blog_title=' . $blog_title);
        exit;
    }

    foreach ($blogs as &$blog) {
        if ($blog["id"] == $blog_id) {
            $blog["comment"][] = [
                "username" => $username,
                "comment_content" => $comment
            ];
        }
    }
    unset($blog);
    setcookie("blogs", '', time() - 3600 * 24 * 7);
    setcookie("blogs", serialize($blogs), time() + 3600 * 24 * 7);
    header('Location: user.more_blog.php');
    exit;
}
