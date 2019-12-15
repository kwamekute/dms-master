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

  }
ob_end_flush();
?>
