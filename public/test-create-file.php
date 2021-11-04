<?php
require_once('../inc/NewsArticles.class.php');

$newsArticles = new newsArticles();

$newsArticles->exportNewsArticles('1news_articles_dump.csv');
?>