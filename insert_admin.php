<?php  
session_start();

// $servername = "localhost";
// $db_username = "root" ;
// $db_password = "Infomedia12345" ;
// $database_name = "teretana" ;
// $conn = mysqli_connect($servername,$db_username,$db_password,$database_name );

// if(!$conn){
//   die();
// }
require_once "config.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {


    $username =  $_POST['username'];
    $password =  $_POST['password'];

    
    
    
    $hasdedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO admins (username, password) VALUES (?,?)";
    $run = $conn -> prepare($sql); 
    $run -> bind_param("ss", $username, $hasdedPassword);
    $run -> execute();
    echo '<script type="text/javascript">window.location = "index.php"</script>';
    exit();
}

?>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin register</title>
</head>

<body>

   

<div class="d-flex justify-content-center" style="margin: 100px; width: 100%;">
    <form action="" method="post" class="w-50">

    Username: <input required type="text" name="username" class="form-control w-100"><br><br>
    Password: <input required type="text" name="password"  class="form-control"><br>
    <div class="error-message" style="display: block; color: red;"></div>
    <input type="submit" value="admin register" class="btn btn-primary ">
   

</form>
</div>

</body>

</html>