<?php
 require "../inc/login.class.php";
	header('Content-type: application/json');
	
	//$url = "http://api.weatherunlocked.com/api/current/51.50,-0.12?app_id={adac5b04}&app_key={3e7081c538805cb1c5bdd032685cd948}";
	//$url = "http://api.weatherunlocked.com/api/trigger/51.50,-0.12/forecast 2014.04.24.12,2014.04.25.12 temperature gt 16?app_id={adac5b04}&app_key={3e7081c538805cb1c5bdd032685cd948}";
	$url = "http://api.weatherunlocked.com/api/trigger/us.50311/forecast tomorrow weather eq anyrain?type=xml&app_id=adac5b04&app_key=3e7081c538805cb1c5bdd032685cd948";
	//$url = "http://api.weatherunlocked.com/api/trigger/us.50311/past yesterday temperature gt 40?app_id=adac5b04&app_key=3e7081c538805cb1c5bdd032685cd948";
	//$url = "http://api.weatherunlocked.com/api/forecast/us.50311?app_id=adac5b04&app_key=3e7081c538805cb1c5bdd032685cd948";
	// create curl resource
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: text/xml"]);
	// set url
	curl_setopt($ch, CURLOPT_URL, $url);

	// if redirected, follow it
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

	//return the transfer as a string
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$userAgent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36";

	curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

	// $output contains the output string
	$output = curl_exec($ch);
	
	// close curl resource to free up system resources
	
	curl_close($ch);     
	//echo $output;
	
	$xml = simplexml_load_string($output);
	$json = json_encode($xml);
	//$array = json_decode($json, true);
	//var_dump($array);
	echo $json;
	//echo $array;

	die();
	
	return $json;
	//require_once('../tpl/curl-weather.tpl.php');
?>