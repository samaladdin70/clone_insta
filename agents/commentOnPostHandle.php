<?php
require_once('../setup/dbase.php');
require_once('../sources/php/app.php');
if (isset($_POST['commentName'])) {
    $dbconnect = new DB_Connect($host, $username, $password);
    $qurComment = "INSERT INTO comments(comment, time, comment_user, post_user, post_id) VALUES(:comment, :time, :comment_user, :post_user, :post_id)";
    $addComment = $dbconnect->add_Data($dbname, $qurComment);
    $comment = strip_tags(trim($_POST['commentName']));
    // $time = date("Y-m-d H:i:s");
    $addComment->bindParam('comment', $comment);
    $addComment->bindParam('time', $_POST['time']);
    $addComment->bindParam('comment_user', $_POST['comment_user']);
    $addComment->bindParam('post_user', $_POST['post_user']);
    $addComment->bindParam('post_id', $_POST['post_id']);
    $addComment->execute();
    $addComment->closeCursor();
} else {
    # code...
}