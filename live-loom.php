<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once('logoff.php');
if(isset($_SESSION['email'])){

require_once('controllers/user_login.controller.php');
$LoginController = new LoginController();

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
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
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

  <?php require_once("header.php"); ?>
  <?php require_once("sidebar.php"); ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Live Loom
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Entry</a></li>
        <li class="active">Live Loom</li>
      </ol>
    </section>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update End Reading</h4>
      </div>
      <div class="modal-body">
        <table class="table table-condensed">
                <tbody>
				<tr>                  
                  <th>Date</th>
                  <th id="EntryDate"></th>                  
                </tr>
                <tr>                  
                  <th>Shift</th>
                  <th id="EntryShift"></th>                  
                </tr>
                <tr>                  
                  <th>Loom No</th>
                  <th id="EntryLoomNo"></th>                  
                </tr>
                <tr>                  
                  <th>Employee Code</th>
                  <th id="EntryEmpCode"></th>                  
                </tr>
                <tr>                  
                  <th>Employee Name</th>
                  <th id="EntryEmpName"></th>                  
                </tr>
                <tr>                  
                  <th>Type</th>
                  <th id="EntryType"></th>                  
                </tr>
                <tr>                  
                  <th>Start Reading</th>
                  <th id="EntryStartReading"></th>                  
                </tr>
				<tr>                  
                  <th>Production</th>
                  <th id="EntryProduction"></th>                  
                </tr>
                <tr>                  
                  <th>End Reading</th>
                  <th style="width: 240px"><input class="form-control" placeholder="End Reading" id="EndReading" onKeyUp="numericFilter_End(this);"  type="text"></th>
                  <th style="width: 40px"><input class="form-control" readonly placeholder="Id" id="Entry_Id" type="hidden"></th>
                </tr>
              </tbody></table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary pull-left" onClick="update();">Update</button>
      </div>
    </div>

  </div>
</div>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Live Loom Status</h3>
            </div>
            <!-- /.box-header -->            
			<div class="row">
              <div class="col-md-12">
                <div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="font-size:12px;">          
                  <th>Date</th>
                  <th>Shift</th>
                  <th>Loom No.</th>
                  <th>Emp Code</th>
                  <th>Emp Name</th>
				  <th>Type</th>
                  <th>Start Reading</th>
                  <th>End Reading</th>              
                  <th>Status</th>
                  <th>Action</th>
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
<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<!-- SlimScroll -->
<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/app.min.js"></script>
<script src="assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="assets/Notify.js"></script>
<script>
 
  
	  $(document).ready(function() {
    $('#example1').DataTable( {
        "ajax": 'login.php?to_do=live_loom',
		"ordering": false
    } );
} );
function mymodal(elem){
     var Id = $(elem).data('id');
     var Date = $(elem).data('date');
     var Shift = $(elem).data('shift');
     var LoomNo = $(elem).data('loom_no');
     var EmpCode = $(elem).data('emp_code');
     var EmpName = $(elem).data('emp_name');
     var Type = $(elem).data('type');
     var StartReading = $(elem).data('start_reading');	
	document.getElementById("EntryDate").innerHTML = Date;
	document.getElementById("EntryShift").innerHTML = Shift;
	document.getElementById("EntryLoomNo").innerHTML = LoomNo;
	document.getElementById("EntryEmpCode").innerHTML = EmpCode;
	document.getElementById("EntryEmpName").innerHTML = EmpName;
	document.getElementById("EntryType").innerHTML = Type;
	document.getElementById("EntryStartReading").innerHTML = StartReading;
	document.getElementById("Entry_Id").value=Id;
	document.getElementById("EntryProduction").innerHTML="";
	$('#EndReading').val("");
	      // As pointed out in comments, 
     // it is superfluous to have to manually call the modal.
     // $('#addBookDialog').modal('show');
}
function numericFilter_End(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
   var start_reading = document.getElementById("EntryStartReading").textContent;   
	var end_reading=$("#EndReading").val();	
	//console.log(end_reading-start_reading);
	if(parseInt(start_reading.trim(),10)<parseInt(end_reading.trim(),10))
		document.getElementById("EntryProduction").innerHTML = parseInt(end_reading.trim(),10)-parseInt(start_reading.trim(),10);
		//production.value=end_reading-start_reading;
	else
		document.getElementById("EntryProduction").innerHTML =0;
	
}
function update()
{
	var start_reading = document.getElementById("EntryStartReading").textContent;   
	var end_reading=$("#EndReading").val();	
	var production = document.getElementById("EntryProduction").textContent;   
	var Id=$("#Entry_Id").val();	
	var table = $('#example1').DataTable();
	if(parseInt(start_reading.trim(),10)<parseInt(end_reading.trim(),10))
	{
		var myKeyVals="to_do=update_input&submit=Add Entry&end_reading="+end_reading+"&production="+production+"&id="+Id;
		var saveData = $.ajax({
			type: 'POST',
			url: "login.php",
			data: myKeyVals,
			dataType: "json",
			success: function(resultData) { 
			response = jQuery.parseJSON(JSON.stringify(resultData));
			if(response.inserted===true){								
				Notify("Data Updated Successfully", null, null, 'success');
				$('#myModal').modal('hide');
				table.clear().draw();
				$('#example1').DataTable( {
					"destroy": true,
					"ajax": 'login.php?to_do=live_loom',
				});
			}
			else
			{
				Notify("Something Went Wrong", null, null, 'danger');
			}
			}
		});
		saveData.error(function() { console.log("error"); });
	}
	else
	{
		Notify("End Reading Must be Greater than Start Reading ", null, null, 'danger');
	}
}
  </script>

</body>
</html>
<?php } else { ?>
<?php require_once("no_session.php"); ?>
<?php } ?>