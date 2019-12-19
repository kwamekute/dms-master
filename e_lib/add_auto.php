<?php
ob_start();

class Add_companies extends User_login{

 public function addcompany($name,$address,$contact,$skin,$motto){
      $response = false; $main = '1';
         $inser = "insert into `branch` (branch_name,branch_address,branch_contact,skin,main_sub,motto) values(:branch_name,:branch_address,:branch_contact,:skin,:main_sub,:motto)";
         $run = $this ->link ->prepare($inser);
         $run ->bindParam(":branch_name",$name, PDO::PARAM_STR);
         $run ->bindParam(":branch_address",$address, PDO::PARAM_STR);
         $run ->bindParam(":branch_contact",$contact, PDO::PARAM_STR);
         $run ->bindParam(":skin",$skin, PDO::PARAM_STR);
         $run ->bindParam(":main_sub",$main, PDO::PARAM_STR);
         $run ->bindParam(":motto",$motto, PDO::PARAM_STR);
         $run ->execute();
         //print_r($run ->errorInfo());
         if($run ->rowCount()){
          $response = true;
          return array("response"=>$response);
         }else{
            return array("response"=>false);
         }
     }

      public function add_school_img($school_id,$hd){
         $response = false;
         $inser = "insert into `images` (sch_idn,img_path) values(:school_id,:images)";
         $run = $this ->link ->prepare($inser);
         $run ->bindParam(":school_id",$school_id, PDO::PARAM_STR);
         $run ->bindParam(":images",$hd[1], PDO::PARAM_STR);
         $run ->execute();
         //print_r($run ->errorInfo());
         if($run ->rowCount()){
          $response = true;
          return array("response"=>$response);
         }else{
          return array("response"=>false,"message"=>"Ooops could not Add school");
         }
     }

  public function getcompanies(){
    $response = false; $data = []; $main_sub = '1';
    $select = "SELECT `branch_id`,`branch_name`,`main_sub` FROM `branch` WHERE `main_sub`='$main_sub'";
    $run = $this->link->prepare($select);
    $run ->execute();
    //print_r($run ->errorInfo());
    if ($run->rowCount()) {
     $response = true;
     while ($info = $run->fetchObject()) {
        $branch_id = $info->branch_id;
        $branch_name = $info->branch_name;
        $data[] = array("branch_id"=>$branch_id,"branch_name"=>$branch_name);
      }
      return array("response"=>$response,"data"=>$data);
    }
  }

  public function getallcompanies(){
    $response = false; $data = []; $main_sub = '1';
    $select = "SELECT `branch_id`,`branch_name`,`main_sub` FROM `branch`";
    $run = $this->link->prepare($select);
    $run ->execute();
    //print_r($run ->errorInfo());
    if ($run->rowCount()) {
     $response = true;
     while ($info = $run->fetchObject()) {
        $branch_id = $info->branch_id;
        $branch_name = $info->branch_name;
        $data[] = array("branch_id"=>$branch_id,"branch_name"=>$branch_name);
      }
      return array("response"=>$response,"data"=>$data);
    }
  }

  public function getcompaniesByid($branch_id){
    $response = false; $branch_name = '';
    $select = "SELECT `branch_id`,`branch_name` FROM `branch` WHERE `branch_id`='$branch_id'";
    $run = $this->link->prepare($select);
    $run ->execute();
    //print_r($run ->errorInfo());
    if ($run->rowCount()) {
     $response = true;
     while ($info = $run->fetchObject()) {
        $branch_id = $info->branch_id;
        $branch_name = $info->branch_name;
      }
    }
    return array("response"=>$response,"branch_id"=>$branch_id,"branch_name"=>$branch_name);
  }

