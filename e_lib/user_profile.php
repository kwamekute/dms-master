<?php
ob_start();

class Userprofileinfo extends User_login{
 public function userProfile($index_no){
    $response = "";$sch_id = "";  $email = ""; $p_num = ""; $index="";$gender="";$surname="";$firstname="";$middle_name="";$jhs="";$shs_name="";$program="";$status="";
    //not done
    
    $select ="select DISTINCT `index_n`,`p_num`,`e_mail`,`_pos_stud`.`_index_n`,`_pos_stud`.`_sch_idd`,`_pos_stud`.`gndr`,`_pos_stud`.`s_name`,`_pos_stud`.`m_name`,`_pos_stud`.`f_name`,`_pos_stud`.`jhs_com`,`_pos_stud`.`prog_off`,`_pos_stud`.`res_stats` from `u_table` left join `_pos_stud` on `u_table`.`index_n` = `_pos_stud`.`_index_n` where `index_n`='$index_no' limit 1";
    $run = $this ->link ->prepare($select);
    $run->execute(); 
    //print_r($run ->errorInfo());
    if($run ->rowCount()){        
        while($info = $run->fetchObject()){
         $response = true;
         $email = preg_replace("#[^0-9a-zA-Z@.]#","",$info ->e_mail);
         $sch_id = preg_replace("#[^0-9a-zA-Z@.]#","",$info ->_sch_idd);
         $p_num = preg_replace("#[^0-9]#","",$info ->p_num);
         $index = preg_replace("#[^0-9]#","",$info ->index_n);
         $gender = preg_replace("#[^a-zA-Z ]#","",$info ->gndr);
         $surname = preg_replace("#[^a-zA-Z-. ]#","",$info ->s_name);
         $middle_name = preg_replace("#[^a-zA-Z-. ]#","",$info ->m_name);
         $firstname = preg_replace("#[^a-zA-Z-. ]#","",$info ->f_name);
         $jhs = preg_replace("#[^a-zA-Z-.,' ]#","",$info ->jhs_com);
         //$shs_name = preg_replace("#[^a-zA-Z-.,' ]#","",$info ->sch_nm);"sch_nm"=>$shs_name,
         $program = preg_replace("#[^a-zA-Z ]#","",$info ->prog_off);
         $status = preg_replace("#[^a-zA-Z]#","",$info ->res_stats);
        }
    }
    return array("response"=>$response,"sch_id" =>$sch_id,"email" =>$email,"p_num"=> $p_num,"index_n"=>$index,"gndr"=>$gender,"s_name"=>$surname,"f_name"=>$firstname,"m_name"=>$middle_name,"jhs_com"=>$jhs,"prog_off"=>$program,"res_stats"=>$status);
 }

 // Get student school by Id
 public function getstudSchool($dummy){
     $response = ""; $email = ""; $p_num = ""; $index="";
     //
            $select ="select `_sch_idd`,`schools`.`_sch_id`,`schools`.`_s_name` from `_pos_stud` left join `schools` on `_pos_stud`.`_sch_idd` = `schools`.`_sch_id` where `_sch_idd`='$dummy'";
            $run = $this ->link ->prepare($select);
            $run->execute();
            //print_r($run ->errorInfo());data-toggle="modal" data-target="#myModal"edit_blog.php?id=<?php echo $blog_id_code
            $data = [];$response = false; 
            if($run ->rowCount()){
                $count = 1;
                while($info = $run->fetchObject()){
                    $response = true;
                    $_sch_idd    = preg_replace("#[^0-9a-zA-Z]#","",$info ->_sch_idd);
                    $_sch_id         = preg_replace("#[^0-9a-zA-Z]#","",$info ->_sch_id); 
                    $_s_name           = preg_replace("#[^0-9a-zA-Z- ]#","",$info ->_s_name);
                $count++;
                }
            }
            return array("response"=>$response,"_sch_idd"=>$_sch_idd,"_sch_id"=>$_sch_id,"_s_name"=>$_s_name);
       
     }

// Get abbrv from school where abbrv = abbrv
     public function getabbrv($sch){
            $abbrv =""; $_sch_id ="";
            $select ="select `_sch_id`,`_abbr` from `schools`  where `_sch_id`= '$sch'";
            $run = $this ->link ->prepare($select);
            $run->execute();
            //print_r($run ->errorInfo());data-toggle="modal" data-target="#myModal"edit_blog.php?id=<?php echo $blog_id_code
            $data = [];$response = false; 
            if($run ->rowCount()){
                $count = 1;
                while($info = $run->fetchObject()){
                    $response = true;
                    $_sch_id         = preg_replace("#[^0-9a-zA-Z]#","",$info ->_sch_id); 
                    $_abbr           = preg_replace("#[^a-zA-Z-. ]#","",$info ->_abbr);
                $count++;
                }
            }
            return array("response"=>$response,"_sch_id"=>$_sch_id,"_abbr"=>$_abbr);

     }

