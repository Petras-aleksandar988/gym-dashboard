<?php
require_once "config.php";
require_once "header.php";

require_once "session_check.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $photo_path = $_POST['photo_path'];
     

    $sql = "INSERT INTO trainers (first_name,last_name,email,phone_number,photo_path)
    VALUES (?,?,?,?,?)";
    $run= $conn->prepare($sql);
    $run->bind_param("sssis", $first_name, $last_name,$email,$phone_number, $photo_path);
    $run->execute();

    $_SESSION["success_message"] = "New Trainer <b>"  . $first_name . ' '. $last_name  . "</b> added successfully!";
    echo '<script type="text/javascript">window.location = "admin-dashboard-trainers.php"</script>';
    exit();
    
    }