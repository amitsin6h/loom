<?php
	session_start();
	define('db_host', 'localhost');  
    define('db_user', 'root');  
    define('db_pass', 'toor');  
    define('db_name', 'loom');
    
class DB{

	public $db;
	function __construct(){
		
		$this->db = new mysqli(db_host, db_user, db_pass, db_name);
		if(mysqli_connect_error()){
			echo "Connection Failed";
			exit();
		}
	}
	public function Close(){
		mysqli_close();
	}


}


?>