 // Get School Count
     public function checkrow($school_id,$index_no,$momo_number,$momo_name,$amount,$trans_id,$carrier,$abbrv){
             $response = false;
            $select ="SELECT `_sch_id` from `paymt` where `_sch_id` = '$school_id'";
            //echo $select;
            $run = $this ->link ->query($select);
            //$run->execute();
            //print_r($run ->errorInfo());
              
            if($count = $run ->rowCount($run)){
                $count;
                $response = true;
            }
            return $this ->generate_serial($school_id,$index_no,$momo_number,$momo_name,$amount,$trans_id,$carrier,$abbrv,$count);
            //return $this ->send_payment($school_id,$index_no,$momo_number,$momo_name,$amount,$trans_id,$carrier,$abbrv,$count);
     }
     
      //Generate Serial Number
      public function generate_serial($school_id,$index_no,$momo_number,$momo_name,$amount,$trans_id,$carrier,$abbrv,$count){
            $serial = ""; $initial = ""; $plusone = ""; $date = Date('Y'); $lst = substr($date, 2, 2);
            $serial = $lst.'-'.$abbrv;
            $plusone = $count ++;
           $serial = $lst.'-'.$abbrv;
           $plusone = $count;
           if($count <= 9){
              $e = $serial.'-'.'00'.$plusone;
            }else if($count >= 10 & $count < 100){
              $e = $serial.'-'.'0'.$plusone;
            }else if($count >= 100){
                $e = $serial.'-'.$plusone;
            }else{
                $e = $serial.'-'.$plusone;
            }
           
            $check =  $this ->send_payment($school_id,$index_no,$momo_number,$momo_name,$amount,$trans_id,$carrier,$e);
            //var_dump($check);
      }

