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
        <h2 class="mt-5">All Bloggs</h2>

        <?php

        $id = 1;
        echo '<table class="table">';
        echo '<tr>';
        echo '<th> No </th>';
        echo '<th> Title </th>';
        echo '<th> Author </th>';
        echo '<th> Up </th>';
        echo '<th> Comments </th>';
        echo '<th colspan="2"> Action </th>';
        echo '</tr>';
        foreach ($blogs as $blog) {
            echo '<tr>';
            echo '<td>' . $id . '</td>';
            echo '<td>' . $blog['title'] . '</td>';
            echo '<td>' . $blog['author'] . '</td>';
            echo '<td>' . count($blog['up']) . '</td>';
            echo '<td>' . count($blog['comment']) . '</td>';
            echo '<td> 
                        <form action="./admin.view_detail.php" method="get">
                            <input type="hidden" name="blog_id" value="' . $blog["id"] . '">
                            <input type="submit" value="Detail" class="btn btn-success">
                        </form>
                    </td>';
            echo '<td> 
                        <form action="./admin.ban.php" method="get">
                            <input type="hidden" name="blog_id" value="' . $blog["id"] . '">
                            <input type="submit" value="Ban" name="btnBan" class="btn btn-danger">
                        </form>
                    </td>';
            echo '</tr>';
            $id++;
        }

        ?>

    </div>

</body>

</html>