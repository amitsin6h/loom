<?php


class Login{

		public $mysqli;
		public $fetch = array();

		function __construct(){

			require_once('models/db.class.php');

			$database = new DB();
			$this->mysqli = $database->db;

		}

		public function Login_user($email,$password){

			$fetch_entry = "SELECT * FROM users WHERE email='".$email."' AND password='".md5($password)."'";
			$get_entry = mysqli_query($this->mysqli, $fetch_entry);
			return $get_entry;
		}

		public function get_emp($empcode){

			$fetch_entry = "SELECT * FROM employee WHERE emp_code='".$empcode."'";
			$get_entry = mysqli_query($this->mysqli, $fetch_entry);
			return $get_entry;
		}

		public function get_emp2(){

			$fetch_entry = "SELECT * FROM employee";
			$get_entry = mysqli_query($this->mysqli, $fetch_entry);
			return $get_entry;
		}	

		public function get_loom(){

			$fetch_entry = "SELECT DISTINCT(loom_no) FROM entry";
			$get_entry = mysqli_query($this->mysqli, $fetch_entry);
			return $get_entry;
		}	

		public function add_input($date, $shift, $loom_no, $quality, $emp_code, $emp_name, $start_reading, $end_reading, $production, $type, $remarks){
			$ts=time();
			$user=$_SESSION['email'];
			$add_entry = "INSERT INTO `entry`(`entry_date`, `shift`, `loom_no`, `quality`, `emp_code`, `emp_name`, `start_reading`, `end_reading`, `production`, `type`, `remarks`,`ts`,`user_log`) VALUES ('$date', '$shift', '$loom_no', '$quality', '$emp_code', '$emp_name', '$start_reading', '$end_reading', '$production', '$type', '$remarks','$ts','$user')";
			$get_entry=mysqli_query($this->mysqli, $add_entry);			
			return $get_entry;
		}

		public function add_employee($emp_code, $emp_name){
			$ts=time();
			if($_SESSION['member_type']=="admin"){
			$add_entry = "INSERT INTO `employee`(`emp_code`, `emp_name` ) VALUES ('$emp_code','$emp_name')";
			$get_entry=mysqli_query($this->mysqli, $add_entry);			
			return $get_entry;
			}
		}
		
		public function update_input($end_reading, $production, $id){
			
			$add_entry = "UPDATE entry SET end_reading='$end_reading', production='$production' WHERE id='$id'";
			
			$get_entry=mysqli_query($this->mysqli, $add_entry);

			return $get_entry;
		}
		public function delete_input($id){
			$add_entry = "DELETE FROM entry WHERE id='$id'";
			if($_SESSION['member_type']=="admin"){
			$get_entry=mysqli_query($this->mysqli, $add_entry);			
			return $get_entry;
			}
		}
		
