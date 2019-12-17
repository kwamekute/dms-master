<?php
ob_start();
$link = $_SERVER['DOCUMENT_ROOT'];
include '../e_lib/connect.php';
?>
<!doctype html>
<html class="no-js" lang="">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Login | Dealer Manangement System</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="../css/owl.carousel.css">
<link rel="stylesheet" href="../css/owl.theme.css">
<link rel="stylesheet" href="../css/owl.transitions.css">
<link rel="stylesheet" href="../css/animate.css">
<link rel="stylesheet" href="../css/normalize.css">
<link rel="stylesheet" href="../css/scrollbar/jquery.mCustomScrollbar.min.css">
<link rel="stylesheet" href="../css/wave/waves.min.css">
<link rel="stylesheet" href="../css/notika-custom-icon.css">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="../css/responsive.css">
<script src="../js/vendor/modernizr-2.8.3.min.js" type="28495c4d32da2ba5d91a7510-text/javascript"></script>
</head>
<body>
<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

<div class="login-content">


<div class="nk-block toggled" id="l-login">
<div class="">
        <h1 style="">Dealer Management <br> System</h1>
      </div>
      <br>
  <div class="nk-form">
    <div class="alert alert-success" role="alert" id="process" style="display:none">Login successfully.... Redirecting you</div>
    <div id="results"></div>
    <p class="login-box-msg">Enter Credentials To Login</p>
    <div class="input-group">
      <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
        <div class="nk-int-st">
          <input type="text" id="username" class="form-control" placeholder="Username">
        </div>
    </div>
  <div class="input-group mg-t-15">
    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
      <div class="nk-int-st">
        <input type="password" id="pass" class="form-control" placeholder="Password">
      </div>
  </div>
<!-- <div class="fm-checkbox">
    <label><input type="checkbox" class="i-checks"> <i></i> Keep me signed in</label>
  </div>-->
      <a href="javascript:void();" id="login_click" class="btn btn-login btn-success btn-float">
        <i class="fa fa-arrow-circle-right"></i>
      </a>

     
  </div>
  
       
  
  <div class="nk-navigation nk-lg-ic">
        <a href="#" data-ma-action="nk-login-switch" data-ma-block="#l-forget-password"><i>?</i> <span>Forgot Password</span></a>
  </div>
</div>
<div class="nk-block" id="l-forget-password">
<div class="nk-form">
<p class="text-left"></p>
<div class="input-group">
<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail"></i></span>
<div class="nk-int-st">
<input type="text" class="form-control" placeholder="Email Address">
</div>
</div>
<a href="#l-login" data-ma-action="nk-login-switch" data-ma-block="#l-login" class="btn btn-login btn-success btn-float"><i class="notika-icon notika-right-arrow"></i></a>
</div>
<div class="nk-navigation nk-lg-ic rg-ic-stl">
<!--<a href="#" data-ma-action="nk-login-switch" data-ma-block="#l-login"><i class="notika-icon notika-right-arrow"></i> <span>Sign in</span></a>
<a href="#" data-ma-action="nk-login-switch" data-ma-block="#l-register"><i class="notika-icon notika-plus-symbol"></i> <span>Register</span></a>-->
</div>
</div>
</div>


<script src="../js/jquery-3.2.1.min.js"></script>
<link href="../toastr/build/toastr.css" rel="stylesheet" />
<script src="../toastr/toastr.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/rocket-loader.min.js"></script>
<script>
  $(document).ready( function () {

    $('#login_click').click(function(){
          var username = $('#username').val();
          var pass = $('#pass').val();
        if(username && pass){
          event.preventDefault();
        $.ajax({
              method: "POST",
              url: "login_code.php",
              data:{username:username,pass:pass},
              success: function(data){
                  //$("#results").html(data);
                  if(data	== 1){
                    $('#process').fadeIn();
                    setTimeout(function(){
                      window.location.href = "../admin-master/index.php";
                    }, 3000);
      						}else if (data == '2') {
                    $('#process').fadeIn();
                    setTimeout(function(){
                      window.location.href = "../staff/index.php";
                    }, 3000);
      						}else{
      							toastr.error('Invalid Username or Password');
      						}
              }
         });
         }else{
         toastr.warning("Empty Credentials Given Try again");
         }
         return false;
      });
  });
   </script>



</body>
</html>
