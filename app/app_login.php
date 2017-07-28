<?php
	

	if($_SERVER['REQUEST_METHOD']=='POST'){
	 $email = $_POST['email'];
	 $password = $_POST['password'];
	 
	require_once('../models/db.class.php');
	$database = new DB();
	$con = $database->db;
	 
	 $sql = "SELECT * FROM users WHERE email='".$email."' AND password='".md5($password)."'";
	 
	 $result = mysqli_query($con,$sql);

	// if (!$result) {
 //    	printf("Error: %s\n", mysqli_error($con));
 //    	exit();
	// }
	 
	 $check = mysqli_fetch_array($result);
	 
		if(isset($check)){
		 echo 'Successfully loged in';
		}else{
		 echo 'Somethingd is wrong';
		}
	}

?>