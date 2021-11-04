<?php
require_once('../inc/NewsArticles.class.php');

$newsArticle = new newsArticles();
var_dump($newsArticle->load(1));

$newsArticle->articleData["articleAuthor"] = "GG2";

if ($newsArticle->validate()) {
    var_dump($newsArticle->save());
} else {
    // do something with the errors
    var_dump($newsArticle->errors);
}

?>