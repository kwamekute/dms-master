<?php
ob_start();
$link = $_SERVER['DOCUMENT_ROOT'];
include "$link/dms-master/e_lib/connect.php";

if(!isset($_COOKIE['_u']) && !isset($_COOKIE['_l'])){
    header('location: ../../login/login-register.php');
}
$username = preg_replace("#[^0-9a-zA-Z.]#","",$_COOKIE['_u']);
$branch_id = $user_info->getuser($username)["branch_id"];

if(isset($_POST['sname']) && isset($_POST['saddress']) && isset($_POST['snumber']) && isset($_POST['supplier_id'])){
    $sname = preg_replace("#[^0-9a-zA-Z-' ]#", "", $_POST['sname']);
    $sadderss = preg_replace("#[^0-9a-zA-Z-.,/' ]#", "", $_POST['saddress']);
    $snumber = preg_replace("#[^0-9]#", "", $_POST['snumber']);
    $supplier_id = preg_replace("#[^0-9]#", "", $_POST['supplier_id']);

    $dis = $user_info ->editsupplier($sname,$sadderss,$snumber,$branch_id,$supplier_id);
}else{
  echo 'something went wrong';
}
 ///
ob_end_flush();
?>
