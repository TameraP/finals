<?php

	$url = "http://localhost/Week13/public/curl-test-post-recv.php";

	// create curl resource
	$ch = curl_init();

	// set url
	curl_setopt($ch, CURLOPT_URL, $url);

	// if redirected, follow it
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

	//return the transfer as a string
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	// set curl to POST instead of GET
	curl_setopt($ch, CURLOPT_POST, 1);

	// set the POST data that curl will post
	curl_setopt($ch, CURLOPT_POSTFIELDS, array("test_information" => "this is a test"));

	// $output contains the output string
	$output = curl_exec($ch);

	// close curl resource to free up system resources
	curl_close($ch);     

	var_dump($output);
?>