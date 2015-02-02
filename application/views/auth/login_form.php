<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'username',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'class'	=> 'checkbox',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin-bottom: 10px;',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?php echo $this->config->item('website_name','tank_auth');?></title>
		
		<!-- Bootstrap Core CSS -->
		<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">

		<!-- MetisMenu CSS -->
		<link href="<?php echo base_url();?>assets/css/metisMenu.min.css" rel="stylesheet">

		<!-- Custom CSS -->
		<link href="<?php echo base_url();?>assets/css/sb-admin-2.css" rel="stylesheet">
		<!-- Auth CSS -->
		<link href="<?php echo base_url();?>assets/css/auth.css" rel="stylesheet" media="screen">
		<!-- Custom Fonts -->
		<link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>

	<body>
		
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="span4 offset4"><div style="text-align:center;"><img src="<?php echo base_url();?>assets/images/logo.png" alt="Logo" title="Logo"></div></div>
					<div class="login-panel panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Please Sign In</h3>
						</div>
						<div class="panel-body">
                        <?php echo form_open($this->uri->uri_string(),'role="form"'); ?>
                            <fieldset>
                                <div class="form-group">
									<?php echo form_label($login_label, $login['id']); ?>
									<?php echo form_input($login,'','class="form-control" placeholder="Email address" autofocus'); ?>
									<div class="help-block with-errors">
										<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
									</div>
                                </div>
                                <div class="form-group">
									 <?php echo form_label('Password', $password['id']); ?>
									 <?php echo form_password($password,'','class="form-control" placeholder="Password"'); ?>
                                     <div class="help-block with-errors">
										<?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>
									 </div>
                                </div>
                                <div class="checkbox">									
                                    <label for="remember">
									<?php echo form_checkbox($remember); ?>	
									 Remember me 
									</label> 									
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
								<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
								                               
                            </fieldset>
                        <?php echo form_close(); ?>
                    </div>
					</div>
				</div>
			</div>
		</div>
		
    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url();?>assets/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/js/sb-admin-2.js"></script>
	
	<script src="<?php echo base_url();?>assets/js/jquery.js"></script> 
	<script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
	</body>
</html>