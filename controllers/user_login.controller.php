<?php

require_once('models/user_login.model.php');

class LoginController{
	
	public $fetch_email;
	public $fetch_emp;
	public $entry_flag;
	public $report_data;

	
	public function loginuser(){
		
		$login = new Login();

		if (isset($_POST['submit'])) {
			$email = htmlentities($_POST['email']);
			$password = htmlentities($_POST['password']);
			$submit_entry = $login->Login_user($email, $password);
			return $this->fetch_email = $submit_entry;
			
		}
	}



	public function getEmpName(){
		
		$login = new Login();

		if (isset($_POST['submit'])) {
			$empcode = htmlentities($_POST['empcode']);			
			$submit_entry = $login->get_emp($empcode);
			return $this->fetch_emp = $submit_entry;
			
		}
	}
	public function getEmpName2(){
		
		$login = new Login();
		$submit_entry = $login->get_emp2();
		return $this->fetch_emp = $submit_entry;		
		
	}
	public function getLoom(){
		
		$login = new Login();
		$submit_entry = $login->get_loom();
		return $this->fetch_emp = $submit_entry;		
		
	}
	
	
	public function add_entry(){
		
		$login = new Login();

		if (isset($_POST['submit'])) {
			$date = htmlentities($_POST['date']);
			$shift = htmlentities($_POST['shift']);
			$loom_no = htmlentities($_POST['loom_no']);
			$quality = htmlentities($_POST['quality']);
			$emp_code = htmlentities($_POST['emp_code']);
			$emp_name = htmlentities($_POST['emp_name']);
			$start_reading = htmlentities($_POST['start_reading']);
			$end_reading = htmlentities($_POST['end_reading']);
			$production = htmlentities($_POST['production']);
			$type = htmlentities($_POST['type']);
			$remarks = htmlentities($_POST['remarks']);			
			$submit_entry = $login->add_input($date, $shift, $loom_no, $quality, $emp_code, $emp_name, $start_reading, $end_reading, $production, $type, $remarks);
			return $this->entry_flag = $submit_entry;
		}
	}
	
		public function add_emp(){
		
		$login = new Login();

		if (isset($_POST['submit'])) {

			$emp_code = htmlentities($_POST['emp_code']);
			$emp_name = htmlentities($_POST['emp_name']);
				
			$submit_entry = $login->add_employee($emp_code, $emp_name);
			return $this->entry_flag = $submit_entry;
		}
	}
	
	public function update_entry(){
		
		$login = new Login();

		if (isset($_POST['submit'])) {
			$end_reading = htmlentities($_POST['end_reading']);
			$production = htmlentities($_POST['production']);
			$id = htmlentities($_POST['id']);			
			$submit_entry = $login->update_input($end_reading, $production, $id);
			return $this->entry_flag = $submit_entry;
		}
	}
	
	public function delete_entry(){
		
		$login = new Login();

		if (isset($_POST['submit']) && $_SESSION['member_type']=="admin") {
			$id = htmlentities($_POST['Id']);			
			$submit_entry = $login->delete_input($id);
			return $this->entry_flag = $submit_entry;
		}
	}
	
	public function delete_emp(){
		
		$login = new Login();

		if (isset($_POST['submit']) && $_SESSION['member_type']=="admin") {
			$id = htmlentities($_POST['Id']);			
			$submit_entry = $login->delete_emp($id);
			return $this->entry_flag = $submit_entry;
		}
	}	
	

	/*live loom*/
	public function get_report(){
		
		$login = new Login();

		
			$from_date = htmlentities($_POST['from_date']);
			$to_date = htmlentities($_POST['to_date']);
			$quick_tab = htmlentities($_POST['quick_tab']);
			$shift = htmlentities($_POST['shift']);
			$loom_no = htmlentities($_POST['loom_no']);			
			$emp_code = htmlentities($_POST['emp_code']);					
			$submit_entry = $login->getReport($from_date, $to_date, $shift, $loom_no, $emp_code,$quick_tab);
			return $this->report_data = $submit_entry;
		
	}
	
	public function get_report3(){
		
		$login = new Login();

		
			$from_date = htmlentities($_POST['from_date']);
			$to_date = htmlentities($_POST['to_date']);
			$quick_tab = htmlentities($_POST['quick_tab']);
			$shift = htmlentities($_POST['shift']);
			$loom_no = htmlentities($_POST['loom_no']);			
			$emp_code = htmlentities($_POST['emp_code']);					
			$submit_entry = $login->getReport3($from_date, $to_date, $shift, $loom_no, $emp_code,$quick_tab);
			return $this->report_data = $submit_entry;
		
	}
	public function get_report1(){
		
		$login = new Login();

		
			$submit_entry = $login->getReport1();
			return $this->report_data = $submit_entry;
		
	}
	
	public function get_empp(){
		
		$login = new Login();

		
			$submit_entry = $login->get_empp();
			return $this->report_data = $submit_entry;
		
	}
}


?>
