<?php
	

	if($_SERVER['REQUEST_METHOD']=='POST'){




	 	$name = $_POST['name'];
	 	$email = $_POST['email'];
			  	

	    require_once('../models/db.class.php');
		$database = new DB();
		$con = $database->db;
	 
	
	 
	 	$sql = "INSERT INTO `userdata`(`name`, `email`, `password`) VALUES ($name,$email,$password);";
	 
	 	//$result = mysqli_query($con,$sql);

		if (!mysqli_query($con,$sql)) {
	    	printf("Error: %s\n", mysqli_error($con));
	    	exit();
		}
	 	

	 
		if(mysqli_query($con,$sql)){
		 	echo 'Successfully Submitted';
		}else{
		 	echo 'Somethingd is wrong';
		}
	  
	}

?>