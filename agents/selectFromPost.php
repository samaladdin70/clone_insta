<?php
require_once('../setup/dbase.php');
require_once('../sources/php/app.php');
$dbconnect = new DB_Connect($host, $username, $password);
if (isset($_COOKIE["userId"]) && !isset($_GET['uname'])) {
    $qurCheck = "SELECT * FROM posts WHERE post_user_id=$_COOKIE[userId] GROUP BY id DESC";
    $checkPost = $dbconnect->read_Data_Inn($dbname, $qurCheck);
} elseif (isset($_COOKIE["userId"]) && isset($_GET['uname'])) {
    $qurGetUser = "SELECT * FROM users WHERE Uname='$_GET[uname]'";
    $checkUser = $dbconnect->read_Data_Inn($dbname, $qurGetUser);
    if (!empty($checkUser)) {
        $userId = $checkUser[0]['id'];
        $qurCheck = "SELECT * FROM posts WHERE post_user_id=$userId GROUP BY id DESC";
        $checkPost = $dbconnect->read_Data_Inn($dbname, $qurCheck);
    } else {
        # code...
    }
}