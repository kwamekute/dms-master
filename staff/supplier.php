
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
          <h2>Add New Suppier</h2>
          </div>
          <div id="results"></div>
          <div class="col-md-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                  <input type="text" class="form-control" name="sname" id="sname" placeholder="Supplier Name">
                </div>
              </div>
          </div>

          <div class="col-md-12">
              <div class="form-group ic-cmp-int float-lb floating-lb">
                <div class="form-ic-cmp">
                <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                  <input type="text" class="form-control" name="saddress" id="saddress" placeholder="Supplier Address">
                </div>
              </div>
          </div>

          <div class="col-md-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                  <input type="number" class="form-control" name="snumber" id="snumber" placeholder="Supplier Contact">
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
      <h2>All Suppliers</h2>
      </div>
      <div class="table-responsive">
        <?php

        $response = $user_info ->viewsupplier($branch_id);
        if($response['response']){
                            ?>
        <table id="data-table-basic" class="table table-striped">

        <thead>
          <tr>
            <th>Supplier Name</th>
            <th>Supplier Address</th>
            <th>supplier_contact</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            for($i=0;$i < count($response['data']);$i++){
                $data = $response['data'][$i];
                $supplier_id = $data['supplier_id'];
                $supplier_name = $data['supplier_name'];
                $supplier_address = $data['supplier_address'];
                $supplier_contact = $data['supplier_contact'];
           ?>

                    <td><?php echo $data['supplier_name'] ?></td>
                    <td><?php echo $data['supplier_address'] ?></td>
                    <td><?php echo $data['supplier_contact'] ?></td>
                    <td><a href="javascript:void()" id="<?php echo $data['supplier_id']; ?>" class="btn btn-warning m-1" data-toggle="modal" data-target="#myModal<?php echo $data['supplier_id']; ?>" data-backdrop="static" data-keyboard="false"> Edit Details</a></td>
                    </tr>
                    <div id="myModal<?php echo $data['supplier_id']; ?>" class="modal fade" role="dialog">

                                          <div class="modal-dialog modal-sm">

                                            <!-- Modal content-->
                                            <form method="post">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"></h4>
                                              </div>
                                              <div class="modal-body" >
                                                <div id="result"></div>
                                                <div class="form-element-list mg-t-30">
                                                    <div class="cmp-tb-hd">
                                                    <h2>Edit Suppier</h2>
                                                    <input type="text" name="supplier" id="supplier_id" value="<?php echo $data['supplier_id']; ?>" style="display:none;"/>
                                                    </div>
                                                    <div id="results"></div>
                                                    <div class="col-md-12">
                                                        <div class="form-group ic-cmp-int">
                                                          <div class="form-ic-cmp">
                                                          <i class="notika-icon notika-support"></i>
                                                          </div>
                                                          <div class="nk-int-st">
                                                            <input type="text" class="form-control" name="ssname" id="sname" value="<?php echo $supplier_name ?>">
                                                          </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group ic-cmp-int float-lb floating-lb">
                                                          <div class="form-ic-cmp">
                                                          <i class="notika-icon notika-support"></i>
                                                          </div>
                                                          <div class="nk-int-st">
                                                            <input type="text" class="form-control" name="ssaddress" id="saddress" value="<?php echo $data['supplier_address'] ?>" placeholder="Supplier Address">
                                                          </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group ic-cmp-int">
                                                          <div class="form-ic-cmp">
                                                          <i class="notika-icon notika-support"></i>
                                                          </div>
                                                          <div class="nk-int-st">
                                                            <input type="number" class="form-control" name="ssnumber" id="snumber" value="<?php echo $data['supplier_contact'] ?>" placeholder="Supplier Contact">
                                                          </div>
                                                        </div>
                                                    </div>
                                                 </div>
                                             </div>
                                                  <div class="modal-footer">
                                                    <button type="submit" name="edit" class="btn btn-warning">Update Information</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div>
                                            </div>
                                            </form>
                                      </div>
                                    </div>

               <?php
            }
              ?>
              </tbody>
          <tfoot>
            <tr>
              <th>Supplier Name</th>
              <th>Supplier Address</th>
              <th>supplier_contact</th>
              <th>Action</th>
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
     <script>alert("Supplier Info Edited Successfully");</script>
     <?php
   }else{
     ?>
     <script>alert("ERROR: Could not update");</script>
     <?php
   }
}
?>
<?php include 'footer.php'?>
<?php include 'js.php'?>
<script>
$(document).ready(function(){
  $("#add").click(function(e){
          var sname         = $("#sname").val();
          var saddress      = $("#saddress").val();
          var snumber       = $("#snumber").val();
          if(sname == ""){
             toastr.error("Please Enter Suppliers Name");
             return false;
          }else if(saddress == ""){
            toastr.error("Please Enter Suppliers Address");
             return false;
          }else if(snumber == ""){
            toastr.error("Please Enter Suppliers Number");
             return false;
          }else{
            e.preventDefault();
            $.ajax({
                      method: "post",
                      url: "codes/addsupplier.php",
                      data: {sname:sname,saddress:saddress,snumber:snumber},
                      success: function(data){
                           var res = $('#results').html(data);
                           $("#sname").val('');
                           $("#sadderss").val('');
                           $("#snumber").val('');
                          if (data = 1) {
                            toastr.success("Successfully Added New Supplier");
                          }else{
                            toastr.error("Ooops there was an error. Please Try again");
                          }
                      }
                  })
            return true;
          }

  });

});
</script>

</html>
