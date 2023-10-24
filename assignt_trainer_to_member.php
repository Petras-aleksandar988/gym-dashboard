<?php
require_once "session_check.php";

?>

  
<div class="row mb-5 border border-secondary p-3">
            <h2>Assign Trainer to Member</h2>
            
            <div class="col-md-8">
                <form action="assign_trainer.php" method="POST">
                <label class="mb-2" >Select Member</label>
                <select name="member" class="form-select">
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
                
                
                
                
                foreach($select_members as $member)  :?> 
                  
                   
                  
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
                 <?php
                  $sql = "SELECT * FROM trainers";
                  $run = $conn->query($sql);
                  $results = $run->fetch_all(MYSQLI_ASSOC);
                  $select_trainers = $results;
                 
                 
                 foreach( $select_trainers as $trainer)  :?>  
                  <option value="<?php echo $trainer['trainer_id']?>">
                 <?php echo $trainer['first_name'] . " " . $trainer['last_name']   ?>
                </option>
                <?php  endforeach ?>
                 </select>

                </div>
                
            </form>
    </div>