 public function send_payment($school_id,$index_no,$momo_number,$momo_name,$amount,$trans_id,$carrier,$e){
         $confirm = "0";

         $upper_case = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
         $lower_case = "abcdefghijklmnopqrstuvwxyz";
		 $numbers = "0123456789";
		 $special_chars = "GHIJKLMNOPQR";
		 $gen_uppr_case = substr(str_shuffle($upper_case), 0,2);
		 $gen_lower_case = substr(str_shuffle($lower_case), 0,2);
		 $gen_num = substr(str_shuffle($numbers), 0,2);
		 $gen_spchar = substr(str_shuffle($special_chars), 0,2);
		 $mixed = "$gen_uppr_case$gen_lower_case$gen_num$gen_spchar";
		 $gen_mixed = substr(str_shuffle($mixed), 0,8);

         $inser = "insert into `paymt` (_sch_id,ed_index_no,ed_momo_no,ed_momo_nm,ed_amt,ed_tran_id,ed_carrier,confirm,ed_download_cd,serial_number) values(:_sch_id,:ed_index_no,:ed_momo_no,:ed_momo_nm,:ed_amt,:ed_tran_id,:ed_carrier,:confirm,:ed_download_cd,:serial_number)";
         $run = $this ->link ->prepare($inser);
         $run ->bindParam(":_sch_id",$school_id, PDO::PARAM_STR);
         $run ->bindParam(":ed_index_no",$index_no, PDO::PARAM_STR);
         $run ->bindParam(":ed_momo_no",$momo_number, PDO::PARAM_STR);
         $run ->bindParam(":ed_momo_nm",$momo_name, PDO::PARAM_STR);
         $run ->bindParam(":ed_amt",$amount, PDO::PARAM_STR);
         $run ->bindParam(":ed_tran_id",$trans_id, PDO::PARAM_STR);
         $run ->bindParam(":ed_carrier",$carrier, PDO::PARAM_STR);
         $run ->bindParam(":confirm",$confirm, PDO::PARAM_STR);
         $run ->bindParam(":ed_download_cd",$gen_mixed, PDO::PARAM_STR);
         $run ->bindParam(":serial_number",$e, PDO::PARAM_STR);
         $run ->execute();                          
         //print_r($run ->errorInfo());
         if($run ->rowCount()){
          echo "<div class='col-md-12' style='height:auto; width:100%; background:#33cc00;'>
                  <p style='text-align:center; color:#fff; padding:10px;'>Your payment has been submitted... waiting for confimation. It takes 1-15min for successful confirmation</p>
                  </div>";
         }else{
          echo "<div class='col-md-12' style='height:auto; width:100%; background:#ff0000;'>
                  <p style='text-align:center; color:#fff; padding:10px;'>Oooops an error occured</p>
                  </div>
                 ";
           //header("location: setupadmins.php?ermsg=There was an error inserting. Please check your fields");
         }
 }

// Get School Count
     public function getserial($school_id,$index_no,$phone){
             $response = false; $serial_number = "";
            $select = " SELECT `serial_number` from `paymt` where `_sch_id` = '$school_id' AND `ed_index_no`= '$index_no'";
            //echo $select;
            $run = $this ->link ->query($select);
            //$run->execute();
            //print_r($run ->errorInfo());
            if($run ->rowCount($run)){
                $response = true;
                while($info = $run->fetchObject()){
                $serial_number = preg_replace("#[^0-9a-zA-Z-]#","",$info ->serial_number);
              }
            }
            return $this ->sendtolog($school_id,$index_no,$phone,$serial_number);
            //return $this ->send_payment($school_id,$index_no,$momo_number,$momo_name,$amount,$trans_id,$carrier,$abbrv,$count);
     }

 // Send to download log 
 public function sendtolog($school_id,$index_no,$phone,$serial_number){
            $serial = ""; $initial = ""; $plusone = "";
         $downloaded = '1';
         $inser = "insert into `download_log` (sch_id,index_no,serial_no,downloaded) values(:sch_id,:index_no,:serial_no,:downloaded)";
         $run = $this ->link ->prepare($inser);
         $run ->bindParam(":sch_id",$school_id, PDO::PARAM_STR);
         $run ->bindParam(":index_no",$index_no, PDO::PARAM_STR);
         $run ->bindParam(":serial_no",$serial_number, PDO::PARAM_STR);
         $run ->bindParam(":downloaded",$downloaded, PDO::PARAM_STR);
         $run ->execute();                          
         //print_r($run ->errorInfo());
         if($run ->rowCount()){
           $response = true;
         }
         return $this ->sendsms($phone,$serial_number);
      }

// Send sms to Requested User
public function sendsms($phone,$serial_number){
        $key = 'gI8VAfdTixNqRGOWio5w6TZMh';
        $p = $phone;
        $sender_id = 'E-ADMIT';
        $serial = "Write This Serial Number on the Front Page of your Prospectus. \n\n $serial_number";
        $message = urlencode($serial);
        $url="https://apps.mnotify.net/smsapi?key=$key&to=$p&msg=$message&sender_id=$sender_id";
        $result=file_get_contents($url); //call url and store result;

            switch($result){                                           
                case "1000":
                $res = "Verification code sent successfully";
                break;
                case "1002":
                $res = "Verification code not sent";
                break;
                case "1003":
                $res = "You don't have enough balance";
                break;
                case "1004":
                $res =  "Invalid API Key";
                break;
                case "1005":
                $res =  "Phone number not valid";
                break;
                case "1006":
                 $res = "Invalid Sender ID";
                break;
                case "1008":
                $res = "Empty message";
                break;
            }
            if($result == "1000"){
                echo "1";
                //echo "A Serial Number was sent to your Phone Number. Please check";
            }else {
                echo "0";
                
            }
}

