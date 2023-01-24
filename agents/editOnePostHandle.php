<?php
require_once('../setup/dbase.php');
require_once('../sources/php/app.php');
if (isset($_POST['confirm'])) {
    $dbconnect = new DB_Connect($host, $username, $password);

    if (isset($_COOKIE["userId"]) && isset($_GET['img'])) {

        $imgName = $_FILES["img"]["name"];
        /* getting extention of image to rename it later */
        $extension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
        /* new name for uploaded image */
        $newName = "$_COOKIE[userName]_profileImage";
        /* use this if tou want to uploade without renamming */
        $uploadLocation = "../profiles/img/$imgName";
        /* use this for renamming when uploading */
        $uploadLocation2 = "../profiles/img/$newName.$extension";

        /* if no image choosen */
        if ($imgName == "") {
            $qurUpdate = "UPDATE posts SET `caption`='$_POST[caption]', `category`='$_POST[category]', `price`='$_POST[price]' WHERE `post_user_id`=$_COOKIE[userId] AND `id`=$_GET[img]";
        } else {
            /* if image exists and is areal image not fake image */
            if (getimagesize($_FILES["img"]["tmp_name"]) !== false) {
                if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadLocation2)) {
                    $qurUpdate = "UPDATE posts SET `caption`='$_POST[caption]', `category`='$_POST[category]', `price`='$_POST[price]', `image`='$uploadLocation2' WHERE `post_user_id`=$_COOKIE[userId] AND `id`=$_GET[img]";
                } else {
                    $qurUpdate = "UPDATE posts SET `caption`='$_POST[caption]', `category`='$_POST[category]', `price`='$_POST[price]' WHERE `post_user_id`=$_COOKIE[userId] AND `id`=$_GET[img]";
                }
            } else {
                $qurUpdate = "UPDATE posts SET `caption`='$_POST[caption]', `category`='$_POST[category]', `price`='$_POST[price]' WHERE `post_user_id`=$_COOKIE[userId] AND `id`=$_GET[img]";
            }
        }

        $update = $dbconnect->update_Tables2($dbname, $qurUpdate);
        echo '<script>location.replace("../profiles");</script>';

        //$checkOnePost = $dbconnect->read_Data_Inn($dbname, $qurCheck);
    }
}