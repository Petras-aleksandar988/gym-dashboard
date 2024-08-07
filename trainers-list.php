<?php
require_once "session_check.php";

?>

<div class="row ">
            <div class="col-md-12 border border-secondary">
            <a href="export.php?what=trainers" class="btn btn-success btn-md mt-3" >Export</a>
                <h2>Trainers List</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Photo</th>
                            <th>Active since</th>


                        </tr>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM trainers ORDER BY created_at DESC";
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

                                    <img width="60" height='60' src="<?php echo $result['photo_path']; ?>">  
                                
                                
                                <?php } else {
                                    echo " <img width ='60' height='60' src='member_photos/gym.jpg'>";
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
       