        public function user_trans($index_no){
            $response = ""; $email = ""; $p_num = ""; $index="";$momo_nm="";$momo_no="";$amount="";$tran_id="";$confirm="";$download_cd="";
            $select ="select `ed_momo_nm`,`ed_momo_no`,`ed_amt`,`ed_tran_id`,`confirm`,`ed_download_cd` from `paymt` where `ed_index_no`='$index_no' limit 1";
            $run = $this ->link ->prepare($select);
            $run->execute();
            //print_r($run ->errorInfo());
            if($run ->rowCount()){
                
                while($info = $run->fetchObject()){
                $response = true;
                $momo_nm = preg_replace("#[^0-9a-zA-Z- ]#","",$info ->ed_momo_nm);
                $momo_no = preg_replace("#[^0-9]#","",$info ->ed_momo_no);
                $amount = preg_replace("#[^0-9.]#","",$info ->ed_amt);
                $tran_id = preg_replace("#[^0-9]#","",$info ->ed_tran_id);
                $confirm = preg_replace("#[^0-9]#","",$info ->confirm);
                $download_cd = preg_replace("#[^0-9a-zA-Z./]#","",$info ->ed_download_cd);
                ?>
                 <tr>
                    <td>
                        <?php echo $momo_nm ?>
                    </td>
                    <td>
                        <?php echo $momo_no ?>
                    </td>
                    <td>
                         <?php echo $amount ?>
                    </td>
                    <td>
                         <?php echo $tran_id ?>
                    </td>
                    <td>
                         <?php 
                         if($confirm == '1'){
                          echo "confirmed";
                         }else{
                             echo "Unconfirmed";
                         }
                         ?>
                    </td>
                    <td>
                         <?php 
                         if($confirm == '1'){
                          echo $download_cd;
                         }else{
                             echo "";
                         }
                          ?>
                    </td>
                </tr>
                <?php
                }
            }
            return array("response"=>$response,"momo_nm" =>$momo_nm,"momo_no"=> $momo_no,"amount"=>$amount,"tran_id"=>$tran_id,"confirm"=>$confirm,"download_cd"=>$download_cd);
        }


    public function verify_code($index_no,$download,$sch_id){
        $response = false;
    $check_code ="select `ed_download_cd`,`ed_index_no`,`confirm` from `paymt` where `ed_index_no`='$index_no' and `ed_download_cd`='$download' and `confirm`='1' limit 1";
     
         $run = $this ->link ->query($check_code);
         //print_r($run ->errorInfo());echo "";
        if($run ->rowCount()){
            $response = true;
             return array("response"=>$response);
        }
        return array("response"=>$response,"sch_id" =>$sch_id);
     }

     public function payments_request(){
     $response = ""; $email = ""; $p_num = ""; $index="";
            $select ="select `ed_index_no`,`ed_momo_no`,`ed_momo_nm`,`ed_amt`,`ed_tran_id`,`ed_carrier`,`confirm`,`ed_pay_date` from `paymt` order by `ed_pay_date` Desc";
            $run = $this ->link ->prepare($select);
            $run->execute();
            //print_r($run ->errorInfo());data-toggle="modal" data-target="#myModal"edit_blog.php?id=<?php echo $blog_id_code
            $data = [];$response = false; 
            if($run ->rowCount()){
                $count = 1;
                while($info = $run->fetchObject()){
                    $response = true;
                    $index_number    = preg_replace("#[^0-9a-zA-Z,.' ]#","",$info ->ed_index_no);
                    $momo_no         = preg_replace("#[^0-9+ ]#","",$info ->ed_momo_no); 
                    $momo_nm         = preg_replace("#[^0-9a-zA-Z-/,. ]#","",$info ->ed_momo_nm); 
                    $amount          = preg_replace("#[^0-9.]#","",$info ->ed_amt);
                    $transaction_id  = preg_replace("#[^0-9]#","",$info ->ed_tran_id);
                    $carrier         = preg_replace("#[^0-9a-zA-Z@._]#","",$info ->ed_carrier);
                    $confirm         = preg_replace("#[^0-9]#","",$info ->confirm);
                    $data[]          = array("index_number"=>$index_number,"momo_no"=>$momo_no,"momo_nm"=>$momo_nm,"amount"=>$amount,"transaction_id"=>$transaction_id,"carrier"=>$carrier,"confirm"=>$confirm);   
                $count++;
                }
            }
            return array("response"=>$response,"data" =>$data);
       
     }

