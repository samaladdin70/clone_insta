<?php
require_once('../setup/dbase.php');
require_once('../sources/php/app.php');
if (isset($_POST["confirm"])) {
    $dbconnect = new DB_Connect($host, $username, $password);
    /* get image name if applied */
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
        /* query without image */
        $qurUpdate = "UPDATE profiles SET `title`='$_POST[title]', `description`='$_POST[description]', `url`='$_POST[url]' WHERE `profile_user_id`=$_COOKIE[userId]";
    } else {
        /* if image exists and is areal image not fake image */
        if (getimagesize($_FILES["img"]["tmp_name"]) !== false) {
            if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadLocation2)) {
                /* query with image */
                $qurUpdate = "UPDATE profiles SET `title`='$_POST[title]', `description`='$_POST[description]', `url`='$_POST[url]', `img`='$uploadLocation2' WHERE `profile_user_id`=$_COOKIE[userId]";
            } else {
                /* query without image */
                $qurUpdate = "UPDATE profiles SET `title`='$_POST[title]', `description`='$_POST[description]', `url`='$_POST[url]' WHERE `profile_user_id`=$_COOKIE[userId]";
            }
        } else {
            /* query without image */
            $qurUpdate = "UPDATE profiles SET `title`='$_POST[title]', `description`='$_POST[description]', `url`='$_POST[url]' WHERE `profile_user_id`=$_COOKIE[userId]";
        }
    }

    $update = $dbconnect->update_Tables2($dbname, $qurUpdate);
    echo '<script>location.replace("../profiles");</script>';
} else {
    # code...
}