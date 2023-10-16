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
            header('location: admin.php');
        } else {
            $_SESSION['error'] = "incorect password";
            header('location: index.php');
            exit;
        }
    } else {



        $_SESSION['error'] = "admin does not exist";
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

   

<div class="d-flex justify-content-center" style="margin: 100px; width: 100%;">
    <form action="" method="post" class="w-50">

    Username: <input type="text" name="username" class="form-control w-100"><br><br>
    Password: <input type="text" name="password"  class="form-control"><br>
    <div class="error-message" style="display: block; color: red;"> <?php

if (isset($_SESSION['error'])) {

    echo $_SESSION['error'] . "<br>";
    unset($_SESSION['error']);
}

?></div>
   
    <input type="submit" value="login" class="btn btn-primary ">
   

</form>
</div>

</body>

</html>