<form action="" method="post" id="todoregister" name="todoregister">

	<div class="form-group">
		<label for="name">Name</label>
 		<input type="text" class="form-control required lettersonly" name="name" value="<?php echo $name; ?>">

 	</div>

 	<div class="form-group">
 		<label for="email">Email</label>
		<input type="email" class="form-control required email" name="email" value="<?php echo $email; ?>">
	</div>

	<div class="form-group">
 		<label for="phonenumber">Phone Number</label>
		<input type="telephone" name="phonenumber" class="form-control required digits " id="telephone" value="<?php echo $phonenumber; ?>">
	</div>

	<div class="form-group">
 		<label for="password">Password</label>
		<input type="password" class="form-control required" name="password" value="<?php echo $password_plain; ?>">
	</div>

	<div class="form-group">
		<input type="submit" name="register" value="Signup" class="btn btn-primary btn-success">
	</div>

</form>

Already a Member? <a href="index.php">Login</a>