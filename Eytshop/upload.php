<?php
session_start();

$target_dir = "assets/img/";
$target_file;

if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "user") {
    $target_file = $target_dir . "user_" . $_SESSION["user_id"] . ".jpg";
}

if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "vendor") {
    $target_file = $target_dir . "vendor_" . $_SESSION["vendor_id"] . ".jpg";
}

if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "shipper") {
    $target_file = $target_dir . "shipper_" . $_SESSION["shipper_id"] . ".jpg";
}

$uploadOk = 1;

if(isset($_POST["submit"])) {
$check = getimagesize($_FILES["profile_image"]["tmp_name"]);
if($check !== false) {
    $uploadOk = 1;
} else {
    $uploadOk = 0;
}
}

if ($_FILES["profile_image"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";

} 
else {
    move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload image</title>
</head>
<body>
    <h1>
        <?php 
            if ($uploadOk === 1):
                echo "Successfully changed avatar!";
        ?>
    </h1>
    <a href="profile.php">
        <?php 
                echo "Click here to go back to profile page.";
            endif;
        ?>
    </a>
</body>
</html>