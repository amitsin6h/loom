<?php
require_once('logoff.php');
if(isset($_SESSION['email'])){
	if($_SESSION['member_type']=="admin"){
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Project | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->

  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
   <link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <style>
  #notifications {
    cursor: pointer;
    position: fixed;
    right: 0px;
    z-index: 9999;
    bottom: 0px;
    margin-bottom: 22px;
    margin-right: 15px;
    max-width: 300px;   
}
  </style>
</head>
<body class="sidebar-mini skin-green sidebar-collapse">
<div id="notifications"></div>

<div class="wrapper">

  <?php require_once("sidebar.php"); ?>
  <?php require_once("header.php"); ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Employee
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Entry</a></li>
        <li class="active">Add Employee</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add Employee</h3>
            </div>
            <!-- /.box-header -->
            <div class="row">
              <div class="col-md-12">
                <div class="box-body">
                  <div class="col-xs-3">
                  <label>EMPLOYEE CODE</label>
                  <input class="form-control" placeholder="EMPLOYEE CODE" onkeyup="numericFilter_empcode(this);" id="emp_code" type="text">
                  </div>
                  <div class="col-xs-3 form-group">
                    <label>EMPLOYEE NAME</label>
                    <input class="form-control" placeholder="EMPLOYEE NAME" onkeyup="toUpper(this);" id="emp_name" type="text">
                  </div>
                  <div class="col-xs-3">
					<label>Add Button</label>
                    <button type="submit" name="submit" id="btn_submit" onclick="validate()" class="btn btn-block btn-primary btn-flat">ADD EMPLOYEE</button>
                  </div>
                </div> 
              </div>
            </div>
          </div>

          <!-- /.box -->

        
        </div>
        <!-- /.col -->
      </div>
	  <div class="row">
        <div class="col-xs-12">
        
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Added Employees List</h3>
            </div>
            <!-- /.box-header -->
            <div class="row">
              <div class="col-md-12">
                <div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="font-size:12px;">          
                  <th>EMPLOYEE CODE</th>
                  <th>EMPLOYEE NAME</th>                  
				  <?php if($_SESSION['member_type']=="admin"){ ?>
                  <th>ACTION</th>
				<?php } ?>
                </tr>
                </thead>
                <tbody>
            
                </tbody>                
              </table>
				</div>
			</div>
            </div>
          </div>

          <!-- /.box -->

        
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?php require_once("footer.php"); ?>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/app.min.js"></script>
<script src="assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="assets/Notify.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>

<script>

function resetAllValues() {
	$('.box').find('input:text').val('');	
}
function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
function numericFilter_empcode(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
   var emp_code=$('#emp_code').val().trim();
   emp_code=emp_code.trim();
   if(emp_code.length==3)
   {
			var myKeyVals="to_do=get_emp&empcode="+emp_code+"&submit=Get Emp";
	   		var saveData = $.ajax({
			type: 'POST',
			url: "login.php",
			data: myKeyVals,
			dataType: "json",
			success: function(resultData) { 
			response = jQuery.parseJSON(JSON.stringify(resultData));
			if(response.error===false){								
				Notify("Employee Already Exist", null, null, 'danger');
				$('#emp_code').val("");
			}			
			}
		});
		saveData.error(function() { console.log("error"); });
   }
   else
   {
	   $('#emp_name').val("");
   }
}

function drawTable()
   {
	   $('#example1').DataTable( {		
		   "destroy": true,
			"ajax": 'login.php?to_do=get_employee'		
		} );
   }

function toUpper(txb) {
   txb.value = txb.value.toUpperCase();
}
function validate(){

	var emp_code=$("#emp_code").val();
	var emp_name=$("#emp_name").val();
	
	if(emp_code.trim().length==0)
		Notify("Employee Code is Required", null, null, 'danger');
	else
		if(emp_code.trim().length!=3)
			Notify("Employee Code must be only 3 digit", null, null, 'danger');

	if(emp_name.trim().length==0)
		Notify("Employee Name is required", null, null, 'danger');

	if(emp_code.trim().length==3 && emp_name.trim().length!=0)		
	{
					
		var myKeyVals="to_do=add_emp&emp_code="+emp_code+"&submit=Add Entry&emp_name="+emp_name;
		var table = $('#example1').DataTable();
		var saveData = $.ajax({
			type: 'POST',
			url: "login.php",
			data: myKeyVals,
			dataType: "json",
			success: function(resultData) { 
			response = jQuery.parseJSON(JSON.stringify(resultData));
			if(response.inserted===true){								
				Notify("Employee Added Successfully", null, null, 'success');
				table.clear().draw();				
				drawTable();
				resetAllValues();
			}
			else
			{
				Notify("Something Went Wrong", null, null, 'danger');
			}
			}
		});
		saveData.error(function() { console.log("error"); });
		
;
	}
			
}


  
$("#emp_code").keypress(function(event) {
    if (event.which == 13) {
        validate();
     }
});	 
$("#emp_name").keypress(function(event) {
    if (event.which == 13) {
        validate();
     }
});	 

$(document).ready(function() {
    $('#example1').DataTable( {
		
        "ajax": 'login.php?to_do=get_employee'
		
    } );
} );

	function del(elem){
		var Id = $(elem).data('id');
		var myKeyVals="to_do=Delete_emp&Id="+Id+"&submit=Del";	
		var table = $('#example1').DataTable();
		var saveData = $.ajax({
			type: 'POST',
			url: "login.php",
			data: myKeyVals,
			dataType: "json",
			success: function(resultData) { 
			response = JSON.stringify(resultData);
			if(resultData.deleted===true){
				alert("DELETED SUCCESSFULLY");
				
			}			
			drawTable();			
			}
		});
		saveData.error(function() { console.log("error"); });
	}
	 
  </script>

</body>
</html>
<?php } } else { ?>
 <?php require_once("no_session.php"); ?>
<?php } ?>