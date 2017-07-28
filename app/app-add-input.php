<?php
	



		if($_SERVER['REQUEST_METHOD']=='POST'){

	 	$user = $_POST['email'];
	 	$ts = time();
	 	$date = $_POST['date'];
	  	$shift = $_POST['shift'];
	   	$loom_no= $_POST['loom_no'];
	    $quality= $_POST['quality'];
	    $emp_code= $_POST['emp_code'];
	    $emp_name= $_POST['emp_name'];
	    $start_reading= $_POST['start_reading'];
	    $end_reading= $_POST['end_reading'];
	    // $production= $_POST['production'];
		$type= $_POST['type']; //mess value
	    $remarks= $_POST['remarks'];

	    require_once('../models/db.class.php');
		$database = new DB();
		$con = $database->db;
	 
	
	 
	 	$sql = "INSERT INTO entry (entry_date, shift, loom_no, quality, emp_code, emp_name, start_reading, end_reading,type, remarks,ts,user_log) VALUES ('$date', '$shift', '$loom_no', '$quality','$emp_code', '$emp_name', '$start_reading', '$end_reading', '$type', '$remarks','$ts','$user');";
	 
	 	//$result = mysqli_query($con,$sql);

		/*if (!mysqli_query($con,$sql)) {
	    	printf("Error: %s\n", mysqli_error($con));
	    	exit();
		}*/
	 	

	 
		if(mysqli_query($con,$sql)){
		 	echo 'Successfully Submitted';
		}else{
		 	echo 'Somethingd is wrong';
		}
	

	}

?>