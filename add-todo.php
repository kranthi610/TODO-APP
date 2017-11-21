<?php
session_start();
if(!isset($_SESSION['user'])){
header("Location:index.php");
}
require_once 'core/init.php';
DB::getInstance();

if(isset($_POST['remove'])){
  Todo::Deleteitem($_POST['id']);
} 

if(isset($_POST['add'])){
  $item = escape($_POST['item']);
	$id = $_SESSION['user'];
  Todo::Additem($item,$id);
}
 

$items = Todo::displayItem($_SESSION['user']);
if($items[0]>0){
  echo "<br><h2 style='color:Cornsilk ;'  class='text-center'>TODO List</h2><br>";
  echo '<table class="table">
       <thead>
       <tr>
       <th>TODO Item</th> 
       </tr>
       </thead>
       <tbody>';
  foreach($items[1] as $item){
    $id = $item["id"];
	  $item = $item['item'];
    echo "<tr>
          <td style='color:green;'>$item</td>
          <td><button id=$id class='btn btn-primary btn-success' type='submit' onclick='remove_todo(this.id)'>Delete</button></td>
          </tr>"; 
  } 
  echo "</tbody>
       </table>";
}
