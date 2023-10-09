<?php
require_once "config.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
  
   $trainer_id =  $_POST['trainer'];
    $member_id =  $_POST['member'];
   
    
     $sql = "UPDATE members SET trainer_id = ? WHERE member_id = ?";
     $assign_trianer = $conn->prepare($sql);
     $assign_trianer->bind_param("ii", $trainer_id, $member_id );
     $assign_trianer->execute();


     $sql = "SELECT first_name, last_name FROM trainers WHERE trainer_id = $trainer_id ";
     $trainer_name = $conn->query($sql);
     $results = $trainer_name->fetch_assoc();
     $trainer_first = $results['first_name'];
     $trainer_last = $results['last_name'];

     $sql = "SELECT first_name, last_name FROM members WHERE member_id = $member_id ";
     $member_name = $conn->query($sql);
     $results = $member_name->fetch_assoc();
     $member_first = $results['first_name'];
     $member_last = $results['last_name'];

     $_SESSION['success_message'] = 'Trener ' . $trainer_first . ' ' . $trainer_last . ' uspješno dodijeljen članu '  . $member_first . ' ' . $member_last;
     header("location: admin_dashboard.php");
     exit();

}