  public function addbranch($name,$address,$contact,$skin,$motto,$main){
       $response = false; $main_sub = '0';
          $inser = "insert into `branch` (branch_name,branch_address,branch_contact,skin,main_sub,motto) values(:branch_name,:branch_address,:branch_contact,:skin,:main_sub,:motto)";
          $run = $this ->link ->prepare($inser);
          $run ->bindParam(":branch_name",$name, PDO::PARAM_STR);
          $run ->bindParam(":branch_address",$address, PDO::PARAM_STR);
          $run ->bindParam(":branch_contact",$contact, PDO::PARAM_STR);
          $run ->bindParam(":skin",$skin, PDO::PARAM_STR);
          $run ->bindParam(":main_sub",$main_sub, PDO::PARAM_STR);
          $run ->bindParam(":motto",$motto, PDO::PARAM_STR);
          $run ->execute();
          $last_id = $this ->link ->LastInsertId();
          //print_r($run ->errorInfo());
          if($run ->rowCount()){
           $response = true;
           $this ->sendbranch($main,$last_id);
          }
      }

      public function sendbranch($main,$last_id){
           $response = false;
              $inser = "insert into `main_sub_branches` (main_id,sub_id) values(:main_id,:sub_id)";
              $run = $this ->link ->prepare($inser);
              $run ->bindParam(":main_id",$main, PDO::PARAM_STR);
              $run ->bindParam(":sub_id",$last_id, PDO::PARAM_STR);
              $run ->execute();
              //print_r($run ->errorInfo());
              if($run ->rowCount()){
               $response = true;
               ?>
               <script>toastr.success("successfully added a company");</script>
               <?php
             }else{
               ?>
               <script>toastr.error("Ooops something happend");</script>
               <?php
             }

          }

    public function adduser($username,$password,$name,$role,$main){
      $response = false; $status = 'active';
         $inser = "insert into `user` (username,password,name,status,role,branch_id) values(:username,:password,:name,:status,:role,:branch_id)";
         $run = $this ->link ->prepare($inser);
         $run ->bindParam(":username",$username, PDO::PARAM_STR);
         $run ->bindParam(":password",$password, PDO::PARAM_STR);
         $run ->bindParam(":name",$name, PDO::PARAM_STR);
         $run ->bindParam(":status",$status, PDO::PARAM_STR);
         $run ->bindParam(":role",$role, PDO::PARAM_STR);
         $run ->bindParam(":branch_id",$main, PDO::PARAM_STR);
         $run ->execute();
         //print_r($run ->errorInfo());
         if($run ->rowCount()){
          $response = true;
          return array("response"=>$response);
        }else{
          return array("response"=>false);
        }
    }

    public function allusers(){
      $response = false; $data = [];
      $select = "SELECT `username`,`name`,`status`,`role`,`branch_id` FROM `user`";
      $run = $this->link->prepare($select);
      $run ->execute();
      //print_r($run ->errorInfo());
      if ($run->rowCount()) {
       $response = true;
       while ($info = $run->fetchObject()) {
          $username = $info->username;
          $name = $info->name;
          $status = $info->status;
          $role = $info->role;
          $branch_id = $info->branch_id;
          $data[] = array("branch_id"=>$branch_id,"username"=>$username,"name"=>$name,"status"=>$status,"role"=>$role);
        }
      }
        return array("response"=>$response,"data"=>$data);
    }

    public function getuser($username){
      $response = false; $data = []; $branch_id='';$name='';$status='';
      $select = "SELECT `username`,`name`,`status`,`role`,`branch_id` FROM `user` WHERE `username`='$username'";
      $run = $this->link->prepare($select);
      $run ->execute();
      //print_r($run ->errorInfo());
      if ($run->rowCount()) {
       $response = true;
       while ($info = $run->fetchObject()) {
          $username = $info->username;
          $name = $info->name;
          $status = $info->status;
          //$role = $info->role;
          $branch_id = $info->branch_id;
        ///  $data[] = array(,"role"=>$role);
        }
      }
        return array("response"=>$response,"branch_id"=>$branch_id,"username"=>$username,"name"=>$name,"status"=>$status);
    }

