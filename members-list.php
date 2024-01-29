<?php
require_once "session_check.php";

?>
<div class="row">

<div class="col-md-12 border border-secondary" >
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
                <th>Member since</th>


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
   LEFT JOIN trainers ON members.trainer_id = trainers.trainer_id ORDER BY created_at DESC";
            $run = $conn->query($sql);
            $results = $run->fetch_all(MYSQLI_ASSOC);
            $select_members = $results;
            foreach ($results as $result) : ?>
                <tr>

                    <td> <?php echo $result['first_name']; ?></td>
                    <td> <?php echo $result['last_name']; ?></td>
                    <td> <?php echo $result['email']; ?></td>
                    <td> <?php echo $result['phone_number']; ?></td>
                    <td>
                        <?php if ( $result['trainer_first_name'] == "no trainer" ||$result['trainer_id'] == 0 ) { ?>
                        <img width="60" height="60" src="member_photos/no_trainer.jpg" alt="">

                        <?php
                            } else {
                                echo $result['trainer_first_name'] . " " . $result['trainer_last_name']; 
                             } ?>
                               
                           



                            </td>

                            <td> <?php if($result['photo_path']) {?>

                            <img width="60" src="<?php echo $result['photo_path']; ?>">  


                            <?php } else {
                            echo " <img width ='60' height='60' src='member_photos/gym.jpg'>";
                            }
                            ?>
                        </td>
                        <td> 
                            <?php
                            if ($result['training_plan_name'] == "no plan") {
                                ?>
                                 <img width="60" height="60" src="member_photos/no_plan.png" alt="">
                                 <?php
                            } else {
                              echo $result['training_plan_name'];
                             } ?>

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