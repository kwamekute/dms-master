<?php
ob_start();
$link = $_SERVER['DOCUMENT_ROOT'];
include '../e_lib/connect.php';

if(!isset($_COOKIE['_s']) && !isset($_COOKIE['_r'])){
    header('location: ../login/login-register.php');
}
$username = preg_replace("#[^0-9a-zA-Z-., ]#","",$_COOKIE['_s']);
?>

<!doctype html>
<html class="no-js" lang="">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Dashboard One | Notika - Notika Admin Template</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php include 'css.php' ?>
</head>
<body>
<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

<?php include 'topnav.php' ?>
<?php include 'mobilenav.php' ?>
<?php include 'mainnav.php' ?>

<div class="breadcomb-area">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="breadcomb-list">
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="breadcomb-wp">
<div class="breadcomb-icon">
<i class="notika-icon notika-windows"></i>
</div>
<div class="breadcomb-ctn">
<h2>Users Table</h2>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
<div class="breadcomb-report">
<button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="notika-icon notika-sent"></i></button>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="data-table-area">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="data-table-list">
<div class="basic-tb-hd">
<h2>All Users</h2>
</div>
<div class="table-responsive">
  <?php

  $response = $user_info ->allusers();
  if($response['response']){
                      ?>
  <table id="data-table-basic" class="table table-striped">
  <thead>
    <tr>
      <th>Username</th>
      <th>Name</th>
      <th>Role</th>
      <th>Branch Name</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
      for($i=0;$i < count($response['data']);$i++){
          $data = $response['data'][$i];
          $branch_id = $data['branch_id'];
          $branch_name = $user_info-> getcompaniesByid($branch_id)['branch_name'];
          $role = $data['role'];
          $status = $data['status'];
     ?>
              <td><?php echo $data['username'] ?></td>
              <td><?php echo $data['name'] ?></td>
              <td>
                <?php
                if($role == 1){
                  ?>
                    <span class="btn btn-sm btn-info">Admin</span>
                    <?php
                }else{
                  ?>
                    <span class="btn btn-sm btn-warning">staff</span>
                    <?php
                }
                 ?>
              </td>
              <td><?php echo $branch_name; ?></td>
              <td><?php ?>  <span class="btn btn-sm btn-success"><?php echo $status ?> </span><?php ?>
               </td>

              </tr>
         <?php
      }
        ?>
  </table>
  <?php
  }
?>
</div>
</div>
</div>
</div>
</div>
</div>



<?php include 'footer.php'?>


<?php include 'js.php' ?>

</html>
