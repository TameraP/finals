<html>
    <body>
        
        <div class="newUser">Add User
	        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>" method="post" enctype="multipart/form-data">
	            <?php if (isset($newDataErrors['username'])) { ?>
	                <div><?php echo $newDataErrors['username']; ?></div>
	            <?php } ?>
			<input type="text" id="username" name="username" placeholder="username" value="<?php echo (isset($newUserDataArray['username']) ? $newUserDataArray['username'] : ''); ?>"/>
			<input type="text" id="password" name="password" placeholder="userPassword" value="<?php echo (isset($newUserDataArray['password']) ? $newUserDataArray['password'] : ''); ?>"/>
			<input type="text" id="user_level" name="user_level" placeholder="userLevel" value="<?php echo (isset($newUserDataArray['user_level']) ? $newUserDataArray['user_level'] : ''); ?>"/><br/>
			Userimage: <input type="file" name="upload_image"/><br>
			<input type="hidden" name="user_id" value="<?php echo (isset($newUserDataArray['user_id']) ? $newUserDataArray['user_id'] : ''); ?>"/>
			<input type="submit" id="submit2" name="submit2" value="add"/>
		       	<input type="reset" id="reset" name="reset" value="reset"/>	    		   
	        </form>  
        </div>
    </body>
</html>