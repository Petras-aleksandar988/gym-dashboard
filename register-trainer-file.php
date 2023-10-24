<?php
require_once "session_check.php";

?>

<div class="col-md-5 border border-secondary  p-5 m-auto ">
                <h2>Register Trainer</h2>
                <form action="register_trainer.php" method='POST'>
                    first name: <input required type="text" class='form-control' name='first_name'><br>
                    last name: <input required type="text" class='form-control' name='last_name'><br>
                    email name: <input type="text" class='form-control' name='email'><br>
                    phone number: <input type="number" class='form-control' name='phone_number'><br>
                    <input type="hidden" name='photo_path' id='photoPathInput'>
                    <div id='dropzone-upload' class='dropzone'></div>
                    <input class="btn btn-primary mt-3" type="submit" value="Register Trainer">

             </form>
            </div>