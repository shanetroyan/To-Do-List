<?php
    $pdo = new PDO("mysql:host=localhost;dbname=mydb;charset=utf8","root","");

    if(isset($_POST['submit'])&& isset($_POST ['name']) && isset($_POST['category']) && isset ($_POST ['priority']) ){
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






    <h1>To Do List</h1>
    <form method="post" action="">
		<label for ="taskname">Enter a Task</label>
        <input type="text" name="name" value="">
		<label for ="categoryname">Enter a Category</label>
        <input type ="text" name ="category" value="">
		<label for ="priorityname">Enter a Priority</label>
		<input type ="text" name="priority" value="">
		<br>
		<label for ="duedate">Due Date:</label>
		<input type ="date" name="date" value="">
		<input type="submit" name="submit" value="Add Task">
   
   
   

   </form>
    <form method="post" action="">
  <label for="categories">Choose the category</label>
  <select id="categories" name="Categories">
    <option value="category1">Work</option>
    <option value="category2">School</option>
    <option value="category3">Social</option>
  </select>
  <input type="submit">
</form>
    <form method="post" action="">
  <label for="Priorities">Choose a Priority</label>
  <select id="priorities" name="Priorities">
    <option value="Priority1">High</option>
    <option value="Priority2">Medium</option>
    <option value="Priority3">Low</option>
  </select>
  <input type="submit">
</form>
    
    
    <h2>Current Tasks</h2>
    <table class="table table-striped">
        <therad><th>Task</th><th></th></therad>
        <therad><th>Priority</th><th></th></therad>
        <therad><th>Category</th><th></th></therad>
		<therad><th>Due Date</th><th></th></therad>
		<therad><th>
        <tbody>
<?php
    $sth = $pdo->prepare("SELECT * FROM todos ORDER BY id DESC");
    $sth->execute();
    
    foreach($sth as $row) {
?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
				<td><?= htmlspecialchars($row['priority']) ?></td>
				<td><?= htmlspecialchars($row['category']) ?></td>
		
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
