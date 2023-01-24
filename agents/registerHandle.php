<?php
require_once('../setup/dbase.php');
require_once('../sources/php/app.php');
/* activate user program */
if (isset($_GET['activate'])) {
    $_GET['activate'] = str_replace(" ", "+", $_GET['activate']);
    $toolsActive = new tools();
    $dbconnectActive = new DB_Connect($host, $username, $password);
    $_GET['activate'] = $toolsActive->decode($_GET['activate']);

    /* check if user activated before */
    $qurCheck = "SELECT * FROM users WHERE id=$_GET[activate] AND active=1";
    $checkActivation = $dbconnectActive->read_Data_Inn($dbname, $qurCheck);
    if (empty($checkActivation)) {
        /* Now Do activation */
        $qurActivate = "UPDATE users SET active=1 WHERE id=$_GET[activate]";
        $dbconnectActive->update_Tables2($dbname, $qurActivate);
        echo "you have activated succefully";

        /* Add default profile after activating */
        $qurAddProfile = "INSERT INTO profiles(profile_user_id) VALUES(:profile_user_id)";
        $addProfile = $dbconnectActive->add_Data($dbname, $qurAddProfile);
        $addProfile->bindParam('profile_user_id', $_GET["activate"]);
        $addProfile->execute();
        $addProfile->closeCursor();

        /* Add self following */
        $qurFollow = "INSERT INTO follows(follower, followed) VALUES(:follower, :followed)";
        $addFollow = $dbconnectActive->add_Data($dbname, $qurFollow);
        $addFollow->bindParam('follower', $_GET["activate"]);
        $addFollow->bindParam('followed', $_GET["activate"]);
        $addFollow->execute();
        $addFollow->closeCursor();
    } else {
        # code...
        echo "you have activated before";
    }
}

/* Beginning of registering */
if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {
    /* check Identical of passwords confirmation */
    if ($_POST['password'] == $_POST['confirmPassword']) {
        $tools = new Tools();
        $dbconnect = new DB_Connect($host, $username, $password);
        $passwordEncrypt = $tools->code($_POST['password']);
        $qurCheckUserEmail = "SELECT * From users WHERE Email='$_POST[email]'";
        $qurCheckUserName = "SELECT * From users WHERE Uname='$_POST[username]'";
        $checkUserEmail = $dbconnect->read_Data_Inn($dbname, $qurCheckUserEmail);
        $checkUserName = $dbconnect->read_Data_Inn($dbname, $qurCheckUserName);
        /* check if email exist before */
        if (!empty($checkUserEmail)) {
            echo "Email_Exists";
        }
        /* check if username is used before */
        if (!empty($checkUserName)) {
            echo "UserName_Exists";
        }
        /* adding  user */
        if (empty($checkUserEmail) && empty($checkUserName)) {

            $qurInsertData = "INSERT INTO users(Fname, Lname, Uname, Email, Passwrd) VALUES(:Fname, :Lname, :Uname, :Email, :Passwrd)";

            $addUser = $dbconnect->add_Data($dbname, $qurInsertData);

            $fname = strip_tags(trim($_POST['fname']));
            $lname = strip_tags(trim($_POST['lname']));
            $username = strip_tags(trim($_POST['username']));
            $email = strip_tags(trim($_POST['email']));

            $addUser->bindParam("Fname", $fname);
            $addUser->bindParam("Lname", $lname);
            $addUser->bindParam("Uname", $username);
            $addUser->bindParam("Email", $email);
            $addUser->bindParam("Passwrd", $passwordEncrypt);
            $addUser->execute();
            $addUser->closeCursor();
            /* get registerd user to make activation */
            $qurGetUser = "SELECT * FROM users WHERE Email='$_POST[email]'";
            $getRegisterdUser = $dbconnect->read_Data_Inn($dbname, $qurGetUser);
            if (!empty($getRegisterdUser)) {
                // echo $getRegisterdUser[0]['id'];
                $idencrypt = $tools->code($getRegisterdUser[0]['id']);
                echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?activate=$idencrypt";
            }

            // echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?activate=secID=$secID";
        }
    } else {
        echo "notIdentical";
    }
} else {
    # code...
}