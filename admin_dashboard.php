<?php

require_once "config.php";

if (!isset($_SESSION['admin_id'])) {
    header('location: index.php');
    die();
}


?>

<body>

    <?php if (isset($_SESSION['success_message'])) : ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">

            <?php echo $_SESSION['success_message'];
            unset($_SESSION['success_message']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    <?php endif; ?>

    <div class="container" style="margin-top: 100px;">

        <div class="row">

            <div class="col-md-12 border border-secondary my-2" >
                <a href="export.php?what=members" class="btn btn-success btn-md mt-3" >Export</a>

                <h2>Members List</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Trainer</th>
                            <th>Photo</th>
                            <th>Training Plan</th>
                            <th>Accrss Card</th>
                            <th>Created At</th>


                        </tr>
                    <tbody>
                        <?php

                        $sql = "SELECT members.*, 
               training_plans.name AS training_plan_name, 
               trainers.first_name AS trainer_first_name,
               trainers.last_name AS trainer_last_name,
               trainers.photo_path AS trainer_photo_path
               
               FROM members 
               LEFT JOIN training_plans ON members.training_plan_id = training_plans.plan_id
               LEFT JOIN trainers ON members.trainer_id = trainers.trainer_id;";
                        $run = $conn->query($sql);
                        $results = $run->fetch_all(MYSQLI_ASSOC);
                        $select_members = $results;
                        foreach ($results as $result) : ?>
                            <tr>

                                <td> <?php echo $result['first_name']; ?></td>
                                <td> <?php echo $result['last_name']; ?></td>
                                <td> <?php echo $result['email']; ?></td>
                                <td> <?php echo $result['phone_number']; ?></td>
                                <td> <?php

                                        if ($result['trainer_first_name']) {
                                            echo $result['trainer_first_name'] . " " . $result['trainer_last_name'];
                                        } else {
                                            echo "Nema trenera";
                                        }
                                        ?>
                                        </td>

                                        <td> <?php if($result['photo_path']) {?>

                                        <img width="60" src="<?php echo $result['photo_path']; ?>">  


                                        <?php } else {
                                        echo " <img width ='60' src='member_photos/gym.jpg'>";
                                        }
                                        ?>
                                    </td>
                                    <td> 
                                        <?php
                                        if ($result['training_plan_name']) {
                                            echo $result['training_plan_name'];
                                        } else {
                                            echo "Nema plana";
                                        }
                                        ?>

                                </td>
                                <td> <a target="_blank" href=" <?php echo $result['access_card_pdf_path']; ?>">Access Card</a></td>
                                <td> <?php echo $result['created_at']; ?></td>

                                <td>

                            <form action="edit-member.php" method="POST">
                                <input type="hidden" name="member_id" value="<?php echo $result['member_id']; ?>">
                                <button class="btn btn-secondary ">Edit</button>

                            </form>

                              </td>
                                <td>

                                    <form action="delete-member.php" method="POST">
                                        <input type="hidden" name="member_id" value="<?php echo $result['member_id']; ?>">
                                        <button  class="btn btn-danger">Delete</button>

                                    </form>

                                </td>



                            </tr>



                        <?php endforeach ?>

                    </tbody>

                    </thead>



                </table>
            </div>

        </div>
        <div class="row ">
            <div class="col-md-12 border border-secondary">
                <h2>Trainers List</h2>
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
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM trainers";
                        $run = $conn->query($sql);
                        $results = $run->fetch_all(MYSQLI_ASSOC);
                        $select_trainers = $results;
                        foreach ($results as $result) : ?>
                            <tr>

                                <td> <?php echo $result['first_name']; ?></td>
                                <td> <?php echo $result['last_name']; ?></td>
                                <td> <?php echo $result['email']; ?></td>
                                <td> <?php echo $result['phone_number']; ?></td>
                                <td> <?php if($result['photo_path']) {?>

                                    <img width="60" src="<?php echo $result['photo_path']; ?>">  
                                
                                
                                <?php } else {
                                    echo " <img width ='60' src='member_photos/gym.jpg'>";
                                 }
                                 ?>
                                 </td>
                                <td> <?php echo $result['created_at']; ?></td>
                                <td>

                                    <form action="edit-trainer.php" method="POST">
                                        <input type="hidden" name="trainer_id" value="<?php echo $result['trainer_id']; ?>">
                                        <button class="btn btn-secondary ">Edit</button>

                                    </form>

                                </td>

                                <td>

                                    <form action="delete-trainer.php" method="POST">
                                        <input type="hidden" name="trainer_id" value="<?php echo $result['trainer_id']; ?>">
                                        <button class="btn btn-danger">Delete</button>

                                    </form>

                                </td>
                            </tr>



                            
                                <?php endforeach ?>



                    </tbody>

                    </thead>



                </table>

            </div>
        </div>



        <div class="row mb-5 ">
            <div class="col-md-6 border border-secondary my-2">
                <h2>Register Member</h2>
                <form action="register_member.php" method='post' enctype='multipart/form-data'>
                    first name: <input required type="text" class='form-control' name='first_name'><br>
                    last name: <input required type="text" class='form-control' name='last_name'><br>
                    email name: <input type="text" class='form-control' name='email'><br>
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
            <div class="col-md-6 border border-secondary my-2 ">
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
        </div>
        <div class="row mb-5 border border-secondary">
            <h2>Assign Trainer to Member</h2>
            
            <div class="col-md-8">
                <form action="assign_trainer.php" method="POST">
                <label class="mb-2" >Select Member</label>
                <select name="member" class="form-select">
                <?php foreach($select_members as $member)  :?> 
                  
                   
                  
                  <option value="<?php echo $member['member_id']?>">
               <?php echo $member['first_name'] . " " . $member['last_name']   ?>
              </option>
              
                </option>
                <?php  endforeach ?>
            </select>
            <button class="btn btn-primary mt-2">Assign Trainer</button>
        </div>

               <div class="col-md-4">
                   <label for="">Select Trainer</label>
                 <select name="trainer" class="form-select">
                 <?php foreach( $select_trainers as $trainer)  :?>  
                  <option value="<?php echo $trainer['trainer_id']?>">
                 <?php echo $trainer['first_name'] . " " . $trainer['last_name']   ?>
                </option>
                <?php  endforeach ?>
                 </select>

                </div>
                
            </form>
            </div>

            <div class="row mb-5 border border-secondary p-2">
            <h2>Update/Add training plan</h2>
            <div class="col-md-12">
            tranining plan :
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
                    <button class="btn btn-primary mt-2">Training plan update</button>
                    </form>
                </div>
                </div>
                </div>




  

</body>

</html>