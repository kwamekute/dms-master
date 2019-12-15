<?php 
$link = $_SERVER['DOCUMENT_ROOT'];
include '../e_lib/connect.php';

if(isset($_POST['id'])){
	    echo $id = $_POST['id']; 
        //$user_info ->images_g($id);
        
        }else{
        echo "something went wrong";
        }


ob_end_flush();
 ?>