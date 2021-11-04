<html>
    <body>
        <div>CMS Pages - <a href="cms-edit.php">Add New Page</a></div>        
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
                <?php foreach ($cmsList as $cmsData) 
                { ?>
                    <tr>
                        <td><?php echo $cmsData['title']; ?></td>                
                        <td><a href="cms-edit.php?cms_id=<?php echo $cmsData['cms_id']; ?>">Edit</a></td>
                        <td><a href="cms-view.php?cms_id=<?php echo $cmsData['cms_id']; ?>">View</a></td>
                        <td><a href="view_page.php?page=<?php echo $cmsData['url_key']; ?>">Client Side</a></td>                   
                        <td><a href="view_page2.php?page=<?php echo $cmsData['url_key']; ?>">Client Side2</a></td>     
                    </tr>
                <?php } ?>                
            </table>
        </div>
		<?php echo $newsWidgetHTML; ?>
    </body>
</html>