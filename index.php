<?php
  include 'connection.php';

    if(isset($_POST['submit'])){
    $name = $_POST['name'];
		$category = $_POST['category'];
		$priority = $_POST ['priority'];
		$duedate = $_POST ['duedate'];


  $result=mysqli_query($conn,"INSERT INTO todos (name, category, priority, duedate) VALUES ('".$name . "','".$category . "','".$priority."','".$duedate. "');");

}
		echo $_REQUEST['name'];
		echo $_REQUEST['category'];
		echo $_REQUEST['priority'];

		echo $_REQUEST['duedate'];


	else if(isset($_POST['delete'])){
        $id = $_POST['id'];
    $result=mysqli_query($conn,"DELETE FROM todos(id) VALUES  ('".$id."');");
      }
?>


<!DOCTYPE HTML>
<html lang="ja">
<head>
    <title>To Do List for CSI 3450</title>

    <link rel="stylesheet" href="googleapifont.css">
    <link rel="stylesheet" href="milligram.css">


    <link rel= "stylesheet" href ="formatting.css">



 </head>

<body class="container">




	<br>
	<br>
    <h1 align ="center">To Do List</h1>

		<label for  ="viewname">Select a View</label>
		<select style= "border:1px solid #000" id="currentview" name="view">
		<option value = "view1">Due Today</option>
		<option value = "view2">Due Tomorrow</option>
		<option value = "view3">Due Within 1 Week</option>
		<option value = "view4">Highest Priority</option>
		<option value = "view5">Most Recent Due Date</option>
		<option value = "view6">Category</option>
		</select>






    <form method="post" action="">
		<label for ="taskname">Enter a Task</label>
        <input type="text" style= "border:1px solid #000" name="name" value="">
		<label for ="duedate">Due Date:</label>
		<input style= "border:1px solid #000" type ="date" name="duedate" value="">


  <label for="categories">Choose the Category</label>
  <select style= "border:1px solid #000" id="categories" name="category">
    <option value="category1">Work</option>
    <option value="category2">School</option>
    <option value="category3">Social</option>
  </select>

  <label for="Priorities">Choose a Priority</label>
  <select style= "border:1px solid #000" id="priorities" name="priority">
    <option value="Priority1">1</option>
    <option value="Priority2">2</option>
    <option value="Priority3">3</option>
	<option value ="Priority4">4</option>
  </select>
 <input type="submit" name="submit" value="Add Task">
</form>


    <h2 align = "center">Current Tasks</h2>
    <table class="table table-striped">
        <therad><th>Task</th><th></th></therad>
        <therad><th>Category</th><th></th></therad>
        <therad><th>Priority</th><th></th></therad>
		<therad><th>Due Date:</th><th></th></therad>

        <tbody>
<?php
include 'connection.php';
global $conn;

//$result=mysqli_query($conn,"DELETE FROM todos(id) WHERE id = '".$id."');");
$result=mysqli_query($conn,"SELECT * FROM todos");


    foreach($result as $row) {
?>
        <tr>
        <td><?php= htmlspecialchars($row['name']) ?></td>
				<td><?php= htmlspecialchars($row['category']) ?></td>
				<td><?php= htmlspecialchars($row['priority']) ?></td>
				<td><?php= htmlspecialchars($row['duedate'])?></td>
				<td><?php= htmlspecialchars($row['view'])?></td>

                <td>
                    <form method="POST">
                        <button type="submit" name="delete">Remove Task</button>
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="delete" value="true">
                    </form>
                </td>
            </tr>
<?php

?>
        </tbody>
    </table>
</body>
</html>
