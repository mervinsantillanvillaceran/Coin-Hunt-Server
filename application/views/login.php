<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>

    <link href="<?php echo base_url(); ?>asset/bootstrap/css/bootswatch.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/app.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/images/hwi_favicon_logo.png" rel="shortcut icon" type="image/x-icon">
    <link href="<?php echo base_url(); ?>asset/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <link rel="icon" href="<?=base_url()?>asset/images/logo.png">
</head>
<body class="login-body">
	<div style="margin-top:5%;"></div>
	<div>
		<div class="col-md-12" style="text-align: center;">
			<img src="<?php echo base_url(); ?>asset/images/logo.png" width="10%"><br><br>
			<font class="project-title">C O I N &nbsp;&nbsp; H U N T</font>
		</div>
		<div class="col-md-12">
			<br>
			<form action="<?php echo base_url(); ?>index.php/user/login_user" method="POST">
				<div class="col-md-2 col-md-offset-5 container-fluid login-form">
					<h4 class="header" style="text-align: center;">Login</h4>
					<div class="col-md-12">
						<br>
						<label>Username</label>
						<input type="text" name="username" placeholder="Username" class="form-control" required="">
					</div>
					<div class="col-md-12">
						<br>
						<label>Password</label>
						<input type="password" name="password" placeholder="Password" class="form-control" required="">
					</div>
					<div class="col-md-12">
						<br>
						<input type="submit" value="Login" class="btn btn-danger" style="width:100%;" >
					</div>
				</div>
			</form>
		</div>
	</div>
    <script src="<?php echo base_url(); ?>asset/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>