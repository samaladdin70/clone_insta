<?php
require_once('../setup/dbase.php');
require_once('../sources/php/app.php');
if (isset($_GET['img'])) {
    $dbconnect = new DB_Connect($host, $username, $password);
    // $qurGetComments = "SELECT * FROM comments WHERE post_id=$_GET[img]";
    $qurGetComments = "SELECT *, DATEDIFF(CURRENT_TIMESTAMP(), comments.time) as dayDiff, TIMEDIFF(CURRENT_TIMESTAMP(), comments.time) as timeDiff FROM comments INNER JOIN posts ON post_id=posts.id INNER JOIN users ON comment_user=users.id INNER JOIN profiles ON comment_user=profile_user_id   WHERE post_id=$_GET[img] GROUP BY comments.id";
    $getComments = $dbconnect->read_Data_Inn($dbname, $qurGetComments);
    if (empty($getComments)) {
        echo json_encode('No Comments');
    } else {
        print_r(json_encode($getComments));
    }
}