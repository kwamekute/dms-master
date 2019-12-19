<div class="breadcomb-area">

<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="breadcomb-list">
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="breadcomb-wp">
<div class="breadcomb-icon">
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add New Part</button>
</div>
<div class="breadcomb-ctn">
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
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
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="data-table-list">
<div class="basic-tb-hd">
<h2>Inventory List</h2>
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


<!--Beginning of Add New Parts Modal -->
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Part</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" method="post" action="add_part.php" enctype='multipart/form-data'>
        <div class="form-group">
          <label class="control-label col-lg-3" for="price">Part No.</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="price" name="part_no" placeholder="Enter Part No." required>  
          </div>
        </div>
                
        <div class="form-group">
          <label class="control-label col-lg-3" for="name">Part Name</label>
          <div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="id" required>  
            <input type="text" class="form-control" id="name" name="part_name" placeholder="Enter Part Name" required>  
          </div>
        </div> 
        <div class="form-group">
              <label class="control-label col-lg-3" >Unit of Measurement</label>
              <div class="col-lg-9">
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
              </div><!-- /.input group -->
              </div><!-- /.form group -->


        <div class="form-group">
          <label class="control-label col-lg-3" for="file">Supplier</label>
          <div class="col-lg-9">
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
        <?php ?>
        <div class="form-group">
          <label class="control-label col-lg-3" for="price">Retail Price(Exc)</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="price" name="part_price_retail" placeholder="Enter Part Unit Price" required>  
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-lg-3" for="price">Retail Price(Inc)</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="price" name="part_price_exc" placeholder="" disabled >  
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-lg-3" for="price">Cost Price(Exc)</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="price" name="part_cost_price" placeholder="Enter Cost Price" required>  
          </div>
        </div>
      
           
              <div class="form-group">
              <label class="control-label col-lg-3" >Category</label>
              <div class="col-lg-9">
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
              </div><!-- /.input group -->
              </div><!-- /.form group -->

              <div class="form-group">
              <label class="control-label col-lg-3" >Unit of Measurement</label>
              <div class="col-lg-9">
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
              </div><!-- /.input group -->
              </div><!-- /.form group -->

             
              <div class="form-group">
              <label class="control-label col-lg-3" >Manufacturer</label>
              <div class="col-lg-9">
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
              </div><!-- /.input group -->
              </div><!-- /.form group -->
              <div class="form-group">
              <label class="control-label col-lg-3" >Model for part</label>
              <div class="col-lg-9">
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
              </div><!-- /.input group -->
              </div><!-- /.form group -->
              <div class="form-group">
          <label class="control-label col-lg-3" for="price">Initial Quantity</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="price" name="initial_qty" placeholder="Enter Initial Quantity" required>  
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-lg-3" for="price">Reorder</label>
          <div class="col-lg-9">
            <input type="number" class="form-control" id="price" name="reorder" placeholder="Enter Reorder Point"  required>  
          </div>
        </div>


        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add New Part</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>
 <!-- End of Modal -->