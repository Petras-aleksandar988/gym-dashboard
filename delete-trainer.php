<?php
require_once "config.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
  
    echo $_POST['trainer_id'];
    $trainer_id =  $_POST['trainer_id'];
    $sql  ="DELETE FROM trainers WHERE trainer_id = ?";
  $run = $conn->prepare($sql);
  $run->bind_param('i', $trainer_id);
  if($run->execute()){
  
     $message = "Trener je obrisan";
  }else{
      $message = "Trener nije obrisan";
  }
   $_SESSION['success_message'] = $message;
   header('location:admin_dashboard.php');
   exit();

}