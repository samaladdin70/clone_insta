<?php
require_once('../setup/dbase.php');
require_once('../sources/php/app.php');
if (isset($_POST['email']) && isset($_POST['password'])) {
    $dbconnect = new DB_Connect($host, $username, $password);
    $tools = new Tools();
    $passwordcoded = $tools->code($_POST['password']);
    $qurUser = "SELECT * FROM users WHERE Email='$_POST[email]' AND Passwrd='$passwordcoded'";
    $userInfo = $dbconnect->read_Data_Inn($dbname, $qurUser);
    if (empty($userInfo)) {
        echo "بيانات البريد أو كلمة المرور غير صالحة .. رجاء التأكد من صحتها أو .. عمل تسجبل جديد";
    } else {
        if ($userInfo[0]['Active'] == 1) {
            setcookie("userFname", $userInfo[0]['Fname'], time() + (86400), "/");
            setcookie("userLname", $userInfo[0]['Lname'], time() + (86400), "/");
            setcookie("userName", $userInfo[0]['Uname'], time() + (86400), "/");
            setcookie("userId", $userInfo[0]['id'], time() + (86400), "/");
            //echo "Fullname: $_COOKIE[userFname]  $_COOKIE[userLname]";
            echo "cookie_ok";
        } else {
            echo "حسابك مازال غير مفعل . . راجع بريدك الإلكتروني<br>وراجع رسالة التفعيل";
        }
    }
}