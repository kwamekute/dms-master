
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
          <h2>Category</h2>
          </div>
          <div id="results"></div>

          <div class="col-md-12">
              <div class="form-group ic-cmp-int float-lb floating-lb">
                <div class="form-ic-cmp">
                </div>
                <div class="nk-int-st">
                  <input type="text" class="form-control" name="catname" id="catname" placeholder="Category" >
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
      <h2>Category List</h2>
      </div>
      <div class="table-responsive">
        <?php

        $response = $user_info ->viewcat();
        if($response['response']){
                            ?>
        <table id="data-table-basic" class="table table-striped">

        <thead>
          <tr>
            <th>Unit</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            for($i=0;$i < count($response['data']);$i++){
                $data = $response['data'][$i];
           ?>      <tr>
                    <td><?php echo $data['cat_name'] ?></td>
                    <td><a href="javascript:void()" id="<?php echo $data['cat_id']; ?>" class="btn btn-warning btn-sm m-1" data-toggle="modal" data-target="#myModal<?php echo $data['cat_id']; ?>" data-backdrop="static" data-keyboard="false"><i class="fa fa-pencil"></i></a></td>
                  </tr>
                  <div id="myModal<?php echo $data['cat_id']; ?>" class="modal fade" role="dialog">

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
                                                  <h2>Edit Category Name</h2>
                                                  <input type="text" name="cat_id" id="cat_id" value="<?php echo $data['cat_id']; ?>" style="display:none;"/>
                                                  </div>
                                                  <div id="results"></div>
                                                  <div class="col-md-12">
                                                      <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                        </div>
                                                        <div class="nk-int-st">
                                                          <input type="text" class="form-control" name="catname" id="catname" value="<?php echo $data['cat_name'] ?>" placeholder="Category" >
                                                        </div>
                                                      </div>
                                                  </div>
                                               </div>
                                           </div>
                                                <div class="modal-footer">
                                                  <button type="submit" name="edit" class="btn btn-warning">Save</button>
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
              <th>Unit</th>
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
<?php include 'footer.php'?>
<?php include 'js.php'?>
<?php

if (isset($_POST['edit'])) {
// Now call set info
    $cat_id = preg_replace("#[^0-9]#", "", $_POST['cat_id']);
    $catname = preg_replace("#[^a-zA-Z-' ]#", "", $_POST['catname']);
    // send data
    $result = $user_info->updatecat($cat_id,$catname);
    if ($result['response']) {
     ?>
     <script>toastr.success("Successfully Update Category");</script>
     <?php
    }else{
     ?>
     <script>toastr.error("ERROR: Could not Update Category");</script>
     <?php
    }
}

if (isset($_POST['add'])) {
// Now call set info
    $catname = preg_replace("#[^a-zA-Z-' ]#", "", $_POST['catname']);
    // send data
    $result = $user_info->addcat($catname);
    if ($result['response']) {
     ?>
     <script>toastr.success("Successfully Added New Category");</script>
     <?php
    }else{
     ?>
     <script>toastr.error("ERROR: Could not Add Category");</script>
     <?php
    }
}
?>

<script>
$(document).ready(function(){
  $("#add").click(function(e){
          var catname         = $("#catname").val();
          if(catname == ""){
             toastr.error("Please Enter Category Name");
             return false;
          }else{

            return true;
          }

  });

});
</script>

</html>
