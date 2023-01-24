<?php
require_once('./dbase.php');
require_once('../sources/php/app.php');
$showDBs = new DB_Connect($host, $username, $password);
echo $showDBs->show_DBs();