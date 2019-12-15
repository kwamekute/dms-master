<?php
ob_start();

class Userregister extends Connection{
 public function add_newuser($data){
     
      $response = false;
     if($this ->isEmailAlreadyExists($data['email'])){
        return array("response"=>false,"error"=>"Email address already exists!");
     }
     if($this ->isPhoneAlreadyExists($data['phone'])){
        return array("response"=>false,"error"=>"Phone number already exists!");
     }
     if(strlen($data['phone']) != 10){
         return array("response"=>false,"error"=>"Phone number must be 10 digits!");
     }

     /*if(strlen($data['gender']) == '0'){
         return array("response"=>false,"message"=>"Gender must not be empty");
     }*/
    if($this ->isIndexExist($data['index'])){
        $insert = "insert into `u_table`(index_n,_pass,p_num,e_mail) values(:index,:pass,:phone,:email)";
    //print_r($insert);
    $run = $this ->link ->prepare($insert);

    $run ->bindParam(":index",$data['index'], PDO::PARAM_STR);
    $run ->bindParam(":pass",$data['pass'], PDO::PARAM_STR);
    $run ->bindParam(":phone",$data['phone'], PDO::PARAM_STR);
    $run ->bindParam(":email",$data['email'], PDO::PARAM_STR);
    $run->execute();
     //print_r($run ->errorInfo());
        if($run ->rowCount()){
             $response = true;
            return array("response"=>$response,"success"=>"successfully registered");
        }
        return array("response"=>false, "error"=>"Unable to register .... try later");
     }else{
        return array("response"=>false,"error"=>"Your Information Does not Exist In our System. Please contact Administrator.");

     }
    }
    protected function isIndexExist($index){
        //echo $index;
        $select ="select `_index_n` from `_pos_stud` where `_index_n`='$index' limit 1";
        $run = $this ->link ->query($select);
        if($run ->rowCount()){
            return true;
        }
        return false;
    }
    protected function isEmailAlreadyExists($email){
        $select ="select `e_mail` from `u_table` where `e_mail`='$email' limit 1";
        $run = $this ->link ->query($select);
        if($run ->rowCount()){
            return true;
        }
        return false;
    }

    protected function isPhoneAlreadyExists($phone){
        $select ="select `p_num` from `u_table` where `p_num`='$phone' limit 1";
        $run = $this ->link ->query($select);
        if($run ->rowCount()){
            return true;
        }
        return false;
    }

 }
ob_end_flush();
?>
