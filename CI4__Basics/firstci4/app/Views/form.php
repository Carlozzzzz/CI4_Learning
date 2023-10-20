<?= $this->extend('layouts\main') ?>

<?= $this->section('content') ?>

<form method="POST"> 
	<h1>Form validation</h1>
	<?php if(isset($validation)) :?>
		<div class="text-danger">
			<?=$validation->listErrors() ?>
		</div>
	<?php endif;?>

	<div class="form-group mb-3">
		<label for="exampleInputEmail1" class="form-label">Email address</label>
		<input type="text" class="form-control" name="email" value="<?= set_value('email')?>">
	</div>

	<div class="form-group mb-3">
		<label for="exampleInputPassword1" class="form-label">Password</label>
		<input type="password" class="form-control" name="password" value="<?= set_value('password')?>">
	</div>

	<div class="form-group mb-3">
		<label for="">Category</label>
		<select name="category" id="" class="form-select" name="category">
			<option value="">--Select--</option>
			<?php foreach($categories as $category) :?>
				<option <?= set_select('category', $category, TRUE) ?>value="<?=$category?>"><?=$category?></option>
			<?php endforeach;?>
		</select>
	</div>

	<div class="form-group mb-3">
		<label for="exampleInputPassword1" class="form-label">Date</label>
		<input type="date" class="form-control" name="date" value="<?= set_value('date')?>">
	</div>

	<?php
		echo '<pre>';
			print_r($_POST);
		echo '</pre>';
	?>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>

<?= $this->endSection() ?>
