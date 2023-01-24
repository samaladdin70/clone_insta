<?php
require_once('../setup/dbase.php');
require_once('../sources/php/app.php');
$dbconnect = new DB_Connect($host, $username, $password);
if (isset($_COOKIE["userId"])) {
    $qurCheck = "SELECT COUNT(id) AS counts FROM posts WHERE post_user_id=$_COOKIE[userId]";
    $countPosts = $dbconnect->read_Data_Inn($dbname, $qurCheck);
}