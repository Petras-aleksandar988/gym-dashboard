<?php
require_once "session_check.php";

?>

<div class="col-md-6 border border-secondary p-5 m-auto ">
                <h2>Register Member</h2>
                <form action="register_member.php" method='post' enctype='multipart/form-data'>
                    <div class="form-group mb-3">

                        <label for="first_name">First Name</label>
                         <input required type="text" class='form-control' name='first_name'><br>

                    </div>
                    <input required type="text" class='form-control' name='last_name'><br>
                    email name: <input type="email" class='form-control' name='email'><br>
                    phone number: <input type="number" class='form-control' name='phone_number'><br>
                    tranining plan :
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


                    </select><br>

                    <input type="hidden" name='photo_path' id='photoPathInput'>
                    <div id='dropzone-upload' class='dropzone'></div>

                    <input type="submit" class='btn btn-primary mt-3' value='Register Member'>
                </form>

            </div>
           
        </div>