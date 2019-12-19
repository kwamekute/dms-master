
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
<?php include 'inventorynav.php' ?>

<div class="sale-statistic-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
        <div class="sale-statistic-inner notika-shadow mg-tb-30">

  <form method="post">
      <div class="form-element-list mg-t-30">
          <div class="cmp-tb-hd">
          <h2>Add New Stock</h2>
          </div>
          <div id="results"></div>
          <div class="col-md-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                </div>
                <div class="nk-int-st">
                  <select class="form-control" name="product">
                    <option value="0">Select Product</option>
                    <?php
                      $response = $user_info ->getallproducts($branch_id);
                      if ($response['response']) {

                        for ($i=0; $i < count($response['data']); $i++) {
                                  $data = $response['data'][$i];
                                  $part_id = $data['part_id'];
                                  $part_name = $data['part_name'];
                                  ?>
                                  <option value="<?php echo $part_id ?>"><?php echo $part_name ?></option>
                                  <?php
                             }
                         }
                    ?>

                  </select>
                </div>
              </div>
          </div>

          <div class="col-md-12">
              <div class="form-group ic-cmp-int float-lb floating-lb">
                <div class="form-ic-cmp">
                </div>
                <div class="nk-int-st">
                  <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity">
                </div>
              </div>
          </div>
          <div class="col-md-12">
              <div class="form-group ic-cmp-int float-lb floating-lb">
                <div class="form-ic-cmp">
                <button type="submit" name="add" id="add" class="btn btn-success orange-icon-notika waves-effect">
                 save
                </button>
                </div>
                <div class="form-ic-cmp">
                <button  type="submit" name="clear" id="clear" class="btn btn-warning orange-icon-notika waves-effect">
                 Clear
                </button>
                </div>
              </div>
          </div>

       </div>
</form>
        </div>
      </div>

      <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
      <div class="data-table-list">
      <div class="basic-tb-hd">
      <h2>Product Stockin List</h2>
      </div>
      <div class="table-responsive">
        <?php

        $response = $user_info ->viewprodstock($branch_id);
        if($response['response']){
                            ?>
        <table id="data-table-basic" class="table table-striped">

        <thead>
          <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Supplier</th>
            <th>Date Delivered</th>
          </tr>
        </thead>
        <tbody>
          <?php
            for($i=0;$i < count($response['data']);$i++){
                $data = $response['data'][$i];
                $supplier_id = $data['part_name'];
                $supplier_name = $data['supplier_name'];
                $supplier_address = $data['qty'];
                $dt = $data['date'];
                $date          = date("jS F Y ", strtotime($dt));
           ?>

                    <td><?php echo $data['part_name'] ?></td>
                    <td><?php echo $data['qty'] ?></td>
                    <td><?php echo $data['supplier_name'] ?></td>
                    <td><?php echo $date ?></td>

                  </tr>
               <?php
            }
              ?>
              </tbody>
          <tfoot>
            <tr>
              <th>Product Name</th>
              <th>Quantity</th>
              <th>Supplier</th>
              <th>Date Delivered</th>
            </tr>
          </tfoot>
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
<?php include 'js.php'?>
<?php
if (isset($_POST['edit'])) {
// Now call set info

    $supplier = preg_replace("#[^0-9a-zA-Z-' ]#", "", $_POST['supplier']);
    $ssname = preg_replace("#[^0-9a-zA-Z-' ]#", "", $_POST['ssname']);
    $ssadderss = preg_replace("#[^0-9a-zA-Z-.,/' ]#", "", $_POST['ssaddress']);
    $ssnumber = preg_replace("#[^0-9]#", "", $_POST['ssnumber']);
    // send data
    $result = $user_info->editsupplier($ssname,$ssadderss,$ssnumber,$branch_id,$supplier);
   if ($result['response']) {
     ?>
     <script>toastr.success("Supplier Info Edited Successfully");</script>
     <?php
   }else{
     ?>
     <script>alert("ERROR: Could not update");</script>
     <?php
   }
}

if (isset($_POST['add'])) {
// Now call set info

    $quantity = preg_replace("#[^0-9]#", "", $_POST['quantity']);
    $product = preg_replace("#[^0-9]#", "", $_POST['product']);
    // send data
    $result = $user_info->stockin($quantity,$product,$branch_id);
   if ($result['response']) {
     ?>
     <script>toastr.success("Successfully added new stock");</script>
     <?php
   }else{
     ?>
     <script>alert("ERROR: Could not excute instruction");</script>
     <?php
   }
}
?>

<script>
$(document).ready(function(){
  $("#add").click(function(e){
          var quantity         = $("#quantity").val();
          if(quantity == ""){
             toastr.error("Please Enter Number of Quantity");
             return false;
          }else{

            return true;
          }

  });

});
</script>

</html>
