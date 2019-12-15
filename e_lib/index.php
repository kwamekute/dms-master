<?php
ob_start();

class Connection{

    public $link;

    public function __construct(){
		      define('HOST',"localhost");
	          define('USER',"root");
	          define('PASS',"");
	          define('DB',"dms-master");
	try{
		$this ->link = new PDO('mysql:host='.HOST.';dbname='.DB,USER,PASS);
		return $this ->link;
  }
    catch(PDOException $e)
          {
          echo "Connection failed: " . $e->getMessage();
          }
	}
	public function valid_email($email) {
  		return (! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
	}

    protected function filter_string($string){
        return filter_var($string,FILTER_SANITIZE_STRING);
    }
}

ob_end_flush();
?>
