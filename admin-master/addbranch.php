
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
    $name = preg_replace("#[^0-9a-zA-z-. ]#","",$_POST['name']);
    $address = preg_replace("#[^0-9a-zA-z-.,/@ ]#","",$_POST['address']);
    $motto = preg_replace("#[^0-9a-zA-z-., ]#","",$_POST['motto']);
    $contact = preg_replace("#[^0-9]#","",$_POST['contact']);
    $skin = preg_replace("#[^a-zA-Z]#","",$_POST['skin']);

    if (!empty($name) && !empty($address) && !empty($motto) && !empty($contact)) {
    // send data
    $result = $user_info->addbranch($name,$address,$contact,$skin,$motto,$main);

  }
}
?>
  <form method="post">
    <div class="col-lg-12 col-md-8 col-sm-12 col-xs-12">
      <div class="form-element-list mg-t-30">
          <div class="cmp-tb-hd">
          <h2>Add Branch Company</h2>
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
                    $response = $user_info ->getcompanies();
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
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                  <input type="text" class="form-control" name="name" placeholder="Branch Name">
                </div>
              </div>
          </div>

          <div class="col-md-7">
              <div class="form-group ic-cmp-int float-lb floating-lb">
                <div class="form-ic-cmp">
                <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                  <input type="text" class="form-control" name="address" placeholder="Company Address">
                </div>
              </div>
          </div>

          <div class="col-md-7">
              <div class="form-group ic-cmp-int float-lb floating-lb">
                <div class="form-ic-cmp">
                <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                  <input type="number" class="form-control" name="contact" placeholder="Company Contact">
                </div>
              </div>
          </div>

          <div class="col-md-7">
              <div class="form-group ic-cmp-int float-lb floating-lb">
                <div class="form-ic-cmp">
                <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                  <input type="text" class="form-control" name="motto" placeholder="Motto">
                </div>
              </div>
          </div>

          <div class="col-md-7">
              <div class="form-group ic-cmp-int float-lb floating-lb">
                <div class="form-ic-cmp">
                <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                <select class="form-control" name="skin">
                  <option value="0">Select Skin</option>
                  <option value="red">Red</option>
                </select>
                </div>
              </div>
          </div>

          <div class="col-md-7">
              <div class="form-group ic-cmp-int float-lb floating-lb">
                <div class="form-ic-cmp">
                <button  type="submit" name="add" class="btn btn-success orange-icon-notika waves-effect">
                  <i class="notika-icon notika-checked"></i> Add Branch
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


<?php include 'js.php' ?>

</html>
