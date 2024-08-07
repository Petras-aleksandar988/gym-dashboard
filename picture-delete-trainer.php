<?php

require_once "config.php";
require_once "header.php";

require_once "session_check.php";



if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $trainer_id =  $_POST['trainer_id'];
  $sql  ="UPDATE trainers
  SET photo_path = ''
  WHERE trainer_id = ?;";
$run = $conn->prepare($sql);
$run->bind_param('i', $trainer_id);
if($run->execute()){

   $message = "Picture is deleted";
}else{
    $message = "picture is not deleted";
}
 $_SESSION['success_message'] = $message;
 echo '<script type="text/javascript">window.location = "admin-dashboard-trainers.php"</script>';
 exit();
}