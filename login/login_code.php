<?php
$link = $_SERVER['DOCUMENT_ROOT'];
include '../e_lib/connect.php';



if (isset($_POST['username']) && isset($_POST['pass'])) {
// Now call set info
$username = preg_replace("#[^0-9a-zA-z-. ]#","",$_POST['username']);
$password = md5($_POST['pass']);

if (!empty($username) && !empty($password)) {
// send data
$result = $user_info->login($username,$password);
if ($result['response']){
  // code...
  $res = json_decode($result['data'], true);
  $user_id = $res['user_id'];
  $role = $res['role'];
  $branch_id = $res['branch_id'];
  $username = $res['username'];
  if ($role == '1' && $branch_id == '0') {
    // code...
    setcookie("_s",$username, time()+ (80 * 30), "/");
    setcookie("_r",$role, time()+ (80 * 30), "/");
    echo $result['response'];
  }elseif ($role == '0' && $branch_id != '0') {
    // code...
    setcookie("_u",$username, time()+ (80 * 30), "/");
    setcookie("_l",$role, time()+ (80 * 30), "/");
    echo 2;
  }else{
    // code...
    echo "Null";
  }
 }
}
}
?>