      public function confirm_payment($blog_id){
             $con = '1';
             $response = false;
            $select =" update `paymt` set `confirm`='$con' where `ed_index_no`='$blog_id'";
            $run = $this ->link ->prepare($select);
            $run->execute();
            //print_r($run ->errorInfo());data-toggle="modal" data-target="#myModal"edit_blog.php?id=<?php echo $blog_id_code 
            
            if($run ->rowCount()){
              $response = true;
                  ?>
                       <script>toastr.success('Yaay User payments has been confirmed');</script>
                  <?php
            }else{
                    ?>
                       <script>toastr.error('Error confirming user. Either technical error or you twice confirmation');</script>
                  <?php
            }
            
     }

      public function add_stud($data){
             $response = false;
             //$run ->bindParam(":school_name",$data['school_name'], PDO::PARAM_STR);:school_name,,sch_nm
             $inser = "insert into `_pos_stud`(_sch_idd,_index_n,s_name,m_name,f_name,gndr,jhs_com,prog_off,res_stats) 
             values(:sch_id,:index_number,:surname,:middlename,:firstname,:gender,:jhs,:program,:rest)";
             
             $run = $this ->link ->prepare($inser);
             $run ->bindParam(":sch_id",$data['sch_id'], PDO::PARAM_STR);
             $run ->bindParam(":index_number",$data['index_number'], PDO::PARAM_STR);
             $run ->bindParam(":surname",$data['surname'], PDO::PARAM_STR);
             $run ->bindParam(":middlename",$data['middlename'], PDO::PARAM_STR);
             $run ->bindParam(":firstname",$data['firstname'], PDO::PARAM_STR);
             $run ->bindParam(":gender",$data['gender'], PDO::PARAM_STR);
             $run ->bindParam(":jhs",$data['jhs'], PDO::PARAM_STR);
             $run ->bindParam(":program",$data['program'], PDO::PARAM_STR);
             $run ->bindParam(":rest",$data['rest'], PDO::PARAM_STR);
             $run ->execute(); 
            //print_r($run ->errorInfo());
        
            if($r = $run ->rowCount()){
              $response = true;
              ?>
              <script>toastr.success('You successfully added a student');</script>
              <?php
            }else{
                ?>
                <script>toastr.error('Ooops could not add student');</script>
                <?php
            }
           
     }

     // Admin info for e-admit
      public function useradminProfile($username){
        $response = "";$ad_h_id = "";  $user_hab = ""; $phone = ""; $email="";
        //not done
        $select ="select `ad_h_id`,`user_hab`,`phone`,`email` from `administrator` where `user_hab`='$username' limit 1";
        $run = $this ->link ->prepare($select);
        $run->execute(); 
        //print_r($run ->errorInfo());
        if($run ->rowCount()){        
            while($info = $run->fetchObject()){
             $response = true;
             $ad_h_id = preg_replace("#[^0-9]#","",$info ->ad_h_id);
             $user_hab = preg_replace("#[^0-9a-zA-Z@.]#","",$info ->user_hab);
             $phone = preg_replace("#[^0-9]#","",$info ->phone);
             $email = preg_replace("#[^0-9a-zA-Z@.]#","",$info ->email);
            }
        }
       return array("response"=>$response,"ad_h_id" =>$ad_h_id,"user_hab" =>$user_hab,"phone"=> $phone,"email"=>$email);
    }

//Get all successful payment
 public function success_trans(){
            $response = ""; $email = ""; $p_num = ""; $index="";$momo_nm="";$momo_no="";$amount="";$tran_id="";$confirm="";$download_cd="";
            $select ="select `pay_id`,`ed_momo_nm`,`ed_momo_no`,`ed_amt`,`ed_tran_id`,`confirm`,`ed_download_cd` from `paymt` where `confirm`='1' ORDER BY `pay_id` DESC LIMIT 10";
            $run = $this ->link ->prepare($select);
            $run->execute();
            //print_r($run ->errorInfo());
            if($run ->rowCount()){
                
                while($info = $run->fetchObject()){
                $response = true;
                $momo_nm = preg_replace("#[^0-9a-zA-Z- ]#","",$info ->ed_momo_nm);
                $momo_no = preg_replace("#[^0-9]#","",$info ->ed_momo_no);
                $amount = preg_replace("#[^0-9.]#","",$info ->ed_amt);
                $tran_id = preg_replace("#[^0-9]#","",$info ->ed_tran_id);
                $confirm = preg_replace("#[^0-9]#","",$info ->confirm);
                $download_cd = preg_replace("#[^0-9a-zA-Z./]#","",$info ->ed_download_cd);
                ?>
                 <tr>
                                                <td>
                                                    <?php echo $momo_nm ?>
                                                </td>
                                                <td>
                                                    <?php echo $momo_no ?>
                                                </td>
                                                <td>
                                                     <?php echo $amount ?>
                                                </td>
                                                <td>
                                                     <?php echo $tran_id ?>
                                                </td>
                                                
                                            </tr>
                <?php
                }
            }
            return array("response"=>$response,"momo_nm" =>$momo_nm,"momo_no"=> $momo_no,"amount"=>$amount,"tran_id"=>$tran_id,"confirm"=>$confirm,"download_cd"=>$download_cd);
        }


