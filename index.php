<?php
    $pdo = new PDO("mysql:host=localhost;dbname=mydb;charset=utf8","root","");

    if(isset($_POST['submit'])&& isset($_POST ['name']) && isset($_POST['category']) && isset ($_POST ['priority']) &&isset ($_POST ['duedate'])){
        $name = $_POST['name'];
        $sth = $pdo->prepare("INSERT INTO todos (name) VALUES (:name)");
        $sth->bindValue(':name', $name, PDO::PARAM_STR);
        $sth->execute();
		
		$category = $_POST['category'];
        $sth = $pdo->prepare("INSERT INTO todos (category) VALUES (:category)");
        $sth->bindValue(':category', $category, PDO::PARAM_STR);
        $sth->execute();
		
		$priority = $_POST['priority'];
        $sth = $pdo->prepare("INSERT INTO todos (priority) VALUES (:priority)");
        $sth->bindValue(':priority', $priority, PDO::PARAM_STR);
        $sth->execute();
		
		$priority = $_POST['duedate'];
        $sth = $pdo->prepare("INSERT INTO todos (duedate) VALUES (:duedate)");
        $sth->bindValue(':duedate', $duedate, PDO::PARAM_STR);
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
	
		<label for  ="viewname">Select a View</label>
		<select style= "border:1px solid #000" id="currentview" name="viewdropdown">
		<option value = "duetoday">Due Today</option>
		<option value = "duetomorrow">Due Tomorrow</option>
		<option value = "duewithinweek">Due Within 1 Week</option>
		<option value = "highestprioritylevel">Highest Priority</option>
		<option value = "mostrecentduedate">Most Recent Due Date</option>
		<option value = "currentcategory">Category</option>
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
		<therad><th>
        <tbody>
<?php
    $sth = $pdo->prepare("SELECT * FROM todos ORDER BY id DESC");
    $sth->execute();
    
    foreach($sth as $row) {
?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
				<td><?= htmlspecialchars($row['category']) ?></td>
				<td><?= htmlspecialchars($row['priority']) ?></td>
				<td><?= htmlspecialchars($row['duedate'])?></td>
		
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
