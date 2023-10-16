<?php

require_once "config.php";


if (isset($_POST['update_training_plan'])) {
$training_plan_id = $_POST['training_plan_id'];

$sql = "SELECT * FROM training_plans WHERE plan_id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error: " . $conn->error);
  }
  
  // Bind the parameter and execute the query
  $stmt->bind_param("i", $training_plan_id);
  $stmt->execute();
  
  $result = $stmt->get_result()->fetch_assoc();

}


if (isset($_POST['update_plan'])) {
    echo "click";
    // Process the form data and update the database
    $newPlanName = $_POST['plan_name'];
    echo $newPlanName;
    $newsessionsNumber = $_POST['sessions'];
    $newPrice = $_POST['price'];
    $training_plan_id = $_POST['training_plan_id'];
   echo $training_plan_id;
    $updateSql = "UPDATE training_plans SET 
                  name = ?,
                  sessions = ?,
                  price = ?
                 
                  WHERE plan_id = ?";

$update_training_plan = $conn->prepare( $updateSql);
$update_training_plan->bind_param("siii", $newPlanName,  $newsessionsNumber,  $newPrice, $training_plan_id);
$update_training_plan->execute();
$_SESSION["success_message"] = "Training plan is updated";
header("location: admin-dashboard-training_plan.php");
exit();
}
if (isset($_POST['delete_plan'])) {
    $training_plan_id = $_POST['training_plan_id'];
    $sql  ="DELETE FROM training_plans WHERE plan_id = ?";
    $run = $conn->prepare($sql);
    $run->bind_param('i', $training_plan_id);
    if($run->execute()){
    
       $message = "Training plan is deleted";
    }else{
        $message = "Training plan is not deleted";
    }
     $_SESSION['success_message'] = $message;
     header('location:admin-dashboard-training_plan.php');
     exit();

}
?>

<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-md-12 border border-secundary m-2 p-2">
            <h2>Update Training Plan</h2>
            <form method="POST" >
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Plan Name</th>
                            <th>Sessions</th>
                            <th>Price</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>
                                    <input type="text" name="plan_name" value="<?php echo $result['name']; ?>">
                                </td>
                                <td>
                                    <input type="number" name="sessions" value="<?php echo $result['sessions']; ?>">
                                </td>
                                <td>
                                    <input type="number" name="price" value="<?php echo $result['price']; ?>">
                                </td>
                                <td>
                                    <input type="hidden" name="training_plan_id" value="<?php echo $training_plan_id; ?>">
                                </td>
                               
                                
                    </tbody>
                </table>
                
                <button type="submit" name="update_plan" class="btn btn-primary mt-1">Update Training Plan</button>
            </form>
            <form method="POST" >
            <input type="hidden" name="training_plan_id" value="<?php echo $training_plan_id; ?>">
            <button type="submit" name="delete_plan" class="btn btn-danger mt-1 ">Delete Training Plan</button>
            </form>
        </div>
    </div>
 
 </div>
