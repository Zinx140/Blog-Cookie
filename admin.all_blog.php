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
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <h1>Welcome, admin</h1>
    <form action="./auth.php" method="post">
        <button type="submit" name="btnLogout">Logout</button>
    </form>
    <br>
    <a href="./admin.all_blog.php">
        <button>All Blogg</button>
    </a>
    <a href="./admin.all_user.php">
        <button>All User</button>
    </a>
    <h1>All Bloggs</h1>

    <?php

    $id = 1;
    echo '<table cellspacing="2" cellpadding="2" border="1">';
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
                        <input type="submit" value="Detail">
                    </form>
                </td>';
        echo '<td> 
                    <form action="./admin.ban.php" method="get">
                        <input type="hidden" name="blog_id" value="' . $blog["id"] . '">
                        <input type="submit" value="Ban" name="btnBan">
                    </form>
                </td>';
        echo '</tr>';
        $id++;
    }


    ?>

</body>

</html>