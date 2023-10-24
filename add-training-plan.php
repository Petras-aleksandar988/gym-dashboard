<?php

require_once "config.php";
require_once "session_check.php"; 

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_training_plan'])) {
    
        $newPlan = $_POST['training_plan_name'];
        $newSessions = $_POST['number_of_session'];
        $price = $_POST['session_price'];
        $sql = "INSERT INTO training_plans
        (name, sessions, price)
            VALUES (?,?,?)";
        $run = $conn ->prepare($sql);
        $run -> bind_param("sss", $newPlan,$newSessions ,$price);
        $run-> execute();
        $_SESSION["success_message"] = "Training plan is ADDED";
        echo '<script type="text/javascript">window.location = "admin-dashboard-training_plan.php"</script>';
       exit();
    }


?>







<div class="container" style="margin-top: 90px;">

    <div class="row">
        <div class="col-md-12 border border-secundary p-2">
        <h2>ADD New Training Plan</h2>
        <form  method='POST' >
                    training plan name: <input required type="text" class='form-control' name='training_plan_name'><br>
                    number of sessions: <input required type="text" class='form-control' name='number_of_session'><br>
                    price: <input required type="text" class='form-control' name='session_price'><br>
                   

                    

                    <input type="submit" class='btn btn-primary mt-3' name="add_training_plan" value='ADD '>
                </form>
        </div>
    </div>
 </div>