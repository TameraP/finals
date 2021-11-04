<?php
require_once('../inc/NewsArticles.class.php');

$newsArticle = new NewsArticles();

$articleList = $newsArticle->getList();

session_start();

//var_dump($_SESSION["user_level"]." session start");
$articleList = $newsArticle->getListFiltered(
    (isset($_GET['sortColumn']) ? $_GET['sortColumn'] : null),
    (isset($_GET['sortDirection']) ? $_GET['sortDirection'] : null),
    (isset($_GET['filterColumn']) ? $_GET['filterColumn'] : null),
    (isset($_GET['filterText']) ? $_GET['filterText'] : null)
);


?>
<html>
	<head>
		<title>week10</title>
		<style>
			.styleArticle {
			  width:40%;
			  text-align:center;
			}
			
			
			table, th, td {
			  border: 1px solid black;
			}
			
			table {
			  width: 100%;
			}
			
			.editColor {
				color:red;
			}
		</style>
	</head>
	</head>
    <body>
        <div>News Articles - <a href="../public/article-edit.php">Add New Article</a></div>        
        <div>
            <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="GET">
                Search: 
                <select name="filterColumn">
                    <option value="articleTitle">Article Title</option>
                    <option value="articleAuthor">Article Author</option>
                    <option value="articleDate">Article Date</option>
                    <option value="articleContent">Article Content</option>                    
                </select>
                &nbsp;<input type="text" name="filterText"/>
                &nbsp;<input type="submit" name="filter" value="Search"/>
            </form>
        </div>
		<div>
            <table border="1">
                <tr>
                    <th class="styleArticle">Article Title&nbsp;-&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=articleTitle&sortDirection=ASC">A</a>&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=articleTitle&sortDirection=DESC">D</a></th>
                    <th class="styleArticle">Article Author&nbsp;-&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=articleAuthor&sortDirection=ASC">A</a>&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=articleAuthor&sortDirection=DESC">D</a></th>
                    <th class="styleArticle">Article Date&nbsp;-&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=articleDate&sortDirection=ASC">A</a>&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=articleAuthor&sortDirection=DESC">D</a></th> 
                    <th class="styleArticle">&nbsp;</th>
                    <th class="styleArticle">&nbsp;</th>
                </tr>
                <?php foreach ($articleList as $articleData) 
                { ?>
                    <tr>
                        <td class="styleArticle"><?php echo $articleData['articleTitle']; ?></td>                
                        <td class="styleArticle"><?php echo $articleData['articleAuthor']; ?></td>                
                        <td class="styleArticle"><?php echo $articleData['articleDate']; ?></td>
                        <?php 
                        if($_SESSION["user_level"] > 2)
                        {
                        	echo ("<td><a href='../public/article-edit.php?articleID='".$articleData['articleID']."'>Edit</a></td>");
                        }
                        
                        else
                         {
                         	
                         	echo ("<td class='editColor'>Edit</td>");
                         }
			?>
                        <td><a href="../public/article-view.php?articleID=<?php echo $articleData['articleID']; ?>">View</a></td>
                            
                    </tr>
                <?php } ?>                
            </table>
        </div>
        <a href="../public/userProfile-view.php">Back to Profile</a><br>
    </body>
</html>