<?php
require_once('../inc/login.class.php');
    session_start();
$newsArticle = new loginArticles();

$userList = array();

$v = array(); 
$userList = $newsArticle->getUsers(
    (isset($_GET['user_id']) ? $_GET['user_id'] : null)
);

$v = json_encode($userList);

//$arr = json_decode($v, true);
$arr = json_decode($v);

for ($x=0;$x < count($arr); $x++) {
	if($arr[$x]->username == $_SESSION["userName"]){
		echo "User ID: ".$arr[$x]->user_id."<br>Username: ".$arr[$x]->username."<br>Password: ".$arr[$x]->password."<br>User Level: ".$arr[$x]->user_level;
	}
}

?>