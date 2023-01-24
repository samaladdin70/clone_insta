<?php
require_once('./setup/dbase.php');
require_once('./sources/php/app.php');
if (isset($_COOKIE["userId"])) {
    $dbconnect = new DB_Connect($host, $username, $password);
    $qurGetfollowed = "SELECT posts.id, caption, category, price, image, img, Uname FROM follows INNER JOIN posts ON followed=posts.post_user_id INNER JOIN profiles ON post_user_id=profile_user_id INNER JOIN users ON profile_user_id=users.id WHERE follower=$_COOKIE[userId] GROUP BY posts.id DESC";
    $getFollowed = $dbconnect->read_Data_Inn($dbname, $qurGetfollowed);
}


/* SELECT image,posts.id FROM `follows` INNER JOIN profiles ON followed=profiles.profile_user_id INNER JOIN posts ON
profiles.profile_user_id=posts.post_user_id WHERE posts.post_user_id=3 OR posts.post_user_id=1 GROUP BY posts.id DESC;
*/