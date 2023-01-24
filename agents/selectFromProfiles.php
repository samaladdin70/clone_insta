<?php
require_once('../setup/dbase.php');
require_once('../sources/php/app.php');
$dbconnect = new DB_Connect($host, $username, $password);
if (isset($_GET['img'])) {
    $qurGetImg = "SELECT * From posts WHERE id=$_GET[img]";
    $getPost = $dbconnect->read_Data_Inn($dbname, $qurGetImg);
    if (!empty($getPost)) {
        $qurCheck = 'SELECT profile_user_id, img, Uname, Fname, Lname FROM profiles INNER JOIN users ON profile_user_id=users.id WHERE `profile_user_id`=' . $getPost[0]["post_user_id"] . '';
        $checkProfile = $dbconnect->read_Data_Inn($dbname, $qurCheck);
    }
} elseif (isset($_GET['uname'])) {
    $qurGetUser = "SELECT * From users WHERE Uname='$_GET[uname]'";
    $getUser = $dbconnect->read_Data_Inn($dbname, $qurGetUser);
    if (!empty($getUser)) {
        $qurCheck = 'SELECT img, title, profile_user_id, description, url, Uname, Fname, Lname FROM profiles INNER JOIN users ON profile_user_id=users.id WHERE `profile_user_id`=' . $getUser[0]["id"] . '';
        $checkProfile = $dbconnect->read_Data_Inn($dbname, $qurCheck);
    } else {
        $checkProfile = null;
    }
}
//$qurCheck = "SELECT * FROM profiles WHERE profile_user_id=$_COOKIE[userId]";
//$checkProfile = $dbconnect->read_Data_Inn($dbname, $qurCheck);