<?php
require_once('../inc/NewsArticles.class.php');

$newsArticles = new NewsArticles();

$newsArticles->importNewsArticles(dirname(__FILE__) . "/../news_articles_dump.csv")
?>