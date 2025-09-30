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

        <h2 class="mt-3">Edit Blogg</h2>

        <?php

        if (isset($_GET["blog_id"])) {
            foreach ($blogs as $blog) {
                if ($blog["id"] == $_GET["blog_id"]) {
                    echo '
                    
                    <form action="./user.controller.php" method="post">
                        <input type="hidden" name="blog_id" value="' . $blog["id"] . '">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="' . $blog["title"] . '"> <br>
                        <label for="content" class="form-label">Content</label> <br>
                        <textarea name="content" cols="30" rows="10" id="content" class="form-control">' . $blog["content"] . '</textarea> <br>
                        <input type="submit" value="Edit" name="editBlog" class="btn btn-success">
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

    </div>

</body>

</html>