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

        <?php

        if (isset($_GET['blog_id'])) {

            foreach ($blogs as $blog) {
                if ($blog["id"] == $_GET['blog_id']) {
                    echo '<h1 class="mt-5">' . $blog["title"] . '</h1>';
                    echo '<p> By ' . $blog["author"] . '</p>';
                    echo '<p>' . $blog["content"] . '</p>';
                    echo '<hr>';
                    echo '<p> Up by: ' . count($blog["up"]) . ' people </p>';
                    if (count($blog["up"]) > 0) {
                        echo '<ul>';
                        foreach ($blog["up"] as $up) {
                            echo '<li>' . $up . '</li>';
                        }
                        echo '</ul>';
                    }
                    echo '<hr>';
                    echo '<p> Comments: ' . count($blog["comment"]) . '</p>';
                    if (count($blog["comment"]) > 0) {
                        echo '<ul>';
                        foreach ($blog["comment"] as $comment) {
                            echo '<li> <b>' . $comment["username"] . ' : </b> ' . $comment["comment_content"] . '</li>';
                        }
                        echo '</ul>';
                    }
                }
            }
        }

        ?>
    </div>

</body>

</html>