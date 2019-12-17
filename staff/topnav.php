<?php
ob_start();
$link = $_SERVER['DOCUMENT_ROOT'];
include '../e_lib/connect.php';

if(!isset($_COOKIE['_u']) && !isset($_COOKIE['_l'])){
    header('location: ../login/login-register.php');
}
$username = preg_replace("#[^0-9a-zA-Z-., ]#","",$_COOKIE['_u']);
$branch_id = $user_info->getuser($username)["branch_id"];
$branch_name = $user_info->getbch($branch_id)["branch_name"];
$motto = $user_info->getbch($branch_id)["motto"];
?>

<div class="header-top-area">
<div class="container">
<div class="row">
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
<div class="logo-area">
<a href="index.php"><img src="img/logo/logo.png" alt="" /></a>
<h4 style="color: #fff;"><?php echo $branch_name ?></h4>

</div>
</div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
<div class="header-top-menu">
<ul class="nav navbar-nav notika-top-nav">
<li class="nav-item dropdown">
<a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-search"></i></span></a>
<div role="menu" class="dropdown-menu search-dd animated flipInX">
<div class="search-input">
<i class="notika-icon notika-left-arrow"></i>
<input type="text" />
</div>
</div>
</li>
 <li class="nav-item dropdown">
<a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-edit"><span style="font-size:14px">Reorder</span></i></span></a>
<div role="menu" class="dropdown-menu message-dd animated zoomIn">
<div class="hd-mg-tt">
<h2>Messages</h2>
</div>
<div class="hd-message-info">
<a href="#">
<div class="hd-message-sn">
<div class="hd-message-img">
<img src="img/post/1.jpg" alt="" />
</div>
<div class="hd-mg-ctn">
<h3>David Belle</h3>
<p>Cum sociis natoque penatibus et magnis dis parturient montes</p>
</div>
</div>
</a>
</div>
<div class="hd-mg-va">
<a href="#">View All</a>
</div>
</div>
</li>
<li class="nav-item nc-al"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-alarm"></i></span><div class="spinner4 spinner-4"></div><div class="ntd-ctn"><span>3</span></div></a>
<div role="menu" class="dropdown-menu message-dd notification-dd animated zoomIn">
<div class="hd-mg-tt">
<h2>Notification</h2>
</div>
<div class="hd-message-info">
<a href="#">
<div class="hd-message-sn">
<div class="hd-message-img">
<img src="img/post/1.jpg" alt="" />
</div>
<div class="hd-mg-ctn">
<h3>David Belle</h3>
<p>Cum sociis natoque penatibus et magnis dis parturient montes</p>
</div>
</div>
</a>
</div>
<div class="hd-mg-va">
<a href="#">View All</a>
</div>
</div>
</li>
<li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-support"></i></span></a>
  <div role="menu" class="dropdown-menu message-dd chat-dd animated zoomIn">
    <div class="hd-mg-tt">
    <h2>Account Settings</h2>
    </div>
      <div class="hd-message-info">
        <a href="#">
          <div class="hd-message-sn">
            <div class="hd-mg-ctn">
              <h3><?php echo $username ?></h3>
                <p>Administrator</p>
            </div>
          </div>
        </a>
        <a href="#">
          <div class="hd-message-sn">
            <div class="hd-mg-ctn">
              <h3>Logout</h3>
            </div>
          </div>
        </a>
      </div>
  </div>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
