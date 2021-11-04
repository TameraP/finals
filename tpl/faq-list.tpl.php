<html>
    <body>
        <div>Facts - <a href="faq-edit.php">Add New FAQ</a></div>        
        <div>
            <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="GET">
                Search: 
                <select name="filterColumn">
                    <option value="title">Title</option>
                    <option value="keywords">Keywords</option>
                    <option value="content">Article Content</option>                    
                </select>
                &nbsp;<input type="text" name="filterText"/>
                &nbsp;<input type="submit" name="filter" value="Search"/>
            </form>
        </div>
		<div>
            <table border="1">
                <tr>
                    <th>Title&nbsp;-&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=title&sortDirection=ASC">A</a>&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=title&sortDirection=DESC">D</a></th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($faqList as $faqData) 
                { ?>
                    <tr>
                        <td><?php echo $faqData['faqQuestion']; ?></td>                
                        <td><a href="faq-edit.php?faqID=<?php echo $faqData['faqID']; ?>">Edit</a></td>
                        <td><a href="faq-view.php?faqID=<?php echo $faqData['faqID']; ?>">View</a></td>  
                    </tr>
                <?php } ?>                
            </table>
        </div>
		<?php echo $newsWidgetHTML; ?>
    </body>
</html>