    public function getbch($branch_id){
      $response = false; $data = []; $branch_name='';$branch_address='';$branch_contact='';$skin='';$main_sub='';$motto='';
      $select = "SELECT `branch_id`,`branch_name`,`branch_address`,`branch_contact`,`skin`,`main_sub`,`motto` FROM `branch` WHERE `branch_id`='$branch_id'";
      $run = $this->link->prepare($select);
      $run ->execute();
      //print_r($run ->errorInfo());
      if ($run->rowCount()) {
       $response = true;
       while ($info = $run->fetchObject()) {
          $branch_id = $info->branch_id;
          $branch_name = $info->branch_name;
          $branch_address = $info->branch_address;
          $branch_contact = $info->branch_contact;
          $skin = $info->skin;
          $main_sub = $info->main_sub;
          $motto = $info->motto;
        }
      }
        return array("response"=>$response,"branch_id"=>$branch_id,"branch_name"=>$branch_name,"branch_address"=>$branch_address
      ,"branch_contact"=>$branch_contact,"skin"=>$skin,"main_sub"=>$main_sub,"motto"=>$motto);
    }

    public function addsupplier($sname,$sadderss,$snumber,$branch_id){
         $response = false;
         $inser = "insert into `supplier` (supplier_name,supplier_address,supplier_contact,branch_id) values(:supplier_name,:supplier_address,:supplier_contact,:branch_id)";
         $run = $this ->link ->prepare($inser);
         $run ->bindParam(":supplier_name",$sname, PDO::PARAM_STR);
         $run ->bindParam(":supplier_address",$sadderss, PDO::PARAM_STR);
         $run ->bindParam(":supplier_contact",$snumber, PDO::PARAM_STR);
         $run ->bindParam(":branch_id",$branch_id, PDO::PARAM_STR);
         $run ->execute();
         //print_r($run ->errorInfo());
         if($run ->rowCount()){
          $response = true;
          return array("response"=>$response);
        }else{
          return array("response"=>false);
        }
    }

    public function editsupplier($ssname,$ssadderss,$ssnumber,$branch_id,$supplier){
         $response = false;
         $inser = "UPDATE `supplier` SET `supplier_name`='$ssname',`supplier_address`='$ssadderss',`supplier_contact`='$ssnumber' WHERE `supplier_id`='$supplier' AND `branch_id`='$branch_id' ";
         $run = $this ->link ->prepare($inser);
         $run ->execute();
         //print_r($run ->errorInfo());
         if($run ->rowCount()){
          $response = true;
          return array("response"=>$response);
        }else{
          return array("response"=>false);
        }
    }

    public function viewsupplier($branch_id){

      $response = false; $data = []; $supplier_name='';$supplier_address='';$supplier_contact='';
      $select = "SELECT `supplier_id`,`branch_id`,`supplier_name`,`supplier_address`,`supplier_contact`,`branch_id` FROM `supplier` WHERE `branch_id`='$branch_id'";
      $run = $this->link->prepare($select);
      $run ->execute();
      //print_r($run ->errorInfo());
      if ($run->rowCount()) {
       $response = true;
       while ($info = $run->fetchObject()) {
          $supplier_id = $info->supplier_id;
          $supplier_name = $info->supplier_name;
          $supplier_address = $info->supplier_address;
          $supplier_contact = $info->supplier_contact;

          $data[] = array("supplier_id"=>$supplier_id,"supplier_name"=>$supplier_name,"supplier_address"=>$supplier_address
        ,"supplier_contact"=>$supplier_contact);
        }
      }
        return array("response"=>$response,"data"=>$data);
    }

    public function viewsupplierBYID($supplier_id){

      $response = false; $data = []; $supplier_name='';$supplier_address='';$supplier_contact='';
      $select = "SELECT `supplier_id`,`branch_id`,`supplier_name`,`supplier_address`,`supplier_contact`,`branch_id` FROM `supplier` WHERE `supplier_id`='$supplier_id'";
      $run = $this->link->prepare($select);
      $run ->execute();
      //print_r($run ->errorInfo());
      if ($run->rowCount()) {
       $response = true;
       while ($info = $run->fetchObject()) {
          $supplier_id = $info->supplier_id;
          $supplier_name = $info->supplier_name;
          $supplier_address = $info->supplier_address;
          $supplier_contact = $info->supplier_contact;

        }
      }
        return array("response"=>$response,"supplier_id"=>$supplier_id,"supplier_name"=>$supplier_name,"supplier_address"=>$supplier_address
      ,"supplier_contact"=>$supplier_contact);
    }

