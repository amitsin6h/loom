<?php
require_once('logoff.php');
if(isset($_SESSION['email'])){
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
        Add Inputs
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Entry</a></li>
        <li class="active">Add Inputs</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Basic Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="row">
              <div class="col-md-12">
                <div class="box-body">
                  <div class="col-xs-3">
                  <label>DATE</label>
                  <input class="form-control" placeholder="DATE" id="date" type="text">
                  </div>
                  <div class="col-xs-3 form-group">
                    <label>SHIFT</label>
                    <select class="form-control" id="shift">
                      <option value="">DAY/NIGHT</option>
                      <option value="DAY">DAY</option>
                      <option value="NIGHT">NIGHT</option>
                    </select>
                  </div>
                  <div class="col-xs-3">
                  <label>LOOM NO</label>
                  <input class="form-control" placeholder="LOOM NO" id="loom_no" onKeyUp="numericFilter(this);" type="text">
                  </div>
                  <div class="col-xs-3">
                  <label>QUALITY</label>
                  <input class="form-control" placeholder="QUALITY" id="quality" onKeyUp="toUpper(this);" type="text">
                  </div>
                </div> 
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="box-header">
                  <h3 class="box-title">EMPLOYEE DETAILS</h3>
                </div>
                <div class="box-body">
                  <div class="col-xs-3">
                  <label>EMPLOYEE CODE</label>
                  <input class="form-control" placeholder="EMPLOYEE CODE" onKeyUp="numericFilter_empcode(this);" id="emp_code" type="text">
                  </div>
                  <div class="col-xs-5">
                  <label>EMPLOYEE NAME</label>
                  <input class="form-control" placeholder="EMPLOYEE NAME" id="emp_name" readonly type="text">
                  </div>
                  <div class="col-xs-2">
                  <label>START READING</label>
                  <input class="form-control" placeholder="START READING" onKeyUp="numericFilter_End(this);" id="start_reading" type="text">
                  </div>
                  <div class="col-xs-2">
                  <label>END READING</label>
                  <input class="form-control" placeholder="END READING" onKeyUp="numericFilter_End(this);" id="end_reading" type="text">
                  </div>
                </div> 
              </div>
            </div> 
            <div class="row">
              <div class="col-md-12">
               <!--  <div class="box-header">
                  <h3 class="box-title">Employee Details</h3>
                </div> -->
                <div class="box-body">
                  <div class="col-xs-4">
                  <label>PRODUCTION</label>
                  <input class="form-control" placeholder="PRODUCTION" readonly id="production" type="text">
                  </div>
                  <div class="col-xs-4 form-group">
                    <label>MESS</label>
                    <select class="form-control" id="type">
                      <option value="">10*10 / 11 *11 / 12*12 / OTHER</option>
                      <option value="10*10">10*10</option>
                      <option value="11*11">11*11</option>
                      <option value="12*12">12*12</option>
                      <option value="OTHER">OTHER</option>
                    </select>
                  </div>
                  <div class="col-xs-4">
                  <label>REMARKS</label>
                  <input class="form-control" id="remarks" onKeyUp="toUpper(this);" placeholder="REMARKS" type="text">
                  </div>
                </div> 
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <!-- <div class="box-header">
                  <h3 class="box-title">Employee Details</h3>
                </div> -->
                <div class="box-body">
                  <div class="col-xs-4 col-xs-offset-4">
                    <button type="submit" name="submit" id="btn_submit" onclick="validate()" class="btn btn-block btn-primary btn-flat">ADD ENTRY</button>
                  </div>
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
	$('.box').find('select').prop('selectedIndex',0);
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
				$('#emp_name').val(response.emp_name);
			}
			else
			{
				Notify("Invalid Employee Code", null, null, 'danger');
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
function numericFilter_End(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
   var start_reading=$("#start_reading").val();
	var end_reading=$("#end_reading").val();	
	//console.log(end_reading-start_reading);
	if(parseInt(start_reading.trim(),10)<parseInt(end_reading.trim(),10))
		$('#production').val(parseInt(end_reading.trim(),10)-parseInt(start_reading.trim(),10));
		//production.value=end_reading-start_reading;
	else
		$('#production').val("0");
	
}

function toUpper(txb) {
   txb.value = txb.value.toUpperCase();
}
function validate(){
	var date=$("#date").val();
	var date_f = new Date();
var utc = moment(date_f).format('YYYY-MM-DD');

	var shift=$("#shift").val();
	var loom_no=$("#loom_no").val();
	var quality=$("#quality").val();
	var emp_code=$("#emp_code").val();
	var emp_name=$("#emp_name").val();
	var start_reading=$("#start_reading").val();
	var end_reading=$("#end_reading").val();
	var production=$("#production").val();
	var type=$("#type").val();
	var remarks=$("#remarks").val();
	if(date.trim().length==0)
		Notify("Date is Required", null, null, 'danger');
	if(shift.trim().length==0)
		Notify("Shift is Required", null, null, 'danger');
	if(loom_no.trim().length==0)
		Notify("Loom No is Required", null, null, 'danger');
	else
		if(loom_no.trim().length!=3)
			Notify("Loom No must be only 3 digit", null, null, 'danger');
	if(emp_code.trim().length==0)
		Notify("Employee Code is Required", null, null, 'danger');
	else
		if(emp_code.trim().length!=3)
			Notify("Employee Code must be only 3 digit", null, null, 'danger');
	if(start_reading.trim().length==0)
		Notify("Start Reading is Required", null, null, 'danger');		

	if(parseInt(start_reading.trim(),10)>parseInt(end_reading.trim(),10))
		Notify("Start Reading Must be low than End Reading ", null, null, 'danger');
	if(type.trim().length==0)
		Notify("Mess is Required", null, null, 'danger');
	if(emp_name.trim().length==0)
		Notify("Employee Name is not fetched", null, null, 'danger');
	if(date!=utc)
		Notify("Invalid Date, Select today's date", null, null, 'danger');
	if(date==utc && shift.trim().length!=0 && loom_no.trim().length==3 && emp_code.trim().length==3 && emp_name.trim().length!=0 && parseInt(production.trim(),10)>=0 && type.trim().length!=0)		
	{
		if(parseInt(start_reading.trim(),10)<parseInt(end_reading.trim(),10) && start_reading.trim().length!=0 && end_reading.trim().length!=0)
		{			
			var myKeyVals="to_do=add_input&date="+date+"&submit=Add Entry&shift="+shift+"&loom_no="+loom_no+"&quality="+quality+"&emp_code="+emp_code+"&emp_name="+emp_name+"&start_reading="+start_reading+"&end_reading="+end_reading+"&production="+production+"&type="+type+"&remarks="+remarks;
		}
		if(start_reading.trim().length!=0 && end_reading.trim().length==0)
		{			
			var myKeyVals="to_do=add_input&date="+date+"&submit=Add Entry&shift="+shift+"&loom_no="+loom_no+"&quality="+quality+"&emp_code="+emp_code+"&emp_name="+emp_name+"&start_reading="+start_reading+"&end_reading="+end_reading+"&production="+production+"&type="+type+"&remarks="+remarks;
		}		
		var saveData = $.ajax({
			type: 'POST',
			url: "login.php",
			data: myKeyVals,
			dataType: "json",
			success: function(resultData) { 
			response = jQuery.parseJSON(JSON.stringify(resultData));
			if(response.inserted===true){								
				Notify("Data Inserted Successfully", null, null, 'success');
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


    $('#date').datepicker({
        format: 'yyyy-mm-dd'
      });
$("#date").keypress(function(event) {
    if (event.which == 13) {
        validate();
     }
});
$("#shift").keypress(function(event) {
    if (event.which == 13) {
        validate();
     }
});	  
$("#loom_no").keypress(function(event) {
    if (event.which == 13) {
        validate();
     }
});	 
$("#quality").keypress(function(event) {
    if (event.which == 13) {
        validate();
     }
});	 
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
$("#start_reading").keypress(function(event) {
    if (event.which == 13) {
        validate();
     }
});	 
$("#end_reading").keypress(function(event) {
    if (event.which == 13) {
        validate();
     }
});
$("#production").keypress(function(event) {
    if (event.which == 13) {
        validate();
     }
});
$("#type").keypress(function(event) {
    if (event.which == 13) {
        validate();
     }
});
$("#remarks").keypress(function(event) {
    if (event.which == 13) {
        validate();
     }
});
	 
  </script>

</body>
</html>
<?php } else { ?>
 <?php require_once("no_session.php"); ?>
<?php } ?>