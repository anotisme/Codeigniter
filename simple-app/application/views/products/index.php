<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Product</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<div id="container">
	<h2 class="text-center">Add product</h2>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<form method="post" action="<?php echo base_url() ?>product/form_validation">
			<?php 
				if($this->uri->segment(2) == "added") {
					echo '<p class="text-success">Product added!</p>';
				} else if($this->uri->segment(2) == "deleted") {
					echo '<p class="text-success">Product deleted!</p>';
				} else if($this->uri->segment(2) == "updated") {
					echo '<p class="text-success">Product updated!</p>';
				}
			?>
			<?php
				if(isset($product_data)) {
					foreach($product_data->result() as $product) {
				?>
				<div class="form-group">
					<label for="">Product name</label>
					<input type="text" id="name" name="name" class="form-control" value="<?php echo $product->name; ?>">
					<span class="text-danger"><?php echo form_error('name'); ?></span>
				</div>
				<div class="form-group">
					<label for="">Product category</label>
					<input type="text" id="category" name="category" class="form-control" value="<?php echo $product->category; ?>">
					<span class="text-danger"><?php echo form_error('category'); ?></span>
				</div>
				<div class="form-group">
					<label for="">Product price</label>
					<input type="number" id="price" name="price" class="form-control" value="<?php echo $product->price; ?>">
					<span class="text-danger"><?php echo form_error('price'); ?></span>
				</div>
				<div class="form-group">
					<input type="hidden" name="hidden_id" class="form-control btn btn-success" value="<?php echo $product->id; ?>">
					<input type="submit" name="update" class="form-control btn btn-success" value="Update">
				</div>
				<?php
					}
				} else {
			?>
			<div class="form-group">
				<label for="">Product name</label>
				<input type="text" id="name" name="name" class="form-control">
				<span class="text-danger"><?php echo form_error('name'); ?></span>
			</div>
			<div class="form-group">
				<label for="">Product category</label>
				<input type="text" id="category" name="category" class="form-control">
				<span class="text-danger"><?php echo form_error('category'); ?></span>
			</div>
			<div class="form-group">
				<label for="">Product price</label>
				<input type="number" id="price" name="price" class="form-control">
				<span class="text-danger"><?php echo form_error('price'); ?></span>
			</div>
			<div class="form-group">
				<input type="submit" name="add" class="form-control btn btn-success" value="Add">
			</div>
			<?php } ?>
			</form>
		</div>
		<div class="col-md-2"></div>
	</div>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
		<table class="table">
			<thead>
			<tr>
				<th>Product name</th>
				<th>Category</th>
				<th>Price</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
				<?php 
				if($fetch_product->num_rows() > 0) {
					foreach($fetch_product->result() as $product) {
				?> 
					<tr>
						<td><?php echo $product->name; ?></td>
						<td><?php echo $product->category; ?></td>
						<td><?php echo $product->price; ?></td>
						<td>
							<a href="#" class="delete_product" id="<?php echo $product->id; ?>">Delete</a>
							<a href="<?php echo base_url(); ?>product/update_product/<?php echo $product->id; ?>" class="update_product" id="">Edit</a>
						</td>
					</tr>
				<?php
					}
				} else {
				?> 
					<tr>
						<td colspan="4">No product found</td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
	$(document).ready(function() {
		$('.delete_product').click(function() {
			var id = $(this).attr('id');
			if(confirm('Are you sure to delete this?')) {
				window.location = "<?php echo base_url(); ?>product/delete_product/"+id;
			} else {
				return false;
			}
		});
	});
</script>
</body>
</html>
