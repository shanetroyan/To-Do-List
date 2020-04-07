<?php
    $pdo = new PDO("mysql:host=localhost;dbname=mydb;charset=utf8","root","");

    if(isset($_POST['submit'])){
		
		
		
		
        $name = $_POST['name'];
		$category = $_POST['category'];
		$priority = $_POST['priority'];
		$duedate = $_POST['duedate'];
		$viewdropdown = $_POST['viewdropdown'];
        $sth = $pdo->prepare("INSERT INTO todos (name, category, priority, duedate, viewdropdown) VALUES ('".$name."', '".$category."', '".$priority."',".$duedate.", '".$viewdropdown."')");
         $sth->execute();
				
	
    }
	
	elseif(isset($_POST['delete'])){
        $id = $_POST['id'];
        $sth = $pdo->prepare("delete from todos where id = :id");
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
    }
?>


<!DOCTYPE HTML>
<html lang="ja">
<head>
    <title>To Do List for CSI 3450</title>
    
    <link rel="stylesheet" href="googleapifont.css">
    <link rel="stylesheet" href="milligram.css">
		
<style>
.button-black {
 background-color: black;
 border-color: black;
 </style>
	
	
	
	
	
    <link rel= "stylesheet" href ="formatting.css">

	
	
 </head>

<body class="container">




	<br>
	<br>
    <h1 align ="center">To Do List</h1>
	
		
	
	
	
	
	
	
    <form method="post" action="">
	
	
	
	<label for  ="viewname">Select a View</label>
		<select style= "border:1px solid #000" id="currentview" name="viewdropdown">
		<option value = "view1">Due Today</option>
		<option value = "view2">Due Tomorrow</option>
		<option value = "view3">Due Within 1 Week</option>
		<option value = "view4">Highest Priority</option>
		<option value = "view5">Most Recent Due Date</option>
		<option value = "view6">Category</option>
		</select>
	
	
	
	
	
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
    $sth = $pdo->prepare("SELECT * FROM todos");
    $sth->execute();
    
    foreach($sth as $row) {
?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
				<td><?= htmlspecialchars($row['category']) ?></td>
				<td><?= htmlspecialchars($row['priority']) ?></td>
				<td><?= htmlspecialchars($row['duedate'])?></td>
				<td><?= htmlspecialchars($row['viewdropdown'])?></td>
		
                <td>
                    <form method="POST">
                        <button type="submit" name="delete">Remove Task</button>
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="delete" value="true">
                    </form>
                </td>
            </tr>
<?php
    }
?>
        </tbody>
    </table>
</body>
</html>
