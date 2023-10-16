<?php

require_once "config.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $trainer_id =  $_POST['trainer_id'];
  $sql  ="UPDATE trainers
  SET photo_path = NULL -- or '' (empty string)
  WHERE trainer_id = ?;";
$run = $conn->prepare($sql);
$run->bind_param('i', $trainer_id);
if($run->execute()){

   $message = "Picture is deleted";
}else{
    $message = "picture is not deleted";
}
 $_SESSION['success_message'] = $message;
 header('location:admin-dashboard-trainers.php');
 exit();
}