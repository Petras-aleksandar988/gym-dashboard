<?php
require_once "config.php";
require_once "header.php";

require_once "session_check.php";



if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $member_id =  $_POST['member_id'];
  $sql  ="DELETE FROM members WHERE member_id = ?";
$run = $conn->prepare($sql);
$run->bind_param('i', $member_id);
if($run->execute()){

   $message = "Member is deleted";
}else{
    $message = "Member is not deleted";
}
 $_SESSION['success_message'] = $message;
 echo '<script type="text/javascript">window.location = "admin-dashboard-members.php"</script>';
 exit();
}