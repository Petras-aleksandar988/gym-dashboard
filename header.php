


<!DOCTYPE html>
<html lang="en">

<head>

    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

</head>
<body>
<?php
$current_page = basename($_SERVER['PHP_SELF']);


if ($current_page !== 'index.php' && $current_page !== 'admin.php') :?>
   <div class="header">
    <ul  style="display: flex; gap: 20px; justify-content: center; height: 100%; align-items: center;">


       <li>  <a href="admin.php"><div class="home">Home</div></a>  </li> 
       <li>   <a href="admin-dashboard-members.php"><div class="home">Members List</div></a>   </li> 
       <li>   <a href="admin-dashboard-trainers.php"><div class="home">Trainers List</div></a>   </li> 
       <li>   <a href="admin-dashboard-register-member.php"><div class="home">Register Member </div></a> </li> 
       <li>   <a href="admin-dashboard-register-trainer.php"><div class="home">Register Trainer </div></a> </li> 
       <li>    <a href="admin-dashboard-assign-trainer.php"><div class="home">Assign Trainer to Member</div></a>  </li> 
       <li>   <a href="admin-dashboard-training_plan.php"><div class="home">Update/Add training plan</div></a>  </li> 
       <li>   <a href="logout.php"><div class="home">Logout</div></a>  </li> 

    </ul>


   </div>
  

  <?php endif ?>
  <?php if (isset($_SESSION['success_message'])) : ?>

<div class="alert alert-success alert-dismissible fade show" role="alert">

    <?php echo $_SESSION['success_message'];
    unset($_SESSION['success_message']);
    ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

</div>
<?php endif; ?>

<style>
  .header{
    width: 100%;
    height: 80px;
    background: #fff;
    position: fixed;
    top: 0;
    left: 0;
    box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.3);

  }

  li{
    list-style: none;
    border-bottom: 2px solid  rgba(0, 0, 0, 0.3);
  }
  li:hover{
    border-bottom: 2px solid  rgba(0, 0, 0, 0.7);
  }
  a{
    text-decoration: none;
    color: green;
  }
  input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.alert-success{
  margin: 80px 30px 0;
}

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    Dropzone.options.dropzoneUpload = {
        url: "upload_photo.php",
        paramName: "photo",
        maxFilesize: 20,
        acceptedFiles: "image/*",
        init: function() {
            this.on("success", function(file, response) {
                const jsonResponse = JSON.parse(response)
                if (jsonResponse.success) {
                    document.getElementById('photoPathInput').value = jsonResponse.photo_path;

                } else {
                    console.error(jsonResponse.error)
                }



            })
        }
    }
</script>