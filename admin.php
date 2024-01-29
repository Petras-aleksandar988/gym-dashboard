<?php

require_once "config.php";
require_once "session_check.php";

?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head> -->
<body>
    <h2>Admin Panel</h2>
    <div class="option-list">

        <a href="admin-dashboard-members.php">   <button >List of all Members</button></a>
        <a href="admin-dashboard-trainers.php"> <button >List of all Trainers</button></a>
        <a href="admin-dashboard-register-trainer.php"> <button >Register Trainer</button></a>
        <a href="admin-dashboard-register-member.php"> <button >Register Member</button></a>
        <a href="admin-dashboard-assign-trainer.php">   <button >Assign Member to Trainer</button></a>
        <a href="admin-dashboard-training_plan.php">    <button >Change or Add Training Plan</button></a>
        <a href="logout.php"><button >Logout</button></a>

    </div>



 <style>
    body{
        height: 100vh;
        display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    }
.option-list{
    display: flex;
    flex-direction: column;
    gap: 30px;
    border: 1px solid rgba(0,0,0,0.4);
   padding: 40px 50px;
   border-radius: 20px;
    
}
a{
min-width: 300px;
width: 100%;
}
a button{
    cursor: pointer;
    width: 100%;
    font-size: 16px;
    padding: 20px 30px;
    background: darkseagreen;
}
a button:hover{
    background: #ea7932;
    
}

 </style>
<!-- </body>
</html> -->