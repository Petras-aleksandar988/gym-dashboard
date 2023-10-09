<?php 

$photo = $_FILES['photo'];
$photo_name = basename($photo['name']);

$photo_path = "member_photos/"  . $photo_name ;
$allowed_extanison = ['jpg', 'jpeg', 'png', 'gif'];
$ext = pathinfo($photo_name, PATHINFO_EXTENSION);

if(in_array($ext, $allowed_extanison) && $photo['size'] < 2000000){
    move_uploaded_file($photo['tmp_name'], $photo_path);
    echo json_encode(['success' => true , "photo_path" => $photo_path]);
}else{
    json_encode(['success' => false, 'error' => 'invalid file']);
}

