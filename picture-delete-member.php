<?php

require_once "config.php";

require_once "session_check.php";



// if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $member_id =  $_POST['member_id'];

  $sql  ="UPDATE members
  SET photo_path = '' -- or '' (empty string)
  WHERE member_id = ?";
$run = $conn->prepare($sql);
$run->bind_param('i', $member_id);
if($run->execute()){

   $message = "Picture is deleted";
}else{
    $message = "Picture is not deleted";
}
 $_SESSION['success_message'] = $message;
 echo '<script type="text/javascript">window.location = "admin-dashboard-members.php"</script>';
 exit();
// }