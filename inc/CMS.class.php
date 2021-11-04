<?php

// class to handle interaction with the cms table
class CMS  
{
    // property to hold our data from our article
    var $data = array();
    
    var $data1 = array();
    // property to hold errors
    var $errors = array();
    // property for holding a reference to a database connection so we can reuse it
    var $db = null;

    function __construct() 
    {
        // create a connection to our database
        $this->db = new PDO('mysql:host=localhost;dbname=tamerapeake_wdv;charset=utf8', 
            'tamerapeake_wdv', '1Ladyluck!');             
    }
    
    // takes a keyed array and sets our internal data representation to the array
    function set($dataArray)
    {
        $this->data = $dataArray;
        
        //var_dump($this->data, "test");
    }

    // santize the data in the passed array, return the array
    function sanitize($dataArray)
    {
        // sanitize data based on rules
	
	$dataArray['title'] = filter_var($dataArray['title'], FILTER_SANITIZE_STRING);
	$dataArray['h1'] = filter_var($dataArray['h1'], FILTER_SANITIZE_STRING);
	$dataArray['keywords'] = filter_var($dataArray['keywords'], FILTER_SANITIZE_STRING);
	$dataArray['url_key'] = filter_var($dataArray['url_key'], FILTER_SANITIZE_STRING);
	$dataArray['content']= filter_var($dataArray['content'], FILTER_SANITIZE_STRING);
	
        return $dataArray;
    }
    
    // load a news article based on an id
    function load($cmsID)
    {
        // flag to track if the article was loaded
        $isLoaded = false;

        // load from database
        // create a prepared statement (secure programming)
        $stmt = $this->db->prepare("SELECT * FROM cms WHERE cms_id = ?");
        
        // execute the prepared statement passing in the id of the article we 
        // want to load
        $stmt->execute(array($cmsID));

        // check to see if we loaded the article
        if ($stmt->rowCount() == 1) 
        {
            // if we did load the article, fetch the data as a keyed array
            $dataArray = $stmt->fetch(PDO::FETCH_ASSOC);
            //var_dump($dataArray);
            
            // set the data to our internal property            
            $this->set($dataArray);
                        
            // set the success flag to true
            $isLoaded = true;
        }
        
        //var_dump($stmt->rowCount());
        
        // return success or failure
        return $isLoaded;
    }
    
