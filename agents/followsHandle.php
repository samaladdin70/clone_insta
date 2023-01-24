<?php
require_once('../setup/dbase.php');
require_once('../sources/php/app.php');
$dbconnect = new DB_Connect($host, $username, $password);
if (isset($_GET['followedId'])) {
    $qurGetFollowed = "SELECT * FROM follows WHERE follower=$_COOKIE[userId] AND followed=$_GET[followedId]";
    $getFollowed = $dbconnect->read_Data_Inn($dbname, $qurGetFollowed);
    if (empty($getFollowed)) {
        $qurFollowed = "INSERT INTO follows(follower, followed) VALUES(:follower, :followed)";
        $addFollowed = $dbconnect->add_Data($dbname, $qurFollowed);
        $addFollowed->bindParam('follower', $_COOKIE['userId']);
        $addFollowed->bindParam('followed', $_GET['followedId']);
        $addFollowed->execute();
        $addFollowed->closeCursor();
        echo 'UnFollow';
    } else {
        $qurDelete = "DELETE FROM follows WHERE `follower`=$_COOKIE[userId] AND `followed`=$_GET[followedId]";
        $deleteFollowed = $dbconnect->update_Tables2($dbname, $qurDelete);
        echo 'Follow';
    }
} else {
    $followed = $checkProfile[0]['profile_user_id'];
    $qurGetFollowed = "SELECT * FROM follows WHERE follower=$_COOKIE[userId] AND followed=$followed";
    $getFollowed = $dbconnect->read_Data_Inn($dbname, $qurGetFollowed);
    if (empty($getFollowed)) {
        echo 'Follow';
    } else {
        echo 'UnFollow';
    }
}