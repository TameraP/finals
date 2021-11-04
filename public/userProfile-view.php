<?php
 require "../inc/login.class.php";

    session_start();
    
    $loginArticle = new loginArticles();

    $userDataArray= array();
	if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] > 0) {
		$loginArticle->load($_REQUEST['user_id']);
		$userDataArray = $loginArticle->loginData;
	}

require_once('../tpl/userProfile-view.tpl.php');
?>