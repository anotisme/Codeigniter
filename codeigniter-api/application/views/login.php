<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
	integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
	integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
	integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<style>
		.btn {
			width: 10%;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h1 class="text-center">Login</h1></div>
			<div class="panel-body">
			<?php 
				// print_r($sess); die();
				echo '<div class="alert-succes">'.$this->session->flashdata('message').'</div>';
			?>
				<form action="<?php echo base_url(); ?>login/validation" method="post">
					<div class="form-group">
						<label for="">Enter email</label>
						<input type="text" id="user_email" name="user_email" class="form-control" value="<?php echo set_value('user_email'); ?>">
						<span class="text-danger"><?php echo form_error('user_email'); ?></span>
					</div>
					<div class="form-group">
						<label for="">Enter password</label>
						<input type="password" id="user_password" name="user_password" class="form-control" value="<?php echo set_value('user_password'); ?>">
						<span class="text-danger"><?php echo form_error('user_password'); ?></span>
					</div>
					<div class="form-group">
						<input type="submit" id="login" name="login" class="form-control btn btn-primary" value="Login">
						<?php echo '<label class="text-danger">'.$this->session->flashdata('error');'</label>' ?>
						<a href="<?php echo base_url(); ?>register">Register</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
