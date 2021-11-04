<?php
require_once('../inc/login.class.php');	
	$loginArticle = new loginArticles();
	$userDataArray= array();
	$userDataErrors= array();
	$loginSuccess = "";
	$userName = "";
	$userPassword="";
	
	$userID = "";

/*save*/
	$newLoginArticle = new loginArticles();	
	$newUserDataArray= array();
	$newDataErrors = array();
	$loginSuccess = "";
	
	$find = new loginArticles();	
	
	/*login*/
	if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] > 0) {
		$loginArticle->load($_REQUEST['user_id']);
		$userDataArray = $loginArticle->loginData;
	}
	
	if (isset($_POST['submit1'])) {
		$userDataArray = $loginArticle->sanitize($_POST);

		$loginArticle->set($userDataArray);
		
		$userName = $_POST['userName'];
		$userPassword = $_POST['userPassword'];
		
		//$userID = $loginArticle->loadID($_REQUEST['user_id']);
		//$userID = $userDataArray['user_id'];
		//$userID = "16";
		
		//if ($loginArticle->validate()) {
		
			$userID = null;
			$userLevel = null;
			
			//$userLevel = $find->findLevel($userLevel);
			
			$loginSuccess = $loginArticle->getUserData($userName, $userPassword, $userID, $userLevel);
			
			//var_dump($loginSuccess);
			if($loginSuccess == "true") {
				session_start();
				$_SESSION["user_id"] = $userID;
				$_SESSION["userName"] = $userName;
				$_SESSION["user_level"] = $userLevel;				
				header("location:http://tamerapeake.us.tempcloudsite.com/AdvPHP/final/public/userProfile-view.php");
				//echo $loginSuccess;
				exit;
				
			}
			else {
				echo "didn't login";
			}
		//}
		/*else {
       			 $userDataErrors = $loginArticle->errors;
        		 $userDataArray = $loginArticle->userData;
        		// var_dump($userDataErrors, $userName, $userPassword);
        		var_dump($loginArticle);
        		 echo "nope";
    		}*/
	}

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
			$newLoginArticle->saveImage($_FILES['upload_image']);
			header("location: ../public/newUserSuccess.php");
		}
		
		else {
			var_dump($newLoginArticle, "nope");
		}
	}
/*
require_once('../tpl/save.tpl.php');

*/

	
require_once('../tpl/login.tpl.php');
?>