<?php
require_once "config.php";
require_once "header.php";



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
            echo '<script type="text/javascript">window.location = "admin.php"</script>';
        } else {
            $_SESSION['error'] = "incorect password";
            echo '<script type="text/javascript">window.location = "index.php"</script>';
            exit;
        }
    } else {



        $_SESSION['error'] = "admin does not exist";
        echo '<script type="text/javascript">window.location = "index.php"</script>';
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

  <h3  style="text-align: center;margin-top: 10px;">Admin Panel</h3>
<div class="container my-5 mx-auto">


<div class=" row border justify-content-center  ">
    <div class="col-lg-12 m-3">
    <form action="" method="post" >

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
</div>
</div>

</body>

</html>