<?php
require_once('../inc/login.class.php');

$newsArticle = new loginArticles();

$userList = array();

$v = array(); 
$userList = $newsArticle->getUsers(
    (isset($_GET['user_id']) ? $_GET['user_id'] : null)
);

//var_dump($articleList);
echo json_encode($userList);

?>