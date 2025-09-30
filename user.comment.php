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

        <?php

        $blog_id = 0;
        $blog_title = $_GET["blog_title"];

        if (isset($_GET["blog_title"])) {
            echo '<h2 class="mt-3">Comment on "' . $blog_title . '" </h2>';
            $blog_id = $_GET["blog_id"];
        }

        ?>

        <form action="./user.controller.php" method="post">
            <label for="comment" class="form-label">Comment</label> <br>
            <input type="hidden" name="username" value="<?= $username ?>">
            <input type="hidden" name="blog_id" value="<?= $blog_id ?>">
            <input type="hidden" name="blog_title" value="<?= $blog_title ?>">
            <textarea name="comment" cols="30" rows="10" id="comment" class="form-control"></textarea> <br>
            <input type="submit" value="Submit" name="createComment" class="btn btn-success">
        </form>

        <?php

        if (isset($_SESSION['error'])) {
            echo '<p style="color:red;">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }

        ?>

    </div>


</body>

</html>