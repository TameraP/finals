<?php
require_once('../inc/login.class.php');

// create an instance of the news article class
$newsArticle = new loginArticles();

$articleList = array();

// download report
if (isset($_GET['download']) && $_GET['download'] == "1") {

	$articleList = $newsArticle->getUsers(
		var_dump($articleList)
	);
	
	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="' . date("YmdHis") . '_user_report.csv"');
	
	foreach ($articleList as $rowData) {
		echo '"'. implode('","', $rowData) . '"';
		echo "\r\n";
	}
	
	exit;
}

if (isset($_GET['btnViewReport'])) {
    // run report
	$articleList = $newsArticle->getUsers(
		(isset($_GET['page']) ? $_GET['page'] : 1)
	);
}

$_GET['page'] = (isset($_GET['page']) ? $_GET['page'] + 1 : 2);
$nextPageLink = http_build_query($_GET);

include('../tpl/user-report.tpl.php');
?>