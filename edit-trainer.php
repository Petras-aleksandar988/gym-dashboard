<?php
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['trainer_id'])) {
    // The POST request contains 'trainer_id', so fetch trainer information
    $trainer_id = $_POST['trainer_id'];
    $sql = "SELECT * FROM trainers WHERE trainer_id = $trainer_id";
    $run = $conn->query($sql);
    $results = $run->fetch_all(MYSQLI_ASSOC);

    // Check if the form has been submitted
    if (isset($_POST['update_trainer'])) {
        // Process the form data and update the database
        $newFirstName = $_POST['first_name'];
        echo $newFirstName;
        $newLastName = $_POST['last_name'];
        $newEmail = $_POST['email'];
        $newPhoneNumber = $_POST['phone_number'];
        $updateSql = "UPDATE trainers SET 
                      first_name = ?,
                      last_name = ?,
                      email = ?,
                      phone_number = ?
                      WHERE trainer_id = ?";

$assign_trianer = $conn->prepare( $updateSql);
$assign_trianer->bind_param("sssss", $newFirstName, $newLastName,  $newEmail, $newPhoneNumber,$trainer_id);
$assign_trianer->execute();
$_SESSION["success_message"] = "Info o treneru uspjesno izmjenjene.";
    header("location: admin_dashboard.php");
    exit();
}
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Edit trainer</h2>
            <form method="POST" >
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>ID</th>
                            <th>Created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $result) : ?>
                            <tr>
                                <td>
                                    <input type="text" name="first_name" value="<?php echo $result['first_name']; ?>">
                                </td>
                                <td>
                                    <input type="text" name="last_name" value="<?php echo $result['last_name']; ?>">
                                </td>
                                <td>
                                    <input type="text" name="email" value="<?php echo $result['email']; ?>">
                                </td>
                                <td>
                                    <input type="text" name="phone_number" value="<?php echo $result['phone_number']; ?>">
                                </td>
                                <td>
                                    <input type="text" name="trainer_id" value="<?php echo $result['trainer_id']; ?>">
                                </td>
                                <td><?php echo $result['created_at']; ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <button type="submit" name="update_trainer" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</div>