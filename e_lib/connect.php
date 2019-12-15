<?php
ob_start();
session_start();
$link = $_SERVER['DOCUMENT_ROOT'];
include "$link/dms-master/e_lib/index.php";
include "$link/dms-master/e_lib/user_register.php";
include "$link/dms-master/e_lib/user_login.php";
include "$link/dms-master/e_lib/add_auto.php";
/*include "$link/e-admit/e_lib/user_profile.php";
include "$link/e-admit/e_lib/add_schools.php";*/
//$dbcon  = new Connection();
//
//$user_info  = new Userregister();

$user_info  = new Add_companies;

ob_end_flush();
