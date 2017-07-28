<?php
	

	if($_SERVER['REQUEST_METHOD']=='GET'){
		require_once('../models/db.class.php');
		$database = new DB();
		$con = $database->db;
		 
		 $sql = "SELECT id,entry_date,shift,loom_no,emp_code,emp_name,type,start_reading,end_reading,production, CASE WHEN production <700 THEN '0' WHEN production >1299 THEN '25' WHEN production >1199 THEN '20' WHEN production >1099 THEN '15' WHEN production >999 THEN '10' WHEN production >899 THEN '5' WHEN production >899 THEN '51-60' WHEN production >=700 AND type ='ANTISLIP' THEN '5' END AS incentive FROM entry WHERE end_reading = ''";
		 
		 $result = mysqli_query($con,$sql);
		
		/*if (!$result) {
	    	printf("Error: %s\n", mysqli_error($con));
	    	exit();
		}*/

		$outArray = array();
		if ($result) {
	  		while ($row = mysqli_fetch_assoc($result)) $outArray[] = $row;
		}
		
		header('Content-Type: application/json');
		echo json_encode($outArray); 
		 
	}


?>
