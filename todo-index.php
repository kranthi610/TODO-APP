
<form action="logout.php" method="post">
	<input type="submit" style="text-align:center" name="logout" class="btn" value="Logout">
</form>

<h3 style="color:violet;" class="text-center">Add TODO Items</h3>

<div class="form-group">
 	<label for="title">TODO Item</label>
	<input type="text" id="todo-item" class="form-control" name="title">
</div>

<button type="submit"  class="btn btn-primary btn-success" id="todo-add">Add Item</button>

<div id="display-todo"></div>
