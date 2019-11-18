<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h1 class="text-center">Login</h1>

		<form action="<?php echo base_url(); ?>user/login_validation" method="post">
			<div class="form-group">
				<label for="">Enter username</label>
				<input type="text" id="username" name="username" class="form-control">
				<span class="text-danger"><?php echo form_error('username'); ?></span>
			</div>
			<div class="form-group">
				<label for="">Enter password</label>
				<input type="password" id="password" name="password" class="form-control">
				<span class="text-danger"><?php echo form_error('password'); ?></span>
			</div>
			<div class="form-group">
				<input type="submit" id="login" name="login" class="form-control btn btn-primary" value="Login">
				<?php echo '<label class="text-danger">'.$this->session->flashdata('error');'</label>' ?>
			</div>
		</form>
	</div>
</body>
</html>
