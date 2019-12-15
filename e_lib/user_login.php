<?php
ob_start();

class User_login extends Userregister{
  // student login function
  public function login($username,$password){
       $response = false; $json = ''; $active = 'active';
  		$login = "SELECT `user_id`,`username`,`password`,`role`,`status`,`branch_id` FROM `user` WHERE `username`='$username' AND `password`='$password' AND `status`='$active' LIMIT 1";
      $run = $this->link->prepare($login);
  		$run->execute();
      if($run ->rowCount()){
  			$response = true;
  			while ($info = $run->fetchObject()) {
  				$user_id = preg_replace("#[^0-9a-zA-Z-]#","",$info ->user_id);
  				$role = preg_replace("#[^0-9]#","",$info ->role);
          $branch_id = preg_replace("#[^0-9]#","",$info ->branch_id);
  				$username = preg_replace("#[^0-9a-zA-z-. ]#","",$info ->username);
  				$vars = array(
  	        'user_id'=>$user_id,
  	        'role'=>$role,
            'branch_id'=>$branch_id,
  	        'username'=>$username
  	      );
  	    }
  	     $json = json_encode($vars);
      }
  		return array("response"=>$response,"data"=>$json);
  }

}

ob_end_flush();
?>
