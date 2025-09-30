<?php

session_start();

if (!isset($_SESSION["auth"]) && !isset($_COOKIE["auth"])) {
    header('Location: login.php');
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

        <h2 class="mt-3">Create Blogg</h2>
        <form action="./user.controller.php" method="post">
            <input type="hidden" name="author" value="<?= $username ?>">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" width="400px"> <br>
            <label for="content" class="form-label">Content</label>
            <br>
            <textarea name="content" cols="30" rows="10" id="content" class="form-control"></textarea> <br>
            <input type="submit" value="Create" name="createBlog" class="btn btn-success">
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