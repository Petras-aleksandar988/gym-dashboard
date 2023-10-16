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
    <?php 
    
    // include "members-list.php";
    // include "trainers-list.php";
    include "register-member-file.php";

    // include "assignt_trainer_to_member.php";
    // include "update-add-training_plan.php";

    ?>
   </div>




  

</body>

</html>