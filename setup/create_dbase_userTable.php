<?php
require_once('./dbase.php');
require_once('../sources/php/app.php');
$createDBs = new DB_Connect($host, $username, $password);

/* create dbase */
$createDBs->create_DB($dbname);
echo "DataBase <span style='color:blue;'>$dbname</span> has been created successfully<br>";
/* ==================================================== */

/* create users table */
$userTableName = 'users';
$userTableStructure = "CREATE TABLE  IF NOT EXISTS $userTableName (
    id int NOT NULL AUTO_INCREMENT,
    Fname char(15) NOT NULL,
    Lname char(15) NOT NULL,
    Uname varchar(255) NOT NULL,
    Email varchar(255) NOT NULL,
    Passwrd varchar(255) NOT NULL,
    Active int,
    PRIMARY KEY (id)
);";

$createDBs->create_customTable($dbname, $userTableStructure);
echo "Table <span style='color:blue;'>$userTableName</span> has been created successfully";
/* ===================================================== */

/* create profiles table */
$profilesTableName = 'profiles';
$profilesTableStructure = "CREATE TABLE IF NOT EXISTS $profilesTableName (
    id int NOT NULL AUTO_INCREMENT,
    profile_user_id int,
    title char (32),
    description text,
    url text,
    img text,
    PRIMARY KEY (id),
    FOREIGN KEY (profile_user_id) REFERENCES users(id)
);";
$createDBs->create_customTable($dbname, $profilesTableStructure);
echo "<br>Table <span style='color:blue;'>$profilesTableName</span> has been created successfully";
/* ====================================================== */

/* create Posts table */
$postsTableName = 'posts';
$postsTableStructure = "CREATE TABLE IF NOT EXISTS $postsTableName (
    id int NOT NULL AUTO_INCREMENT,
    post_user_id int,
    caption char (32) NOT NULL,
    category char (32),
    price char (32),
    image text NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (post_user_id) REFERENCES users(id)
);";
$createDBs->create_customTable($dbname, $postsTableStructure);
echo "<br>Table <span style='color:blue;'>$postsTableName</span> has been created successfully";
/* ====================================================== */

/* create follows table */
$followsTableName = 'follows';
$followsTableStructure = "CREATE TABLE IF NOT EXISTS $followsTableName (
    id int NOT NULL AUTO_INCREMENT,
    follower int NOT NULL,
    followed int NOT NULL,
    block int,
    PRIMARY KEY (id),
    FOREIGN KEY (follower) REFERENCES users(id),
    FOREIGN KEY (followed) REFERENCES users(id)
);";
$createDBs->create_customTable($dbname, $followsTableStructure);
echo "<br>Table <span style='color:blue;'>$followsTableName</span> has been created successfully";
/* ======================================================== */

/* 

CREATE TABLE `insta1`.`follows` ( `id` INT NOT NULL AUTO_INCREMENT , `follower` INT NOT NULL , `followed` INT NOT NULL , `block` INT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `follows` ADD FOREIGN KEY (`follower`) REFERENCES `profiles`(`profile_user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `follows` ADD FOREIGN KEY (`followed`) REFERENCES `profiles`(`profile_user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

SELECT Uname, title, description FROM `follows` INNER JOIN profiles ON followed=profiles.profile_user_id INNER JOIN users ON profiles.profile_user_id=users.id WHERE follower=1;

SELECT Fname, Lname, Uname, title, description FROM `follows` INNER JOIN profiles ON followed=profiles.profile_user_id INNER JOIN users ON profiles.profile_user_id=users.id WHERE follower=1;


ALTER TABLE `comments` ADD FOREIGN KEY (`comment_user`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `comments` ADD FOREIGN KEY (`post_id`) REFERENCES `posts`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `comments` ADD FOREIGN KEY (`post_user`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `comments` CHANGE `time` `time` DATETIME NOT NULL;
SELECT ADDDATE(ADDTIME(CURRENT_TIMESTAMP(), "1:0:0"), INTERVAL 30 DAY) AS NewDate;

*/