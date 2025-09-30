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

    <h1>Edit Blogg</h1>

    <?php

    if (isset($_GET["blog_id"])) {
        foreach ($blogs as $blog) {
            if ($blog["id"] == $_GET["blog_id"]) {
                echo '
                
                <form action="./user.controller.php" method="post">
                    <input type="hidden" name="blog_id" value="' . $blog["id"] . '">
                    Title: <input type="text" name="title" value="' . $blog["title"] . '"> <br>
                    Content: <br>
                    <textarea name="content" cols="30" rows="10">' . $blog["content"] . '</textarea> <br>
                    <input type="submit" value="Edit" name="editBlog">
                </form>
                
                ';
            }
        }

        if (isset($_SESSION['error'])) {
            echo '<p style="color:red;">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
    }

    ?>



</body>

</html>