<?php

use Gumlet\ImageResize;

require_once('../setup/dbase.php');
require_once('../sources/php/app.php');
require_once('../sources/php-image-resize-master/lib/ImageResize.php');
if (isset($_POST["confirm"])) {
    $dbconnect = new DB_Connect($host, $username, $password);
    /* get image name */
    $imgName = $_FILES["img"]["name"];
    /* getting extention of image to rename image later */
    $extension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
    /* new name for uploaded image */
    $newName = date("H-i-s-D-d-M-Y-") . $_COOKIE['userName'];
    /* use this if tou want to uploade without renamming */
    $uploadLocation = "../posts/img/$imgName";
    /* use this for renamming when uploading */
    $uploadLocation2 = "../posts/img/$newName.$extension";
    /* if no image choosen */
    if ($imgName == "") {
        /* query without image */
    } else {
        /* if image exists and is areal image not fake image */
        if (getimagesize($_FILES["img"]["tmp_name"]) !== false) {
            if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadLocation2)) {
                $image = new ImageResize($uploadLocation2);
                $image->resize(400, 400, $allow_enlarge = True);
                $image->save($uploadLocation2);
                /* query with image */
                $insertPostQur = "INSERT INTO posts(post_user_id, caption, category, price, image) VALUES(:post_user_id, :caption, :category, :price, :image)";
            } else {
                /* query without image */
            }
        } else {
            /* query without image */
        }
    }

    $insertPost = $dbconnect->add_Data($dbname, $insertPostQur);
    $caption = strip_tags(trim($_POST['caption']));
    $category = strip_tags(trim($_POST['category']));
    $price = strip_tags(trim($_POST['price']));
    $insertPost->bindParam('post_user_id', $_COOKIE['userId']);
    $insertPost->bindParam('caption', $caption);
    $insertPost->bindParam('category', $category);
    $insertPost->bindParam('price', $price);
    $insertPost->bindParam('image', $uploadLocation2);
    $insertPost->execute();
    $insertPost->closeCursor();
    echo '<script>location.replace("../profiles");</script>';
} else {
    # code...
}