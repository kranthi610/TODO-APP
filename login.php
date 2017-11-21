<form id="todologin" action="" method="post">

	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control required email" name="email" value="<?php echo $email; ?>">
	</div>

	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control required"  name="password">
	</div>

	<input type="submit" name="login" value="Login" class="btn btn-primary btn-success">
</form>
Not a Member? <a href="register.php">Signup</a>