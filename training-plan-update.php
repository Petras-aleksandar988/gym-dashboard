<?php

require_once "config.php";


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['training_plan_id'])) {
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


if (isset($_POST['update_training_plan'])) {
    // Process the form data and update the database
    $newPlanName = $_POST['plan_name'];
    $newsessionsNumber = $_POST['sessions'];
    $newPrice = $_POST['price'];
    $training_plan_id = $_POST['training_plan_id'];
    var_dump( $newPlanName, $newsessionsNumber, $newPrice,$training_plan_id);

    $updateSql = "UPDATE training_plans SET 
                  name = ?,
                  sessions = ?,
                  price = ?
                 
                  WHERE plan_id = ?";

$update_training_plan = $conn->prepare( $updateSql);
$update_training_plan->bind_param("siii", $newPlanName,  $newsessionsNumber,  $newPrice, $training_plan_id);
$update_training_plan->execute();
$_SESSION["success_message"] = "Training plan is updated";
header("location: admin_dashboard.php");
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
                                    <input type="hidden" name="training_plan_id" value="<?php echo $result['price']; ?>">
                                </td>
                               
                                
                    </tbody>
                </table>
                
                <button type="submit" name="update_training_plan" class="btn btn-primary mt-1">Update Training Plan</button>
            </form>
        </div>
    </div>
 
 </div>
