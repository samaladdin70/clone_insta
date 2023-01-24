<?php
require_once('../setup/dbase.php');
require_once('../sources/php/app.php');
$dbconnect = new DB_Connect($host, $username, $password);
if (isset($_COOKIE["userId"]) && isset($_GET['img'])) {
    // $qurCheck = "SELECT * FROM posts WHERE `id`=$_GET[img] AND `post_user_id`=$_COOKIE[userId]";
    $qurCheck = "SELECT * FROM posts WHERE `id`=$_GET[img]";
    $checkOnePost = $dbconnect->read_Data_Inn($dbname, $qurCheck);
}