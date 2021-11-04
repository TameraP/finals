<?php

require_once('../inc/NewsArticles.class.php');

$newsArticle = new newsArticles();

$articleDataArray = array();
$articleErrorsArray = array();

if (isset($_REQUEST['articleID']) && $_REQUEST['articleID'] > 0) {
    $newsArticle->load($_REQUEST['articleID']);
    $articleDataArray = $newsArticle->articleData;
}

if (isset($_POST['Cancel'])) {
    header("location: article-list.php");
    exit;
}

if (isset($_POST['Save'])) {
    $articleDataArray = $newsArticle->sanitize($_POST);
    $newsArticle->set($articleDataArray);

    if ($newsArticle->validate()) {
        if ($newsArticle->save()) {
       	    $newsArticle->saveImage($_FILES['upload_image']);
            header("location: article-save-success.php");
            exit();
        } else {
            $articleErrorsArray[] = "Save failed";
        }
    } else {
        $articleErrorsArray = $newsArticle->errors;
        $articleDataArray = $newsArticle->articleData;
    }
}

require_once('../tpl/article-edit.tpl.php');
?>