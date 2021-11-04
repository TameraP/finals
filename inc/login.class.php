<?php
//require_once('../public/login.php');
//require_once('../public/save.php');

class loginArticles {
	
	var $userData = array();
	var $errors = array();
	var $db = null;
	var $inName = "";
	var $inPassword = "";
	var $validUser = false;
	var $newName ="";
	var $newPassword="";
	var $newLevel="";

	var $userLevel="";
	var $level = "";
//	var $userDataID = array();

	var $users = array();
	
	function __construct() {
		$this->db = new PDO('mysql:host=localhost;dbname=tamerapeake_wdv;charset=utf8', 
	    'tamerapeake_wdv', '1Ladyluck!');           
	}
	
	function set($dataArray) {
		$this->userData = $dataArray;
		//var_dump($this->userData, "test");
		
	}
	
	function sanitize($dataArray) {

		return $dataArray;
	}

	function load($user_id) {
		
		
		$isLoaded = false;
		$stmt = $this->db->prepare("SELECT * FROM newsArticles_userLogin WHERE user_id = ?");
		
		$stmt->execute(array($user_id));
		 
		if($stmt->rowCount() == 1) {
			$dataArray = $stmt->fetch(PDO::FETCH_ASSOC);
			//var_dump($dataArray);
			$this->set($dataArray);
			$isLoaded = true;
		}
		
		
	   return $isLoaded;		
	}
		
	
	function save() {
		$isSaved=false;
		var_dump("1");
		
		if (empty($this->userData['user_id'])) {
				var_dump("2");
			$stmt = $this->db->prepare(
				"INSERT INTO newsArticles_userLogin
					(username, password, user_level)
					VALUES (?, ?, ?)");
			$isSaved = $stmt->execute(array(
				$this->userData['username'],
				$this->userData['password'],
				$this->userData['user_level']
				)
			);
			/*
			$isSaved = $stmt->execute(array(
				$this->inNewName,
				$this->inNewPassword,
				$this->inNewLevel
				)
			);*/
			var_dump("3");
			
			
			
			if ($isSaved) {
					var_dump("3");
				$this->userData['user_id'] = $this->db->lastInsertId();
			}	
		}
		

		
		else {
			var_dump("4");
			$stmt = $this->db->prepare(
				"UPDATE newsArticles_userLogin SET
					username = ?,
					password = ?,
					user_level = ?
				WHERE user_id = ?"
			);
			
			$isSaved = $stmt->execute(array(
				$this->userData['username'],
				$this->userData['password'],
				$this->userData['user_level']
				)
			);
		}
		
		return $isSaved;
	}
	
	
	
	function validate() {
		$isValid = true;
		
		if (empty($this->loginData['userName'])) {
			$this->errors['userName'] = "Please enter your username";
			$isValid = false;
		}
		
		if (empty($this->loginData['userPassword'])) {
			$this->errors['userPassword'] = "Please enter your user password";
			$isValid= false;
		}
	 return $isValid;
	}
	
	function getUsers() {
		$userList = array();
		
		$sql = "SELECT * FROM newsArticles_userLogin";
		$res = $this->db->prepare($sql);
		$res->execute();
		if($res->rowCount()>0){
		
			$userList = $res->fetchAll(PDO::FETCH_ASSOC);
		}
		
		else {
			$userList= "0 results";
		}
        	return $userList;
	}
		
		
		
							/* &$variableName (doesn't need to be the same name) change the value of the variable of the column program*/
	function getUserData($userName, $userPassword, &$userID, &$userLevel) {
		$inName = $userName;
		$inPassword = $userPassword;
		$userList = array();
		$sql = "SELECT * FROM newsArticles_userLogin";
		$res = $this->db->prepare($sql);
		$res->execute();
		if($res->rowCount()>0){
			$userList = $res->fetchAll(PDO::FETCH_ASSOC);
			foreach ($userList as $userResult) {
				if($userResult['username']==$inName) {
					//var_dump("1");
					if($userResult['password']!==$inPassword){
						$userlist ="wrong password";
						//var_dump("2", $userResult['password'], $inPassword);
					}
					else {
						$userID = $userResult['user_id'];
						$userLevel = $userResult['user_level'];
						$userList = "true";
						break;
						//var_dump("3");
					}
				}
				else {
					$userList = "no names";
					//var_dump("4");
				}
			}
		}
		
		else {
			$userList= "0 results";
		}
		return $userList;
	}
	
  function exportUserImages($filename) {
        $articleData = $this->getList();
		        
        $outputFileHandle = fopen(dirname(__FILE__) . "/../" . $filename, "x");

        if ($outputFileHandle) {
        
            if (is_array($articleData)) {
                foreach ($articleData as $rowData) {
                    fputcsv($outputFileHandle, $rowData);
                }
            }
            
            fclose($outputFileHandle);            
        }
    }
    
    function importNewsArticles($filename) {
        
        var_dump($filename);
        
        if (is_file($filename)) {
            
            $importFileHandle = fopen($filename, "r");

            if ($importFileHandle) {
                    
                while (feof($importFileHandle) === false) {
                    $rowData = fgetcsv($importFileHandle);

                    if (is_array($rowData)) {
                        $rowData = array_combine(
                            array("articleID", 'articleTitle', 'articleContent', 'articleAuthor', 'articleDate'),
                            $rowData
                        );

                        if (isset($rowData['articleID']) && $rowData['articleID'] > 0) {
                            $this->load($rowData['articleID']);
                        }

                        $this->set($rowData);

                        if ($this->validate()) {
                            $this->save();
                        }                    
                    }
                    
                    //var_dump($rowData);
                }
                
                fclose($importFileHandle);
            }            
        }
    }    
    
    function saveImage($fileArray) {
        move_uploaded_file($fileArray['tmp_name'], dirname(__FILE__) . 
                "/../public/userImages/" . $this->userData['user_id'] . "_article.jpg");
    }
    
}

?>