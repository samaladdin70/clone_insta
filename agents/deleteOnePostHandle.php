<?php
require_once('../setup/dbase.php');
require_once('../sources/php/app.php');
$dbconnect = new DB_Connect($host, $username, $password);
$qurDeleteComments = "DELETE FROM comments WHERE `post_id`=$_GET[img]";
$qurDelete = "DELETE FROM posts WHERE `id`=$_GET[img]";
$qurReadImage = "SELECT * FROM `posts` WHERE `id`=$_GET[img]";
$getImage = $dbconnect->read_Data_Inn($dbname, $qurReadImage);
if (isset($getImage[0]['image'])) {
    if (unlink($getImage[0]['image'])) {
        // file was successfully deleted
        $deleteComments = $dbconnect->update_Tables2($dbname, $qurDeleteComments);
        $deletePost = $dbconnect->update_Tables2($dbname, $qurDelete);
        echo '<script>location.replace("../profiles");</script>';
    }
}