    public function getmodel(){
      $response = false; $data = []; $model_id ='';$manufact_name='';$model='';
      $select = "SELECT * FROM `model` NATURAL JOIN `manufact` ORDER BY `model_id` DESC";
      $run = $this->link->prepare($select);
      $run ->execute();
      //print_r($run ->errorInfo());
      if ($run->rowCount()) {
       $response = true;
       while ($info = $run->fetchObject()) {
          $model_id = $info->model_id;
          $manufact_name = $info->manufact_name;
          $model = $info->model;
          $data[] = array("model_id"=>$model_id,"manufact_name"=>$manufact_name,"model"=>$model);
        }
      }
        return array("response"=>$response,"data"=>$data);
    }

    public function cat(){
      $response = false; $data = []; $cat_name ='';$cat_id='';
      $select = "SELECT `cat_id`,`cat_name` from `category` order by `cat_name`";
      $run = $this->link->prepare($select);
      $run ->execute();
      //print_r($run ->errorInfo());
      if ($run->rowCount()) {
       $response = true;
       while ($info = $run->fetchObject()) {
          $cat_id = $info->cat_id;
          $cat_name = $info->cat_name;
          $data[] = array("cat_id"=>$cat_id,"cat_name"=>$cat_name);
        }
      }
        return array("response"=>$response,"data"=>$data);
    }

    public function cat_name($cat_id){
      $response = false; $data = []; $cat_name ='';
      $select = "SELECT `cat_id`,`cat_name` from `category` WHERE `cat_id`='$cat_id'";
      $run = $this->link->prepare($select);
      $run ->execute();
      //print_r($run ->errorInfo());
      if ($run->rowCount()) {
       $response = true;
       while ($info = $run->fetchObject()) {
          $cat_id = $info->cat_id;
          $cat_name = $info->cat_name;
          //$data[] = array();
        }
      }
        return array("response"=>$response,"cat_id"=>$cat_id,"cat_name"=>$cat_name);
    }

    public function addparts($patname,$des,$price,$prod_img_1,$cat,$part_qty,$branch_id,$reorder,$supplier,$patno,$model){
         $response = false;
         $inser = "insert into `parts` (part_name,part_desc,part_price,part_pic,cat_id,part_qty,branch_id,reorder,supplier_id,part_no,model_for_id)
         values(:part_name,:part_desc,:part_price,:part_pic,:cat_id,:part_qty,:branch_id,:reorder,:supplier_id,:part_no,:model_for_id)";
         $run = $this ->link ->prepare($inser);
         $run ->bindParam(":part_name",$patname, PDO::PARAM_STR);
         $run ->bindParam(":part_desc",$des, PDO::PARAM_STR);
         $run ->bindParam(":part_price",$price, PDO::PARAM_STR);
         $run ->bindParam(":part_pic",$prod_img_1, PDO::PARAM_STR);
         $run ->bindParam(":cat_id",$cat, PDO::PARAM_STR);
         $run ->bindParam(":part_qty",$part_qty, PDO::PARAM_STR);
         $run ->bindParam(":branch_id",$branch_id, PDO::PARAM_STR);
         $run ->bindParam(":reorder",$reorder, PDO::PARAM_STR);
         $run ->bindParam(":supplier_id",$supplier, PDO::PARAM_STR);
         $run ->bindParam(":part_no",$patno, PDO::PARAM_STR);
         $run ->bindParam(":model_for_id",$model, PDO::PARAM_STR);

         $run ->execute();
         //print_r($run ->errorInfo());
         if($run ->rowCount()){
          $response = true;
          return array("response"=>$response);
        }else{
          return array("response"=>false);
        }
    }

