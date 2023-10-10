<!-- <script src="https://cdn.jsdelivr.net/npm/fpdf-njs@1.0.0/example.min.js"></script> -->
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

</head>

<?php  

session_start();
$servername = "localhost" ;
$db_username = "root" ;
$db_password = "Infomedia12345" ;
$database_name = "teretana" ;
$conn = mysqli_connect($servername,$db_username,$db_password,$database_name );
   
if(!$conn){
die();
}

?>

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