    // save a news article (inserts and updates)
    function save() 
    {
        // create a flag to track if the save was successful
        $isSaved = false;
        
        // determine if insert or update based on cmsID
        // save data from data property to database
        if (empty($this->data['cms_id']))
        {
            // create a prepared statement to insert data into the table
            $stmt = $this->db->prepare(
                "INSERT INTO cms 
                    (keywords, h1, content, title, url_key) 
                 VALUES (?, ?, ?, ?, ?)");

            // execute the insert statement, passing in the data to insert
            $isSaved = $stmt->execute(array(
                    $this->data['keywords'],
                    $this->data['h1'],
                    $this->data['content'],
                    $this->data['title'],
		    $this->data['url_key']
                )
            );
            
            // if the execute returned true, then store the new id back into our 
            // data property
            if ($isSaved) 
            {
                $this->data['cms_id'] = $this->db->lastInsertId();
            }
        } 
        else 
        { // if this is an update of an existing record, create a prepared update 
          //statement
            $stmt = $this->db->prepare(
                "UPDATE cms SET 
                    keywords = ?,
                    content = ?,
                    h1 = ?,
                    title = ?,
		    url_key = ?
                WHERE cms_id = ?"
            );
                    
            // execute the update statement, passing in the data to update
            $isSaved = $stmt->execute(array(
                    $this->data['keywords'],
                    $this->data['content'],
                    $this->data['h1'],
                    $this->data['title'],
		    $this->data['url_key'],
                    $this->data['cms_id']
                )
            );            
        }
                        
        // return the success flage
        return $isSaved;
    }
    
    // validate the data we have stored in the data property
    function validate()
    {
        // flag as true initially
        $isValid = true;
        
        // if an error, store to errors using column name as key
        
        // validate the data elements in data property
        if (empty($this->data['title']))
        {
            // if not valid, set an error and flag as not valid
            $this->errors['title'] = "Please enter a ";
            $isValid = false;
        }   
        
        if(empty($this->data['h1'])) {
       	    $this->errors['h1'] = "Please enter an ";
            $isValid = false;
        } 
        
        if(empty($this->data['keywords'])) {
       	    $this->errors['keywords'] = "Please enter some ";
            $isValid = false;
        }     

	if(empty($this->data['url_key'])) {
       	    $this->errors['url_key'] = "Please enter a ";
            $isValid = false;
        } 
        
        if(empty($this->data['keywords'])) {
       	    $this->errors['keywords'] = "Please enter some ";
            $isValid = false;
        }
        
        if(empty($this->data['content'])) {
       	    $this->errors['content'] = "Please enter some ";
            $isValid = false;
        }              
        // return valid t/f
        return $isValid;
    }
    
    // get a list of news articles as an array
    function getList(
		$sortColumn = null, 
		$sortDirection = null, 
		$filterColumn = null, 
		$filterText = null, 
		$page = null
	) {
			
        $articleList = array();
        
        $sql = "SELECT * FROM cms ";

        if (!is_null($filterColumn) && !is_null($filterText)) {
            $sql .= " WHERE " . $filterColumn . " LIKE ?";
        }
        
        if (!is_null($sortColumn)) {
            $sql .= " ORDER BY " . $sortColumn;
            
            if (!is_null($sortDirection)) {
                $sql .= " " . $sortDirection;
            }
        }

		// setup paging if passed
	if (!is_null($page)) {
		$sql .= " LIMIT " . ((2 * $page) - 1) . ",2";
	}
//var_dump($sql);die;        
        $stmt = $this->db->prepare($sql);
        
        if ($stmt) {
            $stmt->execute(array('%' . $filterText . '%'));
            
            $articleList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
                
        return $articleList;        
    }        
    
    function exportCMS($filename) {
        $data = $this->getList();
		        
        $outputFileHandle = fopen(dirname(__FILE__) . "/../" . $filename, "x");

        if ($outputFileHandle) {
        
            if (is_array($data)) {
                foreach ($data as $rowData) {
                    fputcsv($outputFileHandle, $rowData);
                }
            }
            
            fclose($outputFileHandle);            
        }
    }
    
    function importCMS($filename) {
        
        var_dump($filename);
        
        if (is_file($filename)) {
            
            $importFileHandle = fopen($filename, "r");

            if ($importFileHandle) {
                    
                while (feof($importFileHandle) === false) {
                    $rowData = fgetcsv($importFileHandle);

                    if (is_array($rowData)) {
                        $rowData = array_combine(
                            array("cms_id", 'keywords', 'content', 'h1', 'title', 'url_key'),
                            $rowData
                        );

                        if (isset($rowData['cms_id']) && $rowData['cms_id'] > 0) {
                            $this->load($rowData['cms_id']);
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
    
    function saveBanner($fileArray) {
        move_uploaded_file($fileArray['tmp_name'], dirname(__FILE__) . 
                "/../public/images/" . $this->data['cms_id'] . "_cms_banner.jpg");
    }
    
    
    
    
    /*template load*/
    function loadKey($cmsURL)
    {
        // flag to track if the article was loaded
        $isLoaded = false;

        // load from database
        // create a prepared statement (secure programming)
        $stmt = $this->db->prepare("SELECT * FROM cms WHERE url_key= ?");
        
        // execute the prepared statement passing in the id of the article we 
        // want to load
        $stmt->execute(array($cmsURL));

        // check to see if we loaded the article
        if ($stmt->rowCount() == 1) 
        {
            // if we did load the article, fetch the data as a keyed array
            $dataArray = $stmt->fetch(PDO::FETCH_ASSOC);
            //var_dump($dataArray);
            
            // set the data to our internal property            
            $this->set($dataArray);
                        
            // set the success flag to true
            $isLoaded = true;
        }
        
        //var_dump($stmt->rowCount());
        
        // return success or failure
        return $isLoaded;
    }

}
?>