    public function editparts($patname,$des,$price,$cat,$part_id,$branch_id,$reorder,$supplier,$patno,$model){
         $response = false;
         $inser = "UPDATE `parts` SET `part_name`='$patname',`part_desc`='$des',`part_price`='$price',`cat_id`='$cat',`reorder`='$reorder',`supplier_id`='$supplier',`model_for_id`='$model',`part_no`='$patno' WHERE `part_id`='$part_id' AND `branch_id`='$branch_id'";
         $run = $this ->link ->prepare($inser);
         $run ->execute();
         //print_r($run ->errorInfo());
         if($run ->rowCount()){
          $response = true;
          return array("response"=>$response);
        }else{
          return array("response"=>false);
        }
    }

    public function viewparts($branch_id){
         $response = false;
         $select = "SELECT `part_id`,`part_name`,`part_desc`,`part_price`,`part_pic`,`part_qty`,`cat_id`,`reorder`,`supplier_id`,`part_no`,`model_for_id` FROM `parts` WHERE `branch_id`='$branch_id'";
         $run = $this->link->prepare($select);
         $run ->execute();
         //print_r($run ->errorInfo());
         if ($run->rowCount()) {
          $response = true;
          while ($info = $run->fetchObject()) {
             $part_name = $info->part_name;
             $part_desc = $info->part_desc;
             $part_price = $info->part_price;
             $part_pic = $info->part_pic;
             $cat_id = $info->cat_id;
             $reorder = $info->reorder;
             $supplier_id = $info->supplier_id;
             $part_no = $info->part_no;
             $model_for_id = $info->model_for_id;
             $part_qty = $info->part_qty;
             $part_id = $info->part_id;
             $data[] = array("part_id"=>$part_id,"part_qty"=>$part_qty,"part_name"=>$part_name,"part_desc"=>$part_desc,"part_price"=>$part_price
           ,"part_pic"=>$part_pic,"cat_id"=>$cat_id,"reorder"=>$reorder,"supplier_id"=>$supplier_id,"part_no"=>$part_no,"model_for_id"=>$model_for_id);
           }
         }
           return array("response"=>$response,"data"=>$data);
    }

    public function viewpartsbyID($part_id){
         $response = false;
         $select = "SELECT `part_id`,`part_name`,`part_desc`,`part_price`,`part_pic`,`part_qty`,`cat_id`,`reorder`,`supplier_id`,`part_no`,`model_for_id` FROM `parts` WHERE `part_id`='$part_id'";
         $run = $this->link->prepare($select);
         $run ->execute();
         //print_r($run ->errorInfo());
         if ($run->rowCount()) {
          $response = true;
          while ($info = $run->fetchObject()) {
             $part_name = $info->part_name;
             $part_desc = $info->part_desc;
             $part_price = $info->part_price;
             $part_pic = $info->part_pic;
             $cat_id = $info->cat_id;
             $reorder = $info->reorder;
             $supplier_id = $info->supplier_id;
             $part_no = $info->part_no;
             $model_for_id = $info->model_for_id;
             $part_qty = $info->part_qty;
             $part_id = $info->part_id;
             //$data[] = array();
           }
         }
           return array("response"=>$response,"part_id"=>$part_id,"part_qty"=>$part_qty,"part_name"=>$part_name,"part_desc"=>$part_desc,"part_price"=>$part_price
         ,"part_pic"=>$part_pic,"cat_id"=>$cat_id,"reorder"=>$reorder,"supplier_id"=>$supplier_id,"part_no"=>$part_no,"model_for_id"=>$model_for_id);
    }

    public function getmodelBYID($model_for_id){
      $response = false; $data = []; $model_id ='';$manufact_name='';$model='';
      $select = "SELECT * FROM `model` WHERE `model_id`='$model_for_id'";
      $run = $this->link->prepare($select);
      $run ->execute();
      //print_r($run ->errorInfo());
      if ($run->rowCount()) {
       $response = true;
       while ($info = $run->fetchObject()) {
          $model_id = $info->model_id;
          $model = $info->model;
        }
      }
        return array("response"=>$response,"model_id"=>$model_id,"model"=>$model);
    }

