<html>
<head>
	<style>
		body {
			text-align: center;
		}
	</style>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	    <script>
	    
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		  if (this.readyState == 4 && this.status == 200) {
		    var result = JSON.parse(this.responseText);
		    var yesNo = result.ConditionMatched;
		    
		    if(yesNo == "No") {
	              	document.getElementById("outMatch").innerHTML="is not";
	            }
	                
	            else if(yesNo == "Yes") {
	              	document.getElementById("outMatch").innerHTML= "is";
	            }
	            
	            else {
	              	document.getElementById("outMatch").innerHTML= "not working";	            
	            }
		  }
		};
		xmlhttp.open("GET", "../public/curl-test.php", true);
		xmlhttp.send();
	
	    </script>
</head>
    <body>

		<h1><?php echo $_SESSION["userName"]." Profile";?></h1><br/>
		 <?php if (is_file(dirname(__FILE__) . "/../public/userImages/" . $_SESSION['user_id']. "_article.jpg")) { ?>
	        	<img src="userImages/<?php echo $_SESSION['user_id']. "_article.jpg"; ?>" width="200px" height="200px";/><br/><br/>
	        <?php } ?>
	        
	         <div>it <span id="outMatch"></span> going to rain in Des Moines, Iowa tomorrow</div><br>
	         
		<a href="../public/article-edit.php">Add New Article</a><br>
		<a href="../public/article-sort.php">View Article List</a><br>
		
		<p>CMS</p>
		
		<a href="../public/cms-edit.php">CMS: Add New Article</a><br>
		<a href="../public/cms-list.php">CMS: View Article List</a><br>
		
		<br>
		

		<?php
			if($_SESSION["user_level"] == 3) {
				echo "<a href='../public/article-report.php'>Download Article Report </a><br>";
				echo "<a href='../public/user-report.php'>Download User Report </a><br>";
				echo "<a href='../public/user-rest-list.php'>View JSON user list </a><br>";
				echo "<a href='../public/user-rest-specific.php'>View Specific JSON user </a><br><br>";
				
				echo "<p>FAQ Final: <br><a href='../public/faq-list.php'>FAQ List</a>
				<br><a href='../public/faq-rest-list.php'>FAQ JSON FAQ List</a></p>";
			}
		?>
	</body>     
</html>