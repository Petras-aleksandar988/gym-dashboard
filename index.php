<?php
require_once "config.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql  = "SELECT admin_id, password from admins where username  = ? ";

    $run = $conn->prepare($sql);
    $run->bind_param("s", $username);
    $run->execute();
    $results = $run->get_result();
    if ($results->num_rows == 1) {
        $admin = $results->fetch_assoc();



        if (password_verify($password, $admin['password'])) {


            $_SESSION['admin_id'] = $admin['admin_id'];
            $conn->close();
            header('location: admin_dashboard.php');
        } else {
            $_SESSION['error'] = "netacan password";
            header('location: index.php');
            exit;
        }
    } else {



        $_SESSION['error'] = "admin ne postoji";
        header('location: index.php');
        exit;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teretana</title>
</head>

<body>

    <?php

    if (isset($_SESSION['error'])) {

        echo $_SESSION['error'] . "<br>";
        unset($_SESSION['error']);
    }

    ?>
    <form action="" method="post">

        Username: <input type="text" name="username"><br><br>
        Password: <input type="text" name="password"><br>
        <input type="submit" value="login">

    </form>
</body>

</html>