
<?php include 'title.php';?>

<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Home | <?php echo TITLE;?></title>
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
<?php //include 'mainnav.php' ?>

<div class="notika-status-area" style="margin-top:3em;">
<div class="container">
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
        <div class="website-traffic-ctn">
          <h2><span>Inventory</span></h2>
            <p>Enquiries/Purchase Orders/Reciept Docs.</p>
        </div>
       <div><i class="fa fa-cart-plus" style="font-size:50px; color:#99ccff"></i></div>
      </div>
      <a href="inventory.php"> <button class="btn btn-warning btn-icon-notika waves-effect" style="border:none; border-radius:0px; background:#99ccff">Go <i class="notika-icon notika-right-arrow"></i></button></a>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
        <div class="website-traffic-ctn">
            <h2><span >Financials</span></h2>
              <p>General Ledgers/Payments</p>
        </div>
      <div><i class="fa fa-money" style="font-size:50px; color:#ffbf80;"></i></div>
      </div>
      <button class="btn btn-warning btn-icon-notika waves-effect" style="border:none; border-radius:0px; background:#ffbf80">Go <i class="notika-icon notika-right-arrow"></i></button>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
        <div class="website-traffic-ctn">
            <h2><span>Service</span></h2>
            <p>Service History/New service/Receivables</p>
        </div>
      <div><i class="fa fa-cog" style="font-size:50px; color:#ff66a3;"></i></div>
      </div>
      <button class="btn btn-warning btn-icon-notika waves-effect" style="border:none; border-radius:0px; background:#ff66a3">Go <i class="notika-icon notika-right-arrow"></i></button>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
        <div class="website-traffic-ctn">
            <h2><span>Mgmt. Ctrls.</span></h2>
            <p>Staff Operations / admin management/ customers</p>
        </div>
      <div><i class="fa fa-user" style="font-size:50px;color:#d633ff;"></i></div>
      </div>
      <button class="btn btn-warning btn-icon-notika waves-effect" style="border:none; border-radius:0px; background:#d633ff">Go <i class="notika-icon notika-right-arrow"></i></button>
    </div>

</div>
</div>
</div>


<div class="sale-statistic-area">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-10 col-xs-12">
<div class="sale-statistic-inner notika-shadow mg-tb-30">
<div class="curved-inner-pro">
<div class="curved-ctn">
<h2>Business Intelligence</h2>
<p>As you database grows get deep insights, through data visualization and analytics.</p>
<p>Coming soon...</p>
</div>
</div>
<div id="curved-line-chart" class="flot-chart-sts flot-chart"></div>
</div>
</div>

</div>
</div>
</div>





<?php include 'footer.php'?>
<?php include 'js.php' ?>

</html>
