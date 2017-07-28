<?php
session_start();
if(isset($_SESSION['email'])){
	header('Location: add-entry.php');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Project | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
<body class="hold-transition login-page">
<div id="notifications"></div>
<div class="login-box">
  <div class="login-logo">
    <a href="assets/index2.html"><b>Pro</b>ject</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    
      <div class="form-group">
        <input type="email" id="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group">
        <input type="password" id="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">        
        <!-- /.col -->
        <div class="col-xs-5">
          <button type="submit" id="login_btn" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait" name="submit" class="btn btn-primary btn-block" onclick="validate()">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 3.1.1 -->
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/Notify.js"></script>
<script>
function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function validate()
{
	var email=$("#email").val();
	var button_loggin=$("#login_btn");
	email =email.trim();
	var password=$("#password").val();
	password=password.trim();
	if(email.length==0)
		Notify("Email Required", null, null, 'danger');
	else
		if (!validateEmail(email)) {
			Notify("Please Enter Valid Email", null, null, 'danger');
		}
	if(password.length==0)
		Notify("Password Required",null, null, 'danger');
	
	if(email.length>0 && password.length>0 && validateEmail(email)){
		var myKeyVals="to_do=login&email="+email+"&password="+password+"&submit=Log In";
		var saveData = $.ajax({
			type: 'POST',
			url: "login.php",
			data: myKeyVals,
			dataType: "json",
			success: function(resultData) { 
			response = jQuery.parseJSON(JSON.stringify(resultData));
			if(response.error===false){
				Notify("Please wait we are redirecting, you have logged in successfully as "+response.email, null, null, 'success');
				button_loggin.button('loading');
				setTimeout(function(){ window.location.replace("add-entry.php"); button_loggin.button('reset'); }, 2000);
			}
			else
			{
				Notify("Wrong Credentials", null, null, 'danger');
			}
			}
		});
		saveData.error(function() { Notify("Something Went Wrong", null, null, 'danger'); });
	}
}

$("#email").keypress(function(event) {
    if (event.which == 13) {
        validate();
     }
});
$("#password").keypress(function(event) {
    if (event.which == 13) {
		validate();
    }
});
</script>
</body>
</html>
