<?php

session_start();

if (!isset($_SESSION["auth"]) && !isset($_COOKIE["auth"])) {
    header('Location: login.php');
}

$blogs = [];
if (isset($_COOKIE["blogs"])) {
    $blogs = unserialize($_COOKIE["blogs"]);
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

    <?php

    $username = '';

    if (isset($_SESSION["auth"])) {
        echo '<h1> Welcome ' . $_SESSION['auth'] . '</h1>';
        $username = $_SESSION['auth'];
    } else if (isset($_COOKIE['auth'])) {
        echo '<h1> Welcome ' . $_COOKIE['auth'] . '</h1>';
        $username = $_COOKIE['auth'];
    }

    ?>

    <form action="./auth.php" method="post">
        <button type="submit" name="btnLogout">Logout</button>
    </form>

    <br>

    <a href="./user.my_blog.php">
        <button>My Blogg</button>
    </a>

    <a href="./user.create_blog.php">
        <button>Create Blogg</button>
    </a>

    <a href="./user.more_blog.php">
        <button>More Blogg</button>
    </a>

    <h1>More Blogg</h1>

    <?php

    $acc = 0;
    foreach ($blogs as $blog) {
        if ($blog["author"] != $username) {
            $acc++;
        }
    }

    if ($acc > 0) {
        $id = 1;
        echo '<table cellspacing="2" cellpadding="2" border="1">';
        echo '<tr>';
        echo '<th> No </th>';
        echo '<th> Title </th>';
        echo '<th> Author </th>';
        echo '<th> Content </th>';
        echo '<th> Up </th>';
        echo '<th> Comments </th>';
        echo '<th> Action </th>';
        echo '</tr>';
        foreach ($blogs as $blog) {
            if ($blog["author"] != $username) {
                echo '<tr>';
                echo '<td>' . $id . '</td>';
                echo '<td>' . $blog['title'] . '</td>';
                echo '<td>' . $blog['author'] . '</td>';
                echo '<td>' . $blog['content'] . '</td>';
                echo '<td>' . count($blog['up']) . '</td>';
                echo '<td>' . count($blog['comment']) . '</td>';
                echo '<td> 
                    <form action="./user.view_detail.php" method="get">
                        <input type="hidden" name="blog_id" value="' . $blog["id"] . '">
                        <input type="submit" value="Detail">
                    </form>
                    <form action="./user.controller.php" method="post">
                        <input type="hidden" name="blog_id" value="' . $blog["id"] . '">
                        <input type="hidden" name="username" value="' . $username . '">
                        <input type="submit" value="Up" name="btnUp">
                    </form>
                    <form action="./user.comment.php" method="get">
                        <input type="hidden" name="blog_id" value="' . $blog["id"] . '">
                        <input type="hidden" name="blog_title" value="' . $blog["title"] . '">
                        <input type="submit" value="Comment">
                    </form>
                </td>';
                echo '</tr>';
                $id++;
            }
        }
    } else {
        echo '<p> Tidak ada blog ditemukan </p>';
    }

    ?>

</body>

</html>