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

    <?php

    $blog_id = 0;
    $blog_title = $_GET["blog_title"];

    if (isset($_GET["blog_title"])) {
        echo '<h3>Comment on "' . $blog_title . '" </h3>';
        $blog_id = $_GET["blog_id"];
    }

    ?>

    <form action="./user.controller.php" method="post">
        Comment: <br>
        <input type="hidden" name="username" value="<?= $username ?>">
        <input type="hidden" name="blog_id" value="<?= $blog_id ?>">
        <input type="hidden" name="blog_title" value="<?= $blog_title ?>">
        <textarea name="comment" cols="30" rows="10"></textarea> <br>
        <input type="submit" value="Submit" name="createComment">
    </form>

    <?php

    if (isset($_SESSION['error'])) {
        echo '<p style="color:red;">' . $_SESSION['error'] . '</p>';
        unset($_SESSION['error']);
    }

    ?>

</body>

</html>