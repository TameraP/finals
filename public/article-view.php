<?php

require_once('../inc/NewsArticles.class.php');

$newsArticle = new newsArticles();

$articleDataArray = array();

// load the article if we have it
if (isset($_REQUEST['articleID']) && $_REQUEST['articleID'] > 0) {
    $newsArticle->load($_REQUEST['articleID']);
    $articleDataArray = $newsArticle->articleData;
}

require_once('../tpl/article-view.tpl.php');
?>