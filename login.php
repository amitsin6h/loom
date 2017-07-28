<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();

if($_POST['to_do']=="login")
{
	require_once('controllers/user_login.controller.php');
	$LoginController = new LoginController();
	$result=$LoginController->loginuser();
	
	$json=array();
	if(mysqli_num_rows($result)>0){
		$data=mysqli_fetch_array($result);
		$_SESSION['email']=$data['email'];
		$_SESSION['name']=$data['name'];
		$_SESSION['member_type']=$data['member_type'];
		$_SESSION['designation']=$data['designation'];
		$_SESSION['member_from']=$data['member_from'];
		 $json = array( "error"=>false ,"email" => $data['email']);		 
	}
	else
	{
		$json=array("error"=>true);
	}
	header("Content-Type: application/json", true);
	echo json_encode($json);
}


if(isset($_SESSION['email'])){
if($_POST['to_do']=="get_emp")
{
	require_once('controllers/user_login.controller.php');
	$LoginController = new LoginController();
	$result=$LoginController->getEmpName();
	$json=array();
	if(mysqli_num_rows($result)>0){
		$data=mysqli_fetch_array($result);		
		 $json = array( "error"=>false ,"emp_name" => $data['emp_name']);		 
	}
	else
	{
		$json=array("error"=>true);
	}
	header("Content-Type: application/json", true);
	echo json_encode($json);
}


if($_POST['to_do']=="add_input")
{
	require_once('controllers/user_login.controller.php');
	$LoginController = new LoginController();
	$result=$LoginController->add_entry();
	$json = array( "inserted"=>$result );	
	echo json_encode($json);
}

if($_POST['to_do']=="add_emp")
{
	require_once('controllers/user_login.controller.php');
	$LoginController = new LoginController();
	$result=$LoginController->add_emp();
	$json = array( "inserted"=>$result );	
	echo json_encode($json);
}

if($_POST['to_do']=="update_input")
{
	require_once('controllers/user_login.controller.php');
	$LoginController = new LoginController();
	$result=$LoginController->update_entry();
	$json = array( "inserted"=>$result );	
	echo json_encode($json);
}

if($_POST['to_do']=="Delete")
{
	require_once('controllers/user_login.controller.php');
	$LoginController = new LoginController();
	$result=$LoginController->delete_entry();
	$json = array( "deleted"=>$result );	
	echo json_encode($json);
}

if($_POST['to_do']=="Delete_emp")
{
	require_once('controllers/user_login.controller.php');
	$LoginController = new LoginController();
	$result=$LoginController->delete_emp();
	$json = array( "deleted"=>$result );	
	echo json_encode($json);
}

if($_POST['to_do']=="get_report")
{
	require_once('controllers/user_login.controller.php');
	$LoginController = new LoginController();
	$result=$LoginController->get_report();
	$rows = array();
	while($r = mysqli_fetch_assoc($result)) {
		if($_SESSION['member_type']=="admin"){
			$rows[] = array($r['entry_date'],$r['shift'],$r['loom_no'],$r['emp_code'],$r['emp_name'],$r['type'],$r['start_reading'],$r['end_reading'],$r['production'],$r['incentive'],'<button type="button" data-id="'.$r['id'].'" onclick="if (confirm(\'Are you sure you want to delete this input?\')) del(this); return false;" class="btn btn-danger btn-xs">Delete</button>');
		}
		else
		{
			$rows[] = array($r['entry_date'],$r['shift'],$r['loom_no'],$r['emp_code'],$r['emp_name'],$r['type'],$r['start_reading'],$r['end_reading'],$r['production'],$r['incentive']);
		}
	}
	$data=array("data"=>$rows);
	header("Content-Type: application/json", true);
	echo json_encode($data);
}
if($_GET['to_do']=="get_report")
{
	require_once('controllers/user_login.controller.php');
	$LoginController = new LoginController();
	$result=$LoginController->get_report();
	$rows = array();
	while($r = mysqli_fetch_assoc($result)) {
		if($_SESSION['member_type']=="admin"){
			$rows[] = array($r['entry_date'],$r['shift'],$r['loom_no'],$r['emp_code'],$r['emp_name'],$r['type'],$r['start_reading'],$r['end_reading'],$r['production'],$r['incentive'],'<button type="button" data-id="'.$r['id'].'" onclick="if (confirm(\'Are you sure you want to delete this input?\')) del(this); return false;" class="btn btn-danger btn-xs">Delete</button>');
		}
		else
		{
			$rows[] = array($r['entry_date'],$r['shift'],$r['loom_no'],$r['emp_code'],$r['emp_name'],$r['type'],$r['start_reading'],$r['end_reading'],$r['production'],$r['incentive']);
		}
	}
	$data=array("data"=>$rows);
	header("Content-Type: application/json", true);
	echo json_encode($data);
}

if($_GET['to_do']=="get_employee")
{
	require_once('controllers/user_login.controller.php');
	$LoginController = new LoginController();
	$result=$LoginController->get_empp();
	$rows = array();
	while($r = mysqli_fetch_assoc($result)) {
		if($_SESSION['member_type']=="admin"){
			$rows[] = array($r['emp_code'],$r['emp_name'],'<button type="button" data-id="'.$r['id'].'" onclick="if (confirm(\'Are you sure you want to delete this input?\')) del(this); return false;" class="btn btn-danger btn-xs">Delete</button>');
		}
	}
	$data=array("data"=>$rows);
	header("Content-Type: application/json", true);
	echo json_encode($data);
}

if($_GET['to_do']=="live_loom")
{
	require_once('controllers/user_login.controller.php');
	$LoginController = new LoginController();
	$result=$LoginController->get_report1();
	$rows = array();
	while($r = mysqli_fetch_assoc($result)) {
		$rows[] = array($r['entry_date'],$r['shift'],$r['loom_no'],$r['emp_code'],$r['emp_name'],$r['type'],$r['start_reading'],$r['end_reading'],'<span class="label label-success">Live</span>','<button type="button" class="btn btn-block btn-warning btn-flat btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$r['id'].'" data-date="'.$r['entry_date'].'" data-shift="'.$r['shift'].'" data-loom_no="'.$r['loom_no'].'" data-emp_code="'.$r['emp_code'].'" data-emp_name="'.$r['emp_name'].'" data-type="'.$r['type'].'" data-start_reading="'.$r['start_reading'].'" onclick="mymodal(this)">Edit</button>');
	}
	$data=array("data"=>$rows);
	header("Content-Type: application/json", true);
	echo json_encode($data);
}

/////////////////////////


if($_POST['to_do']=="get_report_3")
{
	require_once('controllers/user_login.controller.php');
	$LoginController = new LoginController();
	$result=$LoginController->get_report3();
	$rows = array();
	while($r = mysqli_fetch_assoc($result)) {
		if($_SESSION['member_type']=="admin"){
			$rows[] = array("entry_date"=>$r['entry_date'],"emp_code"=>$r['emp_code'],"emp_name"=>$r['emp_name'],"mess"=>$r['mess'],"l_n_count"=>$r['l_n_count'],"production"=>$r['production'],"ince"=>$r['ince'],"shift"=>$r['shift'],"start_reading"=>$r['start_reading'],"end_reading"=>$r['end_reading'],"loom_details"=>$r['loom_details']);
		}
		else
		{
			$rows[] = array("entry_date"=>$r['entry_date'],"emp_code"=>$r['emp_code'],"emp_name"=>$r['emp_name'],"mess"=>$r['mess'],"l_n_count"=>$r['l_n_count'],"production"=>$r['production'],"ince"=>$r['ince'],"shift"=>$r['shift'],"start_reading"=>$r['start_reading'],"end_reading"=>$r['end_reading'],"loom_details"=>$r['loom_details']);
		}
	}
	$data=array("data"=>$rows);
	header("Content-Type: application/json", true);
	echo json_encode($data);
}
if($_GET['to_do']=="get_report_3")
{
	require_once('controllers/user_login.controller.php');
	$LoginController = new LoginController();
	$result=$LoginController->get_report3();
	$rows = array();
	while($r = mysqli_fetch_assoc($result)) {
		if($_SESSION['member_type']=="admin"){
			$rows[] = array("entry_date"=>$r['entry_date'],"emp_code"=>$r['emp_code'],"emp_name"=>$r['emp_name'],"mess"=>$r['mess'],"l_n_count"=>$r['l_n_count'],"production"=>$r['production'],"ince"=>$r['ince'],"shift"=>$r['shift'],"start_reading"=>$r['start_reading'],"end_reading"=>$r['end_reading'],"loom_details"=>$r['loom_details']);
		}
		else
		{
			$rows[] = array("entry_date"=>$r['entry_date'],"emp_code"=>$r['emp_code'],"emp_name"=>$r['emp_name'],"mess"=>$r['mess'],"l_n_count"=>$r['l_n_count'],"production"=>$r['production'],"ince"=>$r['ince'],"shift"=>$r['shift'],"start_reading"=>$r['start_reading'],"end_reading"=>$r['end_reading'],"loom_details"=>$r['loom_details']);
		}
	}
	$data=array("data"=>$rows);
	header("Content-Type: application/json", true);
	echo json_encode($data,JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}
}
?>