     // School Administrator information for e-admit
    public function schadminProfile($school_id){
    $response = "";$said = "";  $s_admin_id = ""; $_sch_id = ""; $email=""; $firstname=""; $midname=""; $lastname=""; $contact=""; $address="";
    //not done
    $select ="select `said`,`s_admin_id`,`_sch_id`,`email`,`firstname`,`midname`,`lastname`,`address`,`contact` from `sch_admin` where `email`= '$school_id' limit 1";
    $run = $this ->link ->prepare($select);
    $run->execute(); 
    //print_r($run ->errorInfo());
    if($run ->rowCount()){        
        while($info = $run->fetchObject()){
         $response = true;
        
         $said = preg_replace("#[^0-9]#","",$info ->said);
         $s_admin_id = preg_replace("#[^0-9a-zA-Z.-]#","",$info ->s_admin_id);
         $_sch_id = preg_replace("#[^0-9a-zA-Z@]#","",$info ->_sch_id);
         $email = preg_replace("#[^0-9a-zA-Z@.]#","",$info ->email);
         $firstname = preg_replace("#[^0-9a-zA-Z-]#","",$info ->firstname);
         $address = preg_replace("#[^0-9a-zA-Z-@,./ ]#","",$info ->address);
         $midname = preg_replace("#[^0-9a-zA-Z-]#","",$info ->midname);
         $lastname = preg_replace("#[^0-9a-zA-Z-]#","",$info ->lastname);
         $contact = preg_replace("#[^0-9]#","",$info ->contact);

        }
    }
    return array("response"=>$response,"said" =>$said,"s_admin_id" =>$s_admin_id,"_sch_id"=> $_sch_id,"email"=>$email,"firstname"=>$firstname,"midname"=>$midname,"lastname"=>$lastname,"contact"=>$contact,"address"=>$address);
 }

 // School Administrator information for e-admit
    public function schooladminprof($school_id){

    $response = "";$said = "";  $s_admin_id = ""; $_sch_id = ""; $email=""; $firstname=""; $midname=""; $lastname=""; $contact="";$data = [];$address="";
    //not done
    $select ="select `said`,`s_admin_id`,`_sch_id`,`email`,`firstname`,`midname`,`lastname`,`address`,`contact` from `sch_admin` where `_sch_id`= '$school_id'";
    $run = $this ->link ->prepare($select);
    $run->execute(); 
    //print_r($run ->errorInfo());
    if($run ->rowCount()){        
        while($info = $run->fetchObject()){
         $response = true;
         $count = 1;
         $said = preg_replace("#[^0-9]#","",$info ->said);
         $s_admin_id = preg_replace("#[^0-9a-zA-Z.-]#","",$info ->s_admin_id);
         $_sch_id = preg_replace("#[^0-9a-zA-Z@]#","",$info ->_sch_id);
         $email = preg_replace("#[^0-9a-zA-Z@.]#","",$info ->email);
         $firstname = preg_replace("#[^0-9a-zA-Z-]#","",$info ->firstname);
         $address = preg_replace("#[^0-9a-zA-Z-@,./ ]#","",$info ->address);
         $midname = preg_replace("#[^0-9a-zA-Z-]#","",$info ->midname);
         $lastname = preg_replace("#[^0-9a-zA-Z-]#","",$info ->lastname);
         $contact = preg_replace("#[^0-9]#","",$info ->contact);
         $data[] = array("said" =>$said,"s_admin_id" =>$s_admin_id,"_sch_id"=> $_sch_id,"email"=>$email,"firstname"=>$firstname,"midname"=>$midname,"lastname"=>$lastname,"contact"=>$contact,"count"=>$count,"address"=>$address);
         $count++;
        }
    }
    return array("response"=>$response,"data"=>$data);
 }

