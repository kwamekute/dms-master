<?php
ob_start();

class Searcht extends Officer_login{

 public function search($search,$institute){
                 $ny = date("Y", strtotime("+1 year"));
                     $t = date("Y");
                     $n = $t-1;
                     $c_month = date('m',time());
                     if($c_month <= 6){
                        $academicyear = "$n/$t";
                     }else{
                         $academicyear = "$t/$ny";
                     }
   
    $response = "";$reg_no="";$flname="";$staff_id="";$level="";$prog_of_study="";$flname="";$aca_year="";$ant_qual="";$staff_id="";
   if($institute == ""){
       $query ="WHERE (`app_form`.`reg_no` LIKE '%$search%' or `app_form`.`full_nm` LIKE '%$search%' or `app_form`.`staff_id` LIKE '%$search%' or `app_form`.`level` LIKE 				'%$search%' or `app_form`.`prog_of_study` LIKE '%$search%' or `app_form`.`ant_qual` LIKE '%$search%') and `app_form`.`aca_year` = '$academicyear'";
    }else{
        $query ="WHERE (`app_form`.`reg_no` LIKE '%$search%' or `app_form`.`full_nm` LIKE '%$search%' or `app_form`.`staff_id` LIKE '%$search%' or `app_form`.`level` LIKE '%$search%' or `app_form`.`prog_of_study` LIKE '%$search%' or `app_form`.`ant_qual` LIKE '%$search%') and `app_form`.`inst_of_study` = '$institute' and `app_form`.`aca_year` = '$academicyear'";
    }
     
$sql = "SELECT DISTINCT  `app_form`.`reg_no`,`app_form`.`full_nm`,`app_form`.`staff_id`,`app_form`.`level`,`app_form`.`prog_of_study`,`app_form`.`ant_qual`,`app_form`.`signed`,`app_form`.`aca_year`,`officers`.`institute` from `app_form` left join `officers` on `app_form`.`inst_of_study` = `officers`.`institute`".$query;  
$run = $this ->link ->query($sql);

if($run ->rowCount()){
      ?>

                      <table class="table">         
                <tr>
                            <th>No.</th>
                            <th>STAFF ID</th>
                            <th>REGISTRATION NO</th>
                            <th>FULL NAME</th>
                            <th>LEVEL</th>
                            <th>ACADEMIC YEAR</th>
                            <th>PROGRAM</th>
                            <th>QUALIFICATION</th>
                            <th>All FILES</th>
                            <th>ACTION</th>
                </tr>
              </thead>
                            
          
      <?php
      $count = 1;
        while ($info = $run ->fetchObject()) {
           $response = true;
           $reg_no = $info ->reg_no;
           $staff_id = $info ->staff_id;
           $prog_of_study = $info ->prog_of_study;
           $level = $info ->level;
           $flname = $info ->full_nm;
           $ant_qual = $info ->ant_qual;
           $sign = $info ->signed;
           $aca_year = $info ->aca_year;
           ?>
           <tbody>
           <tr>
           <td><?php echo $count?></td>
           <td><?php echo $staff_id?></td>
           <td><?php echo $reg_no?></td>
           <td><?php echo $flname?></td>
           <td><?php echo $level?></td>
           <td><?php echo $aca_year?></td>
           <td><?php echo $prog_of_study?></td>
           <td><?php echo $ant_qual?></td>
           <td><a href="../zipdownload.php?a=<?php echo $staff_id ?>"><i class="fa fa-download"></i> download</td>
           
            <td>
              <?php
              $n="a_$staff_id";
               if($sign){
                $color = 'btn btn-success';$active="0";$name="verified";
               }else{
                $color ='btn btn-danger';$active="1";$name="verify";
               }
              if(isset($_POST["$n"])){

              $this ->ver($staff_id,$active);
               }
              
              ?>
              <button type="submit" name="<?php echo $n ?>" value="" class="<?php echo $color ?> verify" id="<?php echo $a_staff_id ?>" onclick='verifyteacher("<?php echo $staff_id ?>","<?php echo $active ?>")'><?php echo $name; ?></button>
          
            </td>
           
           
          
         </tr>
       </tbody>
           <?php
           $count++;
         }
         ?>
          </table>
        
         <?php
       }
else{
    echo "<div class='col-md-12' id='error' style='height:40px; width:100%; background:#ff1a1a;''>
          <p style='text-align:center; color:#fff; padding:10px;'>Data not found</p>
    </div>";
}


 }
}
ob_end_flush();
?>