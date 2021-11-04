<?php
//PHP PDO Connection File
//This File is used to connect to a database.
//Include this file into your application as needed

$serverName='localhost';
$username='tamerapeake_wdv'; //username of database, not account
$password='1Ladyluck!'; //password of database
$databaseName='tamerapeake_wdv';//name of the database you will be accesing
  //on heartland, the username & databasename are the same.
  //so when uploading it to my heartland account, find the username for heartland
  //and that's the same for the databaseName


try {
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

 ?>