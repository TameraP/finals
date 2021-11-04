<?php
require_once('../inc/faq.class.php');

$faq = new FAQ();

	// create curl resource
	$ch = curl_init();

	// set url
	curl_setopt($ch, CURLOPT_URL, "http://tamerapeake.us.tempcloudsite.com/AdvPHP/final/public/faq-widget.php?limit=2");

	// if redirected, follow it
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

	//return the transfer as a string
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$userAgent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36";

	curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

	// $output contains the output string
	$newsWidgetHTML = curl_exec($ch);

	// close curl resource to free up system resources
	curl_close($ch);     

$faqList = $faq->getList(
    (isset($_GET['sortColumn']) ? $_GET['sortColumn'] : null),
    (isset($_GET['sortDirection']) ? $_GET['sortDirection'] : null),
    (isset($_GET['filterColumn']) ? $_GET['filterColumn'] : null),
    (isset($_GET['filterText']) ? $_GET['filterText'] : null),
    (isset($_GET['page']) ? $_GET['page'] : null)
);


require_once("../tpl/faq-list.tpl.php");
?>