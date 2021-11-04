<?php
require_once('../inc/login.class.php');

$newsArticle = new loginArticles();

$userList = array();

// load the article if we have it
if (isset($_REQUEST['user_id']) && $_REQUEST['user_id'] > 0) 
{
    $newsArticle->getUsers($_REQUEST['user_id']);
    $userList = $newsArticle->articleData;
}

echo json_encode($userList);

?>