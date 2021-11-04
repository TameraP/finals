<?php

class Base {
    // property to hold our data
    var $data = array();
    // property to hold errors
    var $errors = array();

    // table name this class works with
    var $tableName = null;
    // keyfield of the table
    var $keyField = null;
    // column names minus the keyword in the table
    var $columnNames = array();
    
    // property for holding a reference to a database connection so we can reuse it
    var $db = null;

    function __construct() {
        // create a connection to our database
        $this->db = new PDO('mysql:host=localhost;dbname=wdv441_2021;charset=utf8', 
            'wdv441_user', 'wdv441_2021');       
    }
    
	// store the passed array of information into our internal array
    function set($dataArray) {
        if (!is_array($this->data) || count($this->data) == 0) {
            $this->data = $dataArray;
        } else {        
			// for each key in the array set the value to our internal data
            foreach ($dataArray as $key => $value) {
                if (isset($this->data[$key])) {
                    $this->data[$key] = $value;
                }
            }
        }
    }
    
    function sanitize($dataArray) {
        // sanitize data based on rules
        
        return $dataArray;
    }
    
    function load($id) {
        $isLoaded = false;

        // load from database                
        $stmt = $this->db->prepare("SELECT * FROM " . 
            $this->tableName . " WHERE " . $this->keyField . " = ?");
        
        $stmt->execute(array($id));

        if ($stmt->rowCount() == 1) {
            $dataArray = $stmt->fetch(PDO::FETCH_ASSOC);
            //var_dump($dataArray);
            $this->set($dataArray);
            
            $isLoaded = true;
        }
        
        return $isLoaded;
    }
    
    // save the data from our data property into the data table
    function save() {
        $isSaved = false;
        
        // determine if insert or update based on articleID
        // save data from data property to database
        if (empty($this->data[$this->keyField])) {
            $sql = "INSERT INTO " . $this->tableName . " 
                    (" . implode(', ', $this->columnNames) . ") 
                 VALUES (";
            
            for ($i = 0; $i < count($this->columnNames); $i++) {
                $sql .= ($i > 0 ? ', ?' : '?');
            }
            
            $sql .= ")";
            
            $stmt = $this->db->prepare($sql);
               
            $dataArray = array();
            
            // create a data array of the column data in the correct order needed
            foreach ($this->columnNames as $columnName) {
                $dataArray[] = $this->data[$columnName];
            }
            
            $isSaved = $stmt->execute(array_values($dataArray));

            // if the execute returned true, then store the new id back into our 
            // data property            
            if ($isSaved) {
                $this->data[$this->keyField] = $this->db->lastInsertId();
            }
        } else {
            $sql = "UPDATE " . $this->tableName . " SET ";
            
            foreach ($this->columnNames as $columnName) {
                $sql .= $columnName . " = ?,";
            }

            // remove trailing comma
            $sql = substr($sql, 0, strlen($sql) - 1);
            
            $sql .= " WHERE " . $this->keyField . " = ?";
            
            $stmt = $this->db->prepare($sql);
            
            $dataArray = array();
            
            foreach ($this->columnNames as $columnName) {
                $dataArray[] = $this->data[$columnName];
            }
            
            $dataArray[] = $this->data[$this->keyField];
            
            $isSaved = $stmt->execute($dataArray);        
        }
                        
        return $isSaved;
    }
    
    // return true if all the data is valid
    function validate() {
        $isValid = true;
        
        return $isValid;
    }
    
    // returns an associative array of data for the passed criteria
    function getList($sortColumn = null, $sortDirection = null, $filterColumn = null, $filterText = null) {
        $dataList = array();
        
        $sql = "SELECT * FROM " . $this->tableName . " ";

        if (!is_null($filterColumn) && !is_null($filterText)) {
            $sql .= " WHERE " . $filterColumn . " LIKE ?";
        }
        
        if (!is_null($sortColumn)) {
            $sql .= " ORDER BY " . $sortColumn;
            
            if (!is_null($sortDirection)) {
                $sql .= " " . $sortDirection;
            }
        }
        
        $stmt = $this->db->prepare($sql);
        
        if ($stmt) {
            $stmt->execute(array('%' . $filterText . '%'));
            
            $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
                
        return $dataList;        
    }
}
?>