<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once('logoff.php');
if(isset($_SESSION['email'])){

require_once('controllers/user_login.controller.php');
$LoginController = new LoginController();

$result2=$LoginController->getEmpName2();
$result=$LoginController->getLoom();
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
  
    
  td.details-control {
    background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
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
       View Reports 
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Entry</a></li>
        <li class="active">View Reports</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Get Reports</h3>
            </div>
            <!-- /.box-header -->
            <div class="row">
              <div class="col-md-12">
                <div class="box-body">
				  	<div class="col-xs-2 ">
                    <label>Quick Report</label>
                    <select class="form-control" id="quick_tab">
                      <option value="">TODAY/YESTERDAY/LAST MONTH</option>
                      <option value="TODAY">TODAY</option>
                      <option value="YESTERDAY">YESTERDAY</option>
                      <option value="LAST MONTH">LAST MONTH</option>
                    </select>
                  </div>
                  <div class="col-xs-2">
                  <label>FROM DATE</label>
                  <input class="form-control" placeholder="FROM DATE" id="from_date" type="text">
                  </div>
				  <div class="col-xs-2">
                  <label>TO DATE</label>
                  <input class="form-control" placeholder="TO DATE" id="to_date" type="text">
                  </div>
                  <div class="col-xs-2">
                    <label>SHIFT</label>
                    <select class="form-control" id="shift">
                      <option value="">ALL/DAY/NIGHT</option>
                      <option value="ALL">ALL</option>
                      <option value="DAY">DAY</option>
                      <option value="NIGHT">NIGHT</option>
                    </select>
                  </div>
                  <div class="col-xs-2">
                  <label>LOOM NO</label>
                  <select class="form-control" id="loom_no">
                      <option value="">ALL/LOOM NO</option>
                      <option value="ALL">ALL</option>
                      <?php while($row=mysqli_fetch_array($result)):?>
					  <option value="<?php echo $row['loom_no'];?>"><?php echo $row['loom_no'];?></option>
					  <?php endwhile; ?> 
                    </select>
                  </div>
                 <div class="col-xs-2">
                  <label>EMPLOYEE CODE</label>
                  <select class="form-control" id="emp_code">
                      <option value="">ALL/EMPLOYEE CODE</option>
                      <option value="ALL">ALL</option>
					  <?php while($row=mysqli_fetch_array($result2)):?>
					  <option value="<?php echo $row['emp_code'];?>"><?php echo $row['emp_code']."-".$row['emp_name'];?></option>
					  <?php endwhile; ?> 
                      
                      
                    </select>
                  </div>
                </div> 
              </div>
			  <div class="col-md-12">
                <div class="box-body">                  
				  <div class="col-xs-1 col-xs-offset-10">
                  <label>Button</label>
                 <button type="button" id="apply_button" onclick="get_report()" class="btn btn-block btn-primary btn-flat">APPLY</button>
                  </div>
				  <div class="col-xs-1">
                  <label>Clear</label>
                 <button type="button" id="clear_button" onclick="clear_sam()" class="btn btn-block btn-primary btn-flat">CLEAR</button>
                  </div>
                </div> 
              </div>
            </div>
			<div class="row">
              <div class="col-md-12">
                <div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="font-size:12px;"> 				
                  <th>DATE</th>                                  
                  <th>EMPLOYEE CODE</th>
                  <th>EMPLOYEE NAME</th>
				  <th>MESS</th>
                  <th>LOOM NO. COUNT</th>
                  <th>PRODUCTION</th>                  
                  <th>INCENTIVE</th>				  			
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
    $('#from_date').datepicker({
        format: 'yyyy-mm-dd'
      });
    $('#to_date').datepicker({
        format: 'yyyy-mm-dd'
      });
  
 
  function get_report()
	  {
		  var from_date=$("#from_date").val();
		  var to_date=$("#to_date").val();
		  var shift=$("#shift").val();
		  var quick_tab=$("#quick_tab").val();
		  var loom_no=$("#loom_no").val();
		  var emp_code=$("#emp_code").val();
		  var table = $('#example1').DataTable();
		  var myKeyVals="to_do=get_report_3&emp_code="+emp_code+"&submit=Get Report&from_date="+from_date+"&to_date="+to_date+"&shift="+shift+"&loom_no="+loom_no+"&quick_tab="+quick_tab;		  
		  var saveData = $.ajax({
			type: 'POST',
			url: "login.php",
			data: myKeyVals,
			dataType: "json",
			success: function(resultData) { 
			response = JSON.stringify(resultData);
			console.log(resultData);
			table.clear().draw();
			$('#example1').DataTable( {
		"destroy": true,      
		"data":resultData.data,
		"columns": [            
            { "data": "entry_date" },
            { "data": "emp_code" },
            { "data": "emp_name" },
            { "data": "mess" },
            { "data": "l_n_count" },
            { "data": "production" },
            { "data": "ince" },
        ],
        "order": [[0, 'asc']],		
		dom: 'Bfrtip',
        buttons: [
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-files-o"></i> Copy',
                titleAttr: 'Copy'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-excel-o"></i> Excel',
                titleAttr: 'Excel',
                filename: 'TVM Tracker Report'
            }
        ]
    } );
     
    // Add event listener for opening and closing details
    $('#example1 tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );		
			}
		});
		saveData.error(function() { console.log("error"); });
	  }
  
$(document).ready(function() {
var table = $('#example1').DataTable( {
		"destroy": true,
        "ajax": 'login.php?to_do=get_report_3',
		"columns": [
            
            { "data": "entry_date" },
            { "data": "emp_code" },
            { "data": "emp_name" },
            { "data": "mess" },
            { "data": "l_n_count" },
            { "data": "production" },
            { "data": "ince" },
        ],
        "order": [[0, 'asc']],		
		dom: 'Bfrtip',
        buttons: [
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-files-o"></i> Copy',
                titleAttr: 'Copy'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-excel-o"></i> Excel',
                titleAttr: 'Excel',
                filename: 'TVM Tracker Report'
            }
        ]
    } );
} );

function clear_sam(){
	$('.box').find('input:text').val('');
	$('.box').find('select').prop('selectedIndex',0);
	 var table = $('#example1').DataTable();
	table.clear().draw();
	$('#example1').DataTable( {
		"destroy": true,
        "ajax": 'login.php?to_do=get_report_3',
		"columns": [
            
            { "data": "entry_date" },
            { "data": "emp_code" },
            { "data": "emp_name" },
            { "data": "mess" },
            { "data": "l_n_count" },
            { "data": "production" },
            { "data": "ince" },
        ],
        "order": [[0, 'asc']],		
		dom: 'Bfrtip',
        buttons: [
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-files-o"></i> Copy',
                titleAttr: 'Copy'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-excel-o"></i> Excel',
                titleAttr: 'Excel',
                filename: 'TVM Tracker Report'
            }
        ]
    } );
}
  

  </script>

</body>
</html>
<?php } else { ?>
<?php require_once("no_session.php"); ?>
<?php } ?>