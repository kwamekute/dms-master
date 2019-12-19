<?php include 'title.php';?>
<!doctype html>
<html class="no-js" lang="">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Inventory | <?php echo TITLE;?></title>
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
<?php include 'inventorynav.php' ?>

<div class="content container">
    
    <div class="row">
    	<div class="col-sm-12">
            <div class="panel with-nav-tabs panel-info">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                           <!-- <li class="active col-md-3"><a href="#tab1default" data-toggle="tab">Default 1</a></li>
                            <li class="col-md-3"><a href="#tab2default" data-toggle="tab">Default 2</a></li>
                            <li class="col-md-3"><a href="#tab3default" data-toggle="tab">Default 3</a></li>-->
                            <li class="active dropdown col-sm-3">
                                <a href="#" data-toggle="dropdown">Inventory Maintenance <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#tab1default" data-toggle="tab">View/Search Parts</a></li>
                                    <li><a href="#tab2default" data-toggle="tab">Add New Part</a></li>
                                </ul>
                            </li>
                            <li class="dropdown col-sm-3">
                                <a href="#" data-toggle="dropdown">Purchase Enquiry <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#tab3default" data-toggle="tab">View Enquiries</a></li>
                                    <li><a href="#tab4default" data-toggle="tab">Make New Enquiry</a></li>
                                </ul>
                            </li>
                            <li class="dropdown col-sm-3">
                                <a href="#" data-toggle="dropdown">Purchase Order <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#tab5default" data-toggle="tab">View Purchase Orders</a></li>
                                    <li><a href="#tab6default" data-toggle="tab">Make New Purchase order</a></li>
                                </ul>
                            </li>
                            <li class="dropdown col-sm-3">
                                <a href="#" data-toggle="dropdown">Receipt Documents <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#tab7default" data-toggle="tab">View Receipts </a></li>
                                    <li><a href="#tab8default" data-toggle="tab">Confirm New Receipts</a></li>
                                </ul>
                            </li>
                        </ul>
                        
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">   <?php include 'viewparts.php'?>  </div>
                        <div class="tab-pane fade" id="tab2default"><?php include 'addparts.php'?></div>
                        <div class="tab-pane fade" id="tab3default">Default 3</div>
                        <div class="tab-pane fade" id="tab4default">Default 4</div>
                        <div class="tab-pane fade" id="tab5default">Default 5</div>
                        <div class="tab-pane fade" id="tab6default">Default 6</div>
                        <div class="tab-pane fade" id="tab6default">Default 7</div>
                        <div class="tab-pane fade" id="tab6default">Default 8</div>

                    </div>
                </div>
            </div>
        </div>
      
	</div>
</div>




<?php include 'footer.php'?>
<?php include 'js.php'?>


</html>
