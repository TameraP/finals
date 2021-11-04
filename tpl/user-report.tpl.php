<html>
    <body>     
      <div>
            <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="GET">
                User Report
                &nbsp;<input type="submit" name="btnViewReport" value="View Report"/>
            </form>
        </div>
		<?php if (count($articleList) > 0) { ?>
	<div>
		<a href="<?= $_SERVER['SCRIPT_NAME']; ?>?download=1&<?= $_SERVER["QUERY_STRING"]; ?>">Download Report</a><br><br>
            <table border="1">
            	<tr>
            		<th>User ID</th>
            		<th>User Name</th>
            		<th>User Password</th>
            		<th>User Level</th>
            	</tr>
                <?php foreach ($articleList as $articleData) { ?>
                    <tr>
                    	<td><?php echo $articleData['user_id']; ?></td>    
                        <td><?php echo $articleData['username']; ?></td>                
                        <td><?php echo $articleData['password']; ?></td> 
                        <td><?php echo $articleData['user_level']; ?></td>                                               
                    </tr>
                <?php } ?>                
            </table>
			<a href="<?= $_SERVER['SCRIPT_NAME']; ?>?<?= $nextPageLink; ?>">Next Page</a>
			<a href="../public/userProfile-view.php">Back to Profile</a><br>
        </div>
		<?php } ?>
    </body>
</html>