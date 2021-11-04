<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
	  $(".loginUser").hide();
	  $(".newUser").hide();
	  $("#login").click(function(){
	    $(".loginUser").toggle();
	  });
	  
	  $("#addNew").click(function(){
	    $(".newUser").toggle();
	  });
	});
	
	
	</script>
</head>
    <body>
    	<button type="button" id="login">Login</button>
	<div class="loginUser">
	        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	            <?php if (isset($userDataErrors['username'])) { ?>
	                <div><?php echo $userDataErrors['username']; ?></div>
	            <?php } ?>
			<input type="text" id="userName" name="userName" placeholder="userName" value="<?php echo (isset($userDataArray['username']) ? $userDataArray['username'] : ''); ?>"/>
			<input type="text" id="userPassword" name="userPassword" placeholder="userPassword" value="<?php echo (isset($userDataArray['password']) ? $userDataArray['password'] : ''); ?>"/>
			<input type="submit" id="submit1" name="submit1" value="login"/>
		       	<input type="reset" id="reset" name="reset" value="reset"/>	    		   
	        </form>
        </div>
    	<button type="button" id="addNew">New User</button><br/>
        <div class="newUser">
	        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>" method="post" enctype="multipart/form-data">
	            <?php if (isset($newDataErrors['username'])) { ?>
	                <div><?php echo $newDataErrors['username']; ?></div>
	            <?php } ?>
			<input type="text" id="username" name="username" placeholder="username" value="<?php echo (isset($newUserDataArray['username']) ? $newUserDataArray['username'] : ''); ?>"/>
			<input type="text" id="password" name="password" placeholder="userPassword" value="<?php echo (isset($newUserDataArray['password']) ? $newUserDataArray['password'] : ''); ?>"/>
			<input type="text" id="user_level" name="user_level" placeholder="userLevel" value="<?php echo (isset($newUserDataArray['user_level']) ? $newUserDataArray['user_level'] : ''); ?>"/><br/>
			Userimage: <input type="file" name="upload_image"/><br>
			<input type="submit" id="submit2" name="submit2" value="add"/>
		       	<input type="reset" id="reset" name="reset" value="reset"/>	    		   
	        </form>  
        </div>
    </body>
</html>