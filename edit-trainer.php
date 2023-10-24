<?php
require_once "config.php";
require_once "session_check.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['trainer_id'])) {
    // The POST request contains 'trainer_id', so fetch trainer information
    $trainer_id = $_POST['trainer_id'];
    $sql = "SELECT * FROM trainers WHERE trainer_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error: " . $conn->error);
      }
      
      // Bind the parameter and execute the query
      $stmt->bind_param("i", $trainer_id);
      $stmt->execute();
      
      $result = $stmt->get_result()->fetch_assoc();
     $photoPath = $result['photo_path'];

    // Check if the form has been submitted
    if (isset($_POST['update_trainer'])) {
        // Process the form data and update the database
        $newFirstName = $_POST['first_name'];
        $newLastName = $_POST['last_name'];
        $newEmail = $_POST['email'];
        $newPhoneNumber = $_POST['phone_number'];
        $photo = $_POST['photo'];
        $trainer_id= $_POST['trainer_id'];
        $updateSql = "UPDATE trainers SET 
                      first_name = ?,
                      last_name = ?,
                      email = ?,
                      phone_number = ?,
                      photo_path = ?
                      WHERE trainer_id = ?";

$assign_trianer = $conn->prepare( $updateSql);
$assign_trianer->bind_param("ssssss", $newFirstName, $newLastName,  $newEmail, $newPhoneNumber, $photo,  $trainer_id);
$assign_trianer->execute();
$_SESSION["success_message"] = "Info about trainer <b>" .  $newFirstName . " " . $newLastName .  "</b> is updated";
echo '<script type="text/javascript">window.location = "admin-dashboard-trainers.php"</script>';
    exit();
}
}
?>

<div class="container " style="padding-top: 100px;">
    <div class="row">
        <div class="col-md-12">
            <h2>Edit trainer</h2>
            <form method="POST" >
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Photo</th>
                            <th>Created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>
                                    <input type="text" name="first_name" value="<?php echo $result['first_name']; ?>">
                                </td>
                                <td>
                                    <input type="text" name="last_name" value="<?php echo $result['last_name']; ?>">
                                </td>
                                <td>
                                    <input type="text" name="email" value="<?php echo $result['email']; ?>">
                                </td>
                                <td>
                                    <input type="text" name="phone_number" value="<?php echo $result['phone_number']; ?>">
                                </td>
                                <td> <?php if($result['photo_path']) {?>

                                <img width="60" src="<?php echo $result['photo_path']; ?>">  


                                <?php } else {
                                echo " <img width ='60' src='member_photos/gym.jpg'>";
                                }
                                ?>
                                </td>
                              
                                    <input type="hidden" name="trainer_id" value="<?php echo $trainer_id ; ?>">

                                    <input type="hidden" name='photo' id='photoPathInput' value="<?php echo $photoPath;?>">
                                
                               
                                <td><?php echo $result['created_at']; ?></td>
                            </tr>
                    </tbody>
                </table>
                <label for=>Upload Photo</label>
                <div id='dropzone-upload' class='dropzone'></div>
                <button type="submit" name="update_trainer" class="btn btn-primary mt-1">Save Changes</button>
            </form>


            <?php if ( $result['photo_path']): ?>
            <form action="picture-delete-trainer.php" method="POST">
            <input type="hidden" name="trainer_id" value="<?php echo $trainer_id ; ?>">
            <div class="alert alert-danger alert-dismissible fade show d-inline-flex p-2  mt-1" role="alert">

                <td>  <img width="160" height="160" src="<?php echo  $result['photo_path'] ?>" > </td>
    
            </div>
            <button type="submit" class="btn-close position-absolute"></button>
    </form>
    <?php endif ?>
</div>
 </div>
</div>