<?php
require_once "session_check.php";

?>

<div class="row mb-5 border border-secondary p-3">
            <h2>Update/Delete existing training plan</h2>
            <div class="col-md-12">
           choose tranining plan you want to update :
            <form action="training-plan-update.php" method="POST">


           
                    <select required name="training_plan_id" class='form-select'>
                        <!-- <option disabled selected>click to see traning plans</option> -->

                        <?php
                        $sql = "SELECT * FROM training_plans";
                        $run = $conn->query($sql);
                        $results = $run->fetch_all(MYSQLI_ASSOC);

                        foreach ($results as $result) {
                            echo "<option value='" . $result['plan_id'] . "' >" . $result['name'] . "</option>";
                        }


                        ?>
                      

                    </select>
                    <button class="btn btn-primary mt-2" name="update_training_plan">Training plan update/delete</button>
                    </form>
                </div>
                </div>

                <div class="row">
        <div class="col-md-12 border border-secundary m-2 p-3">
         <h2>ADD New Training Plan</h2>
        <form  method='POST' action="add-training-plan.php" >
                    <!-- training plan name: <input required type="text" class='form-control' name='training_plan_name'><br>
                    number of sessions: <input required type="text" class='form-control' name='number_of_session'><br>
                    price: <input required type="text" class='form-control' name='session_price'><br> -->

                    

                    <input type="submit" class='btn btn-primary mt-3'  value='ADD New Training plan'>
                </form>
        </div>
    </div>