		public function delete_emp($id){
			$add_entry = "DELETE FROM employee WHERE id='$id'";
			if($_SESSION['member_type']=="admin"){
			$get_entry=mysqli_query($this->mysqli, $add_entry);			
			return $get_entry;
			}
		}
		public function getReport($from_date, $to_date, $shift, $loom_no, $emp_code, $quick_tab)
		{
			$querySubString="1 = 1 ";
			if($from_date!="" && $to_date!="" && $quick_tab=="")
			{
				$querySubString .=  "AND entry_date BETWEEN '$from_date' AND '$to_date' ";
			}
			if($from_date!="" && $to_date!="" && $quick_tab!="")
			{
				$querySubString .=  "AND entry_date BETWEEN '$from_date' AND '$to_date' ";
			}
			if($from_date=="" && $to_date=="" && $quick_tab=="TODAY")
			{
				$today=date("Y-m-d");
				$querySubString .=  "AND entry_date BETWEEN '$today' AND '$today' ";
			}
			if($from_date=="" && $to_date=="" && $quick_tab=="YESTERDAY")
			{
				$date = date("Y-m-d");
				$newdate = strtotime ( '-1 day' , strtotime ( $date ) ) ;
				$newdate = date ( 'Y-m-d' , $newdate );
				$querySubString .=  "AND entry_date BETWEEN '$newdate' AND '$newdate' ";
			}
			if($from_date=="" && $to_date=="" && $quick_tab=="LAST MONTH")
			{
				$month_ini = new DateTime("first day of last month");
				$month_end = new DateTime("last day of last month");
				$first=$month_ini->format('Y-m-d');
				$last=$month_end->format('Y-m-d');
				$querySubString .=  "AND entry_date BETWEEN '$first' AND '$last' ";
			}
			if($shift!="" && $shift!="ALL")
			{
				$querySubString .=  "AND shift='$shift' ";
			}
			if($loom_no!="" && $loom_no!="ALL")
			{
				$querySubString .=  "AND loom_no='$loom_no' ";
			}
			if($emp_code!="" && $emp_code!="ALL")
			{
				$querySubString .=  "AND emp_code='$emp_code' ";
			}
			$sql = "SELECT id,entry_date,shift,loom_no,emp_code,emp_name,type,start_reading,end_reading,production, CASE WHEN production <700 THEN '0' WHEN production >1299 THEN '25' WHEN production >1199 THEN '20' WHEN production >1099 THEN '15' WHEN production >999 THEN '10' WHEN production >899 THEN '5' WHEN production >899  THEN '51-60' WHEN production >=700 AND type ='ANTISLIP' THEN '5' END AS incentive FROM entry WHERE $querySubString ";
			$get_entry=mysqli_query($this->mysqli, $sql);	
			return $get_entry;
		}
		
		
		public function getReport3($from_date, $to_date, $shift, $loom_no, $emp_code, $quick_tab)
		{
			$querySubString="1 = 1 ";
			if($from_date!="" && $to_date!="" && $quick_tab=="")
			{
				$querySubString .=  "AND entry_date BETWEEN '$from_date' AND '$to_date' ";
			}
			if($from_date!="" && $to_date!="" && $quick_tab!="")
			{
				$querySubString .=  "AND entry_date BETWEEN '$from_date' AND '$to_date' ";
			}
			if($from_date=="" && $to_date=="" && $quick_tab=="TODAY")
			{
				$today=date("Y-m-d");
				$querySubString .=  "AND entry_date BETWEEN '$today' AND '$today' ";
			}
			if($from_date=="" && $to_date=="" && $quick_tab=="YESTERDAY")
			{
				$date = date("Y-m-d");
				$newdate = strtotime ( '-1 day' , strtotime ( $date ) ) ;
				$newdate = date ( 'Y-m-d' , $newdate );
				$querySubString .=  "AND entry_date BETWEEN '$newdate' AND '$newdate' ";
			}
			if($from_date=="" && $to_date=="" && $quick_tab=="LAST MONTH")
			{
				$month_ini = new DateTime("first day of last month");
				$month_end = new DateTime("last day of last month");
				$first=$month_ini->format('Y-m-d');
				$last=$month_end->format('Y-m-d');
				$querySubString .=  "AND entry_date BETWEEN '$first' AND '$last' ";
			}
			if($shift!="" && $shift!="ALL")
			{
				$querySubString .=  "AND shift='$shift' ";
			}
			if($loom_no!="" && $loom_no!="ALL")
			{
				$querySubString .=  "AND loom_no='$loom_no' ";
			}
			if($emp_code!="" && $emp_code!="ALL")
			{
				$querySubString .=  "AND emp_code='$emp_code' ";
			}
			$sql = "SELECT entry.entry_date,entry.emp_code,entry.emp_name,entry.type as mess,count(entry.loom_no) as l_n_count,sum(entry.production) as production,(SELECT mess_matrix.incentive FROM mess_matrix WHERE SUM(entry.production) BETWEEN mess_matrix.production_min AND mess_matrix.production_max AND mess_matrix.mess_size=entry.type AND count(entry.loom_no)=mess_matrix.mess_count LIMIT 1) as ince,GROUP_CONCAT(entry.shift SEPARATOR ', ') as shift,GROUP_CONCAT(entry.start_reading SEPARATOR ', ') as start_reading,GROUP_CONCAT(entry.end_reading SEPARATOR ', ') as end_reading,GROUP_CONCAT(loom_no SEPARATOR ', ') as loom_details FROM entry WHERE $querySubString GROUP BY entry.emp_code, entry.type,entry.entry_date ORDER BY entry.entry_date";
			$get_entry=mysqli_query($this->mysqli, $sql);	
			return $get_entry;
		}

		
		public function getReport1()
		{
			$querySubString="end_reading = ''";
			$sql = "SELECT id,entry_date,shift,loom_no,emp_code,emp_name,type,start_reading,end_reading,production, CASE WHEN production <700 THEN '0' WHEN production >1299 THEN '25' WHEN production >1199 THEN '20' WHEN production >1099 THEN '15' WHEN production >999 THEN '10' WHEN production >899 THEN '5' WHEN production >899  THEN '51-60' WHEN production >=700 AND type ='ANTISLIP' THEN '5' END AS incentive FROM entry WHERE $querySubString ";
			$get_entry=mysqli_query($this->mysqli, $sql);	
			return $get_entry;
		}


		
		public function get_empp()
		{			
			$sql = "SELECT * FROM employee";
			$get_entry=mysqli_query($this->mysqli, $sql);	
			return $get_entry;
		}
}
?>

