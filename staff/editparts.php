
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
      <div class="col-lg-9 col-md-5 col-sm-7 col-xs-12">
        <div class="sale-statistic-inner notika-shadow mg-tb-30">
<?php
if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $supplier_id = $user_info->viewpartsbyID($id)["supplier_id"];
  $supplier_name = $user_info->viewsupplierBYID($supplier_id)["supplier_name"];
  $cat_id = $user_info->viewpartsbyID($id)['cat_id'];
  $cat_name = $user_info->cat_name($cat_id)["cat_name"];
  $model_for_id = $user_info->viewpartsbyID($id)['model_for_id'];
  $model = $user_info->getmodelBYID($model_for_id)["model"];
}
?>
  <form method="post" enctype="multipart/form-data">
    <div class="col-lg-12 col-md-8 col-sm-12 col-xs-12">
      <div class="form-element-list mg-t-30">
          <div class="cmp-tb-hd">
          <h2>Edit Part</h2>
          </div>
           <input type="text" class="form-control" name="part_id" value="<?php echo $id ?>" id="part_id" style="display:none;" >
          <div class="form-group ic-cmp-int">
          <b>  Part Number</b>
            <div class="nk-int-st">
              <input type="text" class="form-control" name="patno" id="patno" value="<?php echo $partno = $user_info->viewpartsbyID($id)["part_no"]; ?>" placeholder="Part No" >
            </div>
          </div>
          </div>

          <div class="col-md-12">
          <div class="form-group ic-cmp-int float-lb floating-lb">
          <b>Part Name</b>
            <div class="nk-int-st">
              <input type="text" class="form-control" name="patname" id="patname" value="<?php echo $partno = $user_info->viewpartsbyID($id)["part_name"]; ?>" placeholder="Part Name">
            </div>
          </div>
          </div>

          <div class="col-md-12">
          <div class="form-group ic-cmp-int">
            <b>Description</b>
            <div class="nk-int-st">
              <input type="text" class="form-control" name="des" id="des" value="<?php echo $partno = $user_info->viewpartsbyID($id)["part_desc"]; ?>" placeholder="Part description">
            </div>
          </div>
          </div>

          <div class="col-md-12">
          <div class="form-group ic-cmp-int">
            <b>Supplier</b>
            <div class="nk-int-st">
              <select name="supplier" class="form-control">
                <option value="<?php echo $partno = $user_info->viewpartsbyID($id)["supplier_id"]; ?>"><?php echo $supplier_name ?></option>
                <?php
                $response = $user_info ->viewsupplier($branch_id);
                  if($response['response']){
                    for($i=0;$i < count($response['data']);$i++){
                        $data = $response['data'][$i];
                        $supplier_id = $data['supplier_id'];
                        $supplier_name = $data['supplier_name'];
                  ?>
                  <option value="<?php echo $data['supplier_id'] ?> "><?php echo $data['supplier_name'] ?> </option>
                <?php
              }
            }
                ?>
              </select>
            </div>
          </div>
          </div>

          <div class="col-md-12">
          <div class="form-group ic-cmp-int">
            <b>Price</b>
            <div class="nk-int-st">
              <input type="number" class="form-control" name="price" id="price" value="<?php echo $part_price = $user_info->viewpartsbyID($id)["part_price"]; ?>"  placeholder="Price">
            </div>
          </div>
          </div>

          <div class="col-md-12">
          <div class="form-group ic-cmp-int">
            <b>Category</b>
            <div class="nk-int-st">
              <select name="cat" class="form-control">
                <option value="<?php echo $data["cat_id"]; ?>"><?php echo $cat_name ?></option>
                <?php
                $response = $user_info ->cat();
                  if($response['response']){
                    for($i=0;$i < count($response['data']);$i++){
                        $data = $response['data'][$i];
                        $cat_id = $data['cat_id'];
                        $cat_name = $data['cat_name'];
                  ?>
                  <option value="<?php echo $data['cat_id'] ?> "><?php echo $data['cat_name'] ?> </option>
                <?php
              }
            }
                ?>
              </select>
            </div>
          </div>
          </div>

          <div class="col-md-12">
          <div class="form-group ic-cmp-int">
            <b>Model for Parts</b>
            <div class="nk-int-st">
              <select name="model" class="form-control">
                <option value="<?php echo $data["model_for_id"]; ?>"><?php echo $model ?></option>
                <?php
                $response = $user_info ->getmodel();
                  if($response['response']){
                    for($i=0;$i < count($response['data']);$i++){
                        $data = $response['data'][$i];
                        $model_id = $data['model_id'];
                        $manufact_name = $data['manufact_name'];
                        $model = $data['model'];
                  ?>
                  <option value="<?php echo $data['model_id'] ?> "><?php echo $data['manufact_name'] ?> <?php echo $data['model'] ?> </option>
                <?php
              }
            }
                ?>
              </select>
            </div>
          </div>
          </div>

          <div class="col-md-12">
          <div class="form-group ic-cmp-int">
            <b>Reoder</b>
            <div class="nk-int-st">
              <input type="number" class="form-control" name="reorder" id="reorder"  value="<?php echo $part_price = $user_info->viewpartsbyID($id)["reorder"]; ?>" placeholder="Reorder">
            </div>
          </div>
          </div>

          </div>

          <div class="col-md-7">
              <div class="form-group ic-cmp-int float-lb floating-lb">
                <div class="form-ic-cmp">
                <button  type="submit" name="edit" class="btn btn-success orange-icon-notika waves-effect">
                 Save Update
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
<?php
if (isset($_POST['edit'])) {
    $part_id = preg_replace("#[^0-9]#", "", $_POST['part_id']);
    $patno = preg_replace("#[^0-9]#", "", $_POST['patno']);
    $patname = preg_replace("#[^0-9a-zA-Z-.,' ]#", "", $_POST['patname']);
    $des = preg_replace("#[^0-9a-zA-Z-.,/' ]#", "", $_POST['des']);
    $price = preg_replace("#[^0-9.]#", "", $_POST['price']);
    $reorder = preg_replace("#[^0-9]#", "", $_POST['reorder']);
    $supplier = preg_replace("#[^0-9]#", "", $_POST['supplier']);
    $cat = preg_replace("#[^0-9]#", "", $_POST['cat']);
    $model = preg_replace("#[^0-9a-zA-Z ]#", "", $_POST['model']);

    //$upper_case = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; $lower_case = "abcdefghijklmnopqrstuvwxyz"; $numbers = "0123456789";
    ////$gen_uppr_case = substr(str_shuffle($upper_case), 0,1);$gen_lower_case = substr(str_shuffle($lower_case), 0,1);
    //$gen_num = substr(str_shuffle($numbers), 0,1);$mixed = "$gen_uppr_case$gen_lower_case$gen_num";
    //$m_id = substr(str_shuffle($mixed), 0,3);
    //$date = Date('m');
    //$mem_id = $m_id.$date;
    //$prod = explode(".", $_FILES['prod']['name']);
  //  $prod_img_1 = $mem_id.'.'.end($prod);
    //upload logo
    //$moveimg = move_uploaded_file($_FILES['prod']['tmp_name'], 'prodimages/'.$prod_img_1);
    $part_qty = '';
    // send data
    $result = $user_info->editparts($patname,$des,$price,$cat,$part_id,$branch_id,$reorder,$supplier,$patno,$model);
   if ($result['response']) {
     ?>
     <script>alert("Parts Updated Successfully");</script>
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

  function readURL(input) {

       if (input.files && input.files[0]) {
           var reader = new FileReader();

           reader.onload = function (e) {
               $('#prod-img-tag').attr('src', e.target.result);
           }
           reader.readAsDataURL(input.files[0]);
       }
     }
     $("#prod").change(function(){
         readURL(this);
});

  $("#save").click(function(e){
          var patno         = $("#patno").val();
          var patname       = $("#patname").val();
          var des           = $("#des").val();
          var price         = $("#price").val();
          var reorder       = $("#reorder").val();
          var prod          = $("#prod").val();
          if(patno == ""){
             toastr.error("Please Enter Part Number");
             return false;
          }else if(patname == ""){
            toastr.error("Please Enter Part Name");
             return false;
          }else if(des == ""){
            toastr.error("Please Enter Description");
             return false;
          }else if(price == ""){
            toastr.error("Please Enter Price");
             return false;
          }else if(reorder == ""){
            toastr.error("Please Enter Reorder limit");
             return false;
          }else{
            return true;
          }

  });

});
</script>

</html>
