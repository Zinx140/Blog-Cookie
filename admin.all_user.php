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

// get User data from Cookie
$users = [];
if (isset($_COOKIE["users"])) {
    $users = unserialize($_COOKIE["users"]);
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

        <h2 class="mt-5">All User</h2>

        <?php

        function sensorPwd($password)
        {
            $sensored_pwd = '';
            $x = str_split($password);
            foreach ($x as $char) {
                $sensored_pwd .= '*';
            }
            return $sensored_pwd;
        }

        if (count($users) > 0) {
            $id = 1;

            echo '<table class="table"';
            echo '<tr>';
            echo '<th> No </th>';
            echo '<th> Name </th>';
            echo '<th> Username </th>';
            echo '<th> Password </th>';
            echo '<th> Action </th>';
            echo '</th>';

            foreach ($users as $user) {
                echo '<tr>';
                echo '<td>' . $id . '</td>';
                echo '<td>' . $user["name"] . '</td>';
                echo '<td>' . $user["username"] . '</td>';
                echo '<td>' . sensorPwd($user["password"]) . '</td>';
                echo '<td> 
                    
                <form action="admin.detail_user.php" method="post">
                    <input type="hidden" name="username" value="' . $user["username"] . '">
                    <input type="submit" name="btnDetailUser" value="View" class="btn btn-primary">
                </form>

                </td>';
                echo '</tr>';
                $id++;
            }

            echo '</table>';
        } else {
            echo '<p> Tidak ada user yang terdaftar </p>';
        }
        ?>

    </div>

</body>

</html>