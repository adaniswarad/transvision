<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="<?php echo get_template_directory(dirname(__FILE__), 'css/'); ?>bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo get_template_directory(dirname(__FILE__), 'css/'); ?>bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo get_template_directory(dirname(__FILE__), 'css/'); ?>font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="<?php echo get_template_directory(dirname(__FILE__), 'css/'); ?>style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo get_template_directory(dirname(__FILE__), 'css/'); ?>pages/signin.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.html">Transvision - Transport Management Service</a>
			</div><!-- /container -->
		</div> <!-- /navbar-inner -->
	</div> <!-- /navbar -->
	<div class="account-container">
		<div class="content clearfix">
			<form action="<?=set_url('login');?>" method="post">
				<h1>Admin Login</h1>
				<div class="login-fields">
					<p>Silahkan isi data anda</p>
					<div class="field">
						<label for="username">Username</label><?php echo form_error('username'); ?>
						<input type="text" id="username" name="username" value="" placeholder="Username" class="login username-field" />
					</div><!-- /field -->
					<div class="field">
						<label for="password">Password:</label><?php echo form_error('password'); ?>
						<input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field"/>
					</div><!-- /password -->
				</div><!-- /login-fields -->
				<div class="login-actions">
					<button class="button btn btn-info btn-large">Log In</button>
				</div><!-- .actions -->
			</form>
		</div><!-- /content -->
	</div> <!-- /account-container -->

	<script src="<?php echo get_template_directory(dirname(__FILE__), 'js/'); ?>jquery-1.7.2.min.js"></script>
	<script src="<?php echo get_template_directory(dirname(__FILE__), 'js/'); ?>bootstrap.js"></script>
	<script src="<?php echo get_template_directory(dirname(__FILE__), 'js/'); ?>signin.js"></script>
</body>
</html>
