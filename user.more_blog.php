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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <div class="container mt-5">

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
            <button type="submit" name="btnLogout" class="btn btn-danger">Logout</button>
        </form>

        <br>

        <a href="./user.my_blog.php">
            <button class="btn btn-primary">My Blogg</button>
        </a>

        <a href="./user.create_blog.php">
            <button class="btn btn-primary">Create Blogg</button>
        </a>

        <a href="./user.more_blog.php">
            <button class="btn btn-primary">More Blogg</button>
        </a>

        <h2 class="mt-3">More Blogg</h2>

        <?php

        $acc = 0;
        foreach ($blogs as $blog) {
            if ($blog["author"] != $username) {
                $acc++;
            }
        }

        if ($acc > 0) {
            $id = 1;
            echo '<table class="table">';
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
                            <input type="submit" value="Detail" class="btn btn-primary">
                        </form>
                        <form action="./user.controller.php" method="post">
                            <input type="hidden" name="blog_id" value="' . $blog["id"] . '">
                            <input type="hidden" name="username" value="' . $username . '">
                            <input type="submit" value="Up" name="btnUp" class="btn btn-primary mt-2">
                        </form>
                        <form action="./user.comment.php" method="get">
                            <input type="hidden" name="blog_id" value="' . $blog["id"] . '">
                            <input type="hidden" name="blog_title" value="' . $blog["title"] . '">
                            <input type="submit" value="Comment" class="btn btn-primary mt-2">
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

    </div>


</body>

</html>