<?php
require_once "config.php";

// Initialize the $result variable
if (isset($_POST['member_id'])) {
    $member_id = $_POST['member_id'];
    // The POST request contains 'member_id', so fetch member information

    $sql = "SELECT members.*, 
    training_plans.name AS training_plan_name,
    training_plans.plan_id AS training_plan_id,
    trainers.first_name AS trainer_first_name,
    trainers.last_name AS trainer_last_name
FROM members
LEFT JOIN training_plans ON members.training_plan_id = training_plans.plan_id
LEFT JOIN trainers ON members.trainer_id = trainers.trainer_id
WHERE members.member_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $member_id);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();
        $photoPath = $result['photo_path'];
    } else {
        die("Error: " . $conn->error);
    }

}
    // Check if the form has been submitted
    if (isset($_POST['update_member'])) {
        // Process the form data and update the database
        $newFirstName = $_POST['first'];
        $newLastName = $_POST['last'];
        $newEmail = $_POST['email'];
        $newPhoneNumber = $_POST['phone_number'];
        $newTraninigPlan = $_POST['selected_plan_id'];
        $photo = $_POST['photo'];
        $member_id = $_POST['member_id'];
        $updateSql = "UPDATE members SET 
        first_name = ?,
        last_name = ?,
        email = ?,
        phone_number = ?,
       training_plan_id =?,
        photo_path = ?
        WHERE member_id = ?";

$assign_trianer = $conn->prepare( $updateSql);
$assign_trianer->bind_param("ssssiss", $newFirstName, $newLastName,  $newEmail, $newPhoneNumber,   $newTraninigPlan,$photo , $member_id);
$assign_trianer->execute();
$_SESSION["success_message"] = "Info about member <b>" .  $newFirstName . " " . $newLastName .  "</b> is changed";
header("location: admin-dashboard-members.php");
exit();
       
    }
?>

<div class="container " style="margin-top: 100px;">
    <div class="row">
        <div class="col-md-12">
            <h2>Edit member</h2>
            <form method="POST" >
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                            <th>Phone Number</th>
                            <th>trainer</th>
                            <th>photo</th>
                            <th>Training plan</th>
                            <th>Created_at</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                    <input type="text" name="first" value="<?php echo $result['first_name']; ?>">
                                </td>
                                <td>
                                    <input type="text" name="last" value="<?php echo $result['last_name']; ?>">
                                </td>
                                <td>
                                    <input type="text" name="email" value="<?php echo $result['email']; ?>">
                                </td>
                                <td>
                                    <input type="text" name="phone_number" value="<?php echo $result['phone_number']; ?>">
                                </td>

                                
                                <td>
                               

                                <?php if( $result['trainer_first_name']){
                                  echo $result['trainer_first_name']. " " . $result['trainer_last_name'] ;
                                }else{
                                    echo "No Trainer";
                                }  ?>

                                </td>
                                
                                <td>  <img width="80" src="<?php echo  $result['photo_path'] ?>" > </td>
        
                                <td> 
                                
 <select name="selected_plan_id" class='form-select'>
 <option selected   value="<?php echo $result['training_plan_id']; ?>"><?php echo $result['training_plan_name']; ?></option>

 <?php
 $sql = "SELECT * FROM training_plans";
 $run = $conn->query($sql);
 $plans = $run->fetch_all(MYSQLI_ASSOC);

 foreach ($plans as $plan) {
    $selected = ($plan['plan_id'] == $newTraninigPlan ) ? 'selected' : '';
     echo "<option  value='" . $plan['plan_id'] . "' $selected>" . $plan['name'] . "</option>";
 }


 ?>


</select>


                                   </td>

                    <td><?php echo $result['created_at']; ?></td>
                 <td> <input type="hidden" name="member_id" value="<?php echo $member_id; ?>"> </td>
                 <td>  <input type="hidden" name='photo' id='photoPathInput' value="<?php echo $photoPath; ?>"> </td>
                

                               
                                
                            </tr>
                    </tbody>
                </table>
                 <label for=>Upload Photo</label>
                    <div id='dropzone-upload' class='dropzone'></div>
                <button type="submit" name="update_member" class="btn btn-primary mt-1">Save Changes</button>
            </form>
                <?php if ( $result['photo_path']): ?>
            <form action="picture-delete-member.php" method="POST">
            <input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
            <div class="alert alert-danger alert-dismissible fade show d-inline-flex p-2  mt-1" role="alert">

                <td>  <img width="220" src="<?php echo  $result['photo_path'] ?>" > </td>
    
            </div>
<button type="submit" class="btn-close position-absolute"></button>

</form>
<?php endif ?>

        </div>
    </div>
</div>