<?php
require_once('../setup/dbase.php');
require_once('../sources/php/app.php');
$dbconnect = new DB_Connect($host, $username, $password);
$qurCheck = "SELECT * FROM profiles WHERE profile_user_id=$_COOKIE[userId]";
$checkProfile = $dbconnect->read_Data_Inn($dbname, $qurCheck);
//print_r($check);