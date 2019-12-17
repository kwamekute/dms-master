
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

<div class="sale-statistic-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-5 col-sm-7 col-xs-12">
        <div class="sale-statistic-inner notika-shadow mg-tb-30">
<?php
if (isset($_POST['add'])) {
// Now call set info
    $main = preg_replace("#[^0-9]#","",$_POST['main']);
    $name = preg_replace("#[^0-9a-zA-z-. ]#","",$_POST['fullname']);
    $role = preg_replace("#[^0-9]#","",$_POST['role']);
    $password =  md5($_POST['password']);
    $username = preg_replace("#[^0-9a-zA-z-., ]#","",$_POST['username']);
    if (!empty($name) && $role !="" && !empty($password) && !empty($username)) {
    // send data
    $result = $user_info->adduser($username,$password,$name,$role,$main);
   if ($result['response']) {
     ?>
     <script>toastr.success("successfully added a User");</script>
     <?php
   }else{
     ?>
     <script>toastr.error("Ooops something happend");</script>
     <?php
   }
  }
}
?>
  <form method="post">
    <div class="col-lg-12 col-md-8 col-sm-12 col-xs-12">
      <div class="form-element-list mg-t-30">
          <div class="cmp-tb-hd">
          <h2>Make Enquiry</h2>
          </div>



          <div class="col-md-7">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                  <input type="text" class="form-control" name="username" placeholder="username">
                </div>
              </div>
          </div>

          <div class="col-md-7">
              <div class="form-group ic-cmp-int float-lb floating-lb">
                <div class="form-ic-cmp">
                <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                  <input type="password" class="form-control" name="password" placeholder="password">
                </div>
              </div>
          </div>

          <div class="col-md-7">
              <div class="form-group ic-cmp-int float-lb floating-lb">
                <div class="form-ic-cmp">
                <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                  <input type="text" class="form-control" name="fullname" placeholder="FUll Name">
                </div>
              </div>
          </div>
          <div class="col-md-7">
              <div class="form-group ic-cmp-int float-lb floating-lb">
                <div class="form-ic-cmp">
                <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                <select class="form-control" name="role">
                  <option value=" ">Select Role</option>
                  <option value="1">Admin</option>
                  <option value="0">Staff</option>
                </select>
                </div>
              </div>
          </div>
          <div class="col-md-7">
              <div class="form-group ic-cmp-int float-lb floating-lb">
                <div class="form-ic-cmp">
                <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                <select class="form-control" name="main">
                  <option value="0">Select Main Company</option>
                  <?php
                    $response = $user_info ->getallcompanies();
                    if ($response['response']) {

                      for ($i=0; $i < count($response['data']); $i++) {
                                $data = $response['data'][$i];
                                $branch_id = $data['branch_id'];
                                $branch_name = $data['branch_name'];
                                ?>
                                <option value="<?php echo $branch_id ?>"><?php echo $branch_name ?></option>
                                <?php
                           }
                       }
                  ?>

                </select>
                </div>
              </div>
          </div>

          <div class="col-md-7">
              <div class="form-group ic-cmp-int float-lb floating-lb">
                <div class="form-ic-cmp">
                <button  type="submit" name="add" class="btn btn-success orange-icon-notika waves-effect">
                 Add User
                </button>
                </div>
              </div>
          </div>

       </div>
   </div>
</form>
        </div>
      </div>
    </div>
  </div>
</div>



<?php include 'footer.php'?>
<?php include 'js.php'?>


</html>
