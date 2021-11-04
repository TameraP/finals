<?php
require_once('../inc/NewsArticles.class.php');

$newsArticle = new NewsArticles();

$articleList = $newsArticle->getList();
?>
<!doctype html>
<html>
	<head>
		<title>week6</title>
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
		</style>
	</head>
	<body>
	/*is there a way to hide the input boxes so that the page only lists the available articles*/
        	<div>News Articles - 
	            <a href="../public/article-edit.php">Add New Article</a>
	        </div>
	        <table>
	        	<tr>
		                <th class="styleArticle">Article Title</th>
		                <th class="styleArticle">Article Author</th>
		                <th class="styleArticle">Article Date</th>
		                <th class="styleArticle">&nbsp;</th>
		                <th class="styleArticle">&nbsp;</th>
	                <tr>
                    <?php foreach ($articleList as $articleData) { ?>
	                <tr class="styleClear">
	                    <td class="styleArticle"><?php echo $articleData['articleTitle']; ?></td>
	                    <td class="styleArticle"><?php echo $articleData['articleAuthor']; ?></td>
	                    <td class="styleArticle"><?php echo $articleData['articleDate']; ?></td>
	                    <td class="styleArticle"><a href="../public/article-edit.php?articleID=<?php echo $articleData['articleID']; ?>">Edit</a></td>
	                    <td class="styleArticle"><a href="../public/article-view.php?articleID=<?php echo $articleData['articleID']; ?>">View</a></td>
	        	</tr>
            	    <?php } ?> 
         	</div>
	</body>
</html>