<?php
/*
require_once('../inc/login.class.php');
*/	
	$newLoginArticle = new loginArticles();
	$newUserDataArray= array();
	$newDataErrors = array();
	$loginSuccess = "";
	/*$newUserName = "";
	$newUserPassword="";
	$newUserLevel="";*/



	
	/*save*/
	
	
	if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] > 0) {
		$newLoginArticle->load($_REQUEST['user_id']);
		$newUserDataArray = $newLoginArticle->loginData;
		
	}
	
	if (isset($_POST['submit2'])) {
		$newUserDataArray = $newLoginArticle->sanitize($_POST);

		$newLoginArticle->set($newUserDataArray);

		/*$newUserName = $_POST['username'];
		$newUserPassword = $_POST['password'];
		$newUserLevel = $_POST['user_level'];
		
		var_dump($newUserName, $newUserPassword, $newUserLevel);*/
		
		if($newLoginArticle->save()) {
			header("location: ../public/newUserSuccess.php");
		}
		
		else {
			var_dump($newLoginArticle, "nope");
		}
	}
/*
require_once('../tpl/save.tpl.php');
*/
?>