    public function getallproducts($branch_id){
      $response = false; $data = []; $part_name = '';$part_id = '';
      $select = "SELECT `branch_id`,`part_id`,`part_name` FROM `parts` WHERE `branch_id`='$branch_id'";
      $run = $this->link->prepare($select);
      $run ->execute();
      //print_r($run ->errorInfo());
      if ($run->rowCount()) {
       $response = true;
       while ($info = $run->fetchObject()) {
          $part_id = $info->part_id;
          $part_name = $info->part_name;
          $data[] = array("part_id"=>$part_id,"part_name"=>$part_name);
        }
        return array("response"=>$response,"data"=>$data);
      }
    }

    public function stockin($quantity,$product,$branch_id){
         $response = false;
         $inser = "insert into `stockin` (prod_id,qty,branch_id) values(:prod_id,:qty,:branch_id)";
         $run = $this ->link ->prepare($inser);
         $run ->bindParam(":prod_id",$product, PDO::PARAM_STR);
         $run ->bindParam(":qty",$quantity, PDO::PARAM_STR);
         $run ->bindParam(":branch_id",$branch_id, PDO::PARAM_STR);
         $run ->execute();
         //print_r($run ->errorInfo());
         if($run ->rowCount()){
          $response = true;
          return $this->update_part($quantity,$product,$branch_id);
        }
    }

    public function update_part($quantity,$product,$branch_id){
         $response = false;
         $inser = "UPDATE `parts` SET `part_qty`='$quantity' WHERE `part_id`='$product' AND `branch_id`='$branch_id'";
         $run = $this ->link ->prepare($inser);
         $run ->execute();
         //print_r($run ->errorInfo());
         if($run ->rowCount()){
          $response = true;
          return array("response"=>$response);
        }else{
          return array("response"=>false);
        }
    }

    public function viewprodstock($branch_id){
         $response = false; $data = [];
         $select = "SELECT * FROM `stockin` natural join `parts` natural join `supplier` where `branch_id`='$branch_id' order by `date` desc";
         $run = $this->link->prepare($select);
         $run ->execute();
         //print_r($run ->errorInfo());
         if ($run->rowCount()) {
          $response = true;
          while ($info = $run->fetchObject()) {
             $part_name = $info->part_name;
             $qty = $info->qty;
             $supplier_name = $info->supplier_name;
             $date = $info->date;
             $data [] = array("part_name"=>$part_name,"qty"=>$qty,"supplier_name"=>$supplier_name,"date"=>$date);
           }
         }
           return array("response"=>$response,"data"=>$data);
    }

    public function addcat($catname){
         $response = false;
         $inser = "insert into `category` (cat_name) values(:cat_name)";
         $run = $this ->link ->prepare($inser);
         $run ->bindParam(":cat_name",$catname, PDO::PARAM_STR);
         $run ->execute();
         print_r($run ->errorInfo());
         if($run ->rowCount()){
          $response = true;
          return array("response"=>$response);
        }else{
            return array("response"=>false);
        }
    }

    public function viewcat(){
         $response = false; $data = [];
         $select = "SELECT `cat_id`,`cat_name` FROM `category` order by `cat_id` desc";
         $run = $this->link->prepare($select);
         $run ->execute();
         //print_r($run ->errorInfo());
         if ($run->rowCount()) {
          $response = true;
          while ($info = $run->fetchObject()) {
             $cat_id = $info->cat_id;
             $cat_name = $info->cat_name;
             $data [] = array("cat_id"=>$cat_id,"cat_name"=>$cat_name);
           }
         }
           return array("response"=>$response,"data"=>$data);
    }

    public function updatecat($cat_id,$catname){
         $response = false;
         $inser = "UPDATE `category` SET `cat_name`='$catname' WHERE `cat_id`='$cat_id'";
         $run = $this ->link ->prepare($inser);
         $run ->execute();
         //print_r($run ->errorInfo());
         if($run ->rowCount()){
          $response = true;
          return array("response"=>$response);
        }else{
          return array("response"=>false);
        }
    }
  }
ob_end_flush();
?>