   // Edit School Administrator information for e-admit
    public function editadminProfile($admin_id){
    $response = "";$said = "";  $s_admin_id = ""; $_sch_id = ""; $email=""; $firstname=""; $midname=""; $lastname=""; $contact=""; $address="";
    //not done
    $select ="select `said`,`s_admin_id`,`_sch_id`,`email`,`firstname`,`midname`,`lastname`,`address`,`contact` from `sch_admin` where `s_admin_id`= '$admin_id' limit 1";
    $run = $this ->link ->prepare($select);
    $run->execute(); 
    //print_r($run ->errorInfo());
    if($run ->rowCount()){        
        while($info = $run->fetchObject()){
         $response = true;
        
         $said = preg_replace("#[^0-9]#","",$info ->said);
         $s_admin_id = preg_replace("#[^0-9a-zA-Z.-]#","",$info ->s_admin_id);
         $_sch_id = preg_replace("#[^0-9a-zA-Z@]#","",$info ->_sch_id);
         $email = preg_replace("#[^0-9a-zA-Z@.]#","",$info ->email);
         $firstname = preg_replace("#[^0-9a-zA-Z-]#","",$info ->firstname);
         $address = preg_replace("#[^0-9a-zA-Z-@,./ ]#","",$info ->address);
         $midname = preg_replace("#[^0-9a-zA-Z-]#","",$info ->midname);
         $lastname = preg_replace("#[^0-9a-zA-Z-]#","",$info ->lastname);
         $contact = preg_replace("#[^0-9]#","",$info ->contact);

        }
    }
    return array("response"=>$response,"said" =>$said,"s_admin_id" =>$s_admin_id,"_sch_id"=> $_sch_id,"email"=>$email,"firstname"=>$firstname,"midname"=>$midname,"lastname"=>$lastname,"contact"=>$contact,"address"=>$address);
 }


  // Get Uniform size By Admin ID
    public function getUni($school_id){
    $response = "";$said = "";  $s_admin_id = ""; $_sch_id = ""; $email=""; $firstname=""; $midname=""; $lastname=""; $contact=""; $address="";
    //not done
    $select ="select `said`,`s_admin_id`,`_sch_id`,`email`,`firstname`,`midname`,`lastname`,`address`,`contact` from `sch_admin` where `email`= '$school_id' limit 1";
    $run = $this ->link ->prepare($select);
    $run->execute(); 
    //print_r($run ->errorInfo());
    if($run ->rowCount()){        
        while($info = $run->fetchObject()){
         $response = true;
        
         $said = preg_replace("#[^0-9]#","",$info ->said);
         $s_admin_id = preg_replace("#[^0-9a-zA-Z.-]#","",$info ->s_admin_id);
         $_sch_id = preg_replace("#[^0-9a-zA-Z@]#","",$info ->_sch_id);
         $email = preg_replace("#[^0-9a-zA-Z@.]#","",$info ->email);
         $firstname = preg_replace("#[^0-9a-zA-Z-]#","",$info ->firstname);
         $address = preg_replace("#[^0-9a-zA-Z-@,./ ]#","",$info ->address);
         $midname = preg_replace("#[^0-9a-zA-Z-]#","",$info ->midname);
         $lastname = preg_replace("#[^0-9a-zA-Z-]#","",$info ->lastname);
         $contact = preg_replace("#[^0-9]#","",$info ->contact);

        }
    }
    return array("response"=>$response,"said" =>$said,"s_admin_id" =>$s_admin_id,"_sch_id"=> $_sch_id,"email"=>$email,"firstname"=>$firstname,"midname"=>$midname,"lastname"=>$lastname,"contact"=>$contact,"address"=>$address);
 }

}
ob_end_flush();
?>