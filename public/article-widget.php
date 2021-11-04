<?php
require_once('../inc/NewsArticles.class.php');

$articleLimit = (isset($_GET["limit"]) ? intval($_GET["limit"]) : 5);

$newsArticle = new NewsArticles();

$articleList = $newsArticle->getList();

$articleCount = 0;

// display the widget view
require_once('../tpl/article-widget.tpl.php');
?>