<?php
 require "login.php";

    session_start();
?>
<html>
    <body>
    	<?php 	var_dump($_SESSION["userName"]);?>
		<h1>>User Profile</h1>>
		<a href="../public/article-edit.php">Add New Article</a>
		<a href="../public/article-sort.php">View Article List</a>
		<div>Click <a href="#">here</a> to change your user profile</div>
	</body>    
</html>