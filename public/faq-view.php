<?php
require_once('../inc/faq.class.php');

$faq = new FAQ();

$faqDataArray = array();

// load the article if we have it
if (isset($_REQUEST['faqID']) && $_REQUEST['faqID'] > 0) {
    $faq->load($_REQUEST['faqID']);
    $faqDataArray = $faq->data;
}

// display the view
require_once('../tpl/faq-view.tpl.php');
?>