<?php
require_once('../inc/faq.class.php');

$faq= new FAQ();

$faqList = array();

$v = array(); 
$faqList = $faq->getFAQS(
    (isset($_GET['faqID']) ? $_GET['faqID'] : null)
);

//var_dump($articleList);
echo json_encode($faqList);

?>