<?php
require_once('../inc/faq.class.php');

// if cancel is pushed, go back to list
if (isset($_POST['Cancel'])) {
    header("location: faq-list.php");
    exit;
}

// create an instance of our class so we can use it
$faq = new FAQ();

// initialize some variables to be used by our view
$faqDataArray = array();
$faqErrorsArray = array();

// load the article if we have it
if (isset($_REQUEST['faqID']) && $_REQUEST['faqID'] > 0) 
{
    $faq->load($_REQUEST['faqID']);
    // set our article array to our local variable
    $faqDataArray = $faq->data;
}

// apply the data if we have new data
if (isset($_POST['Save']))
{
    // set the post array to our local variable
    $faqDataArray = $_POST;
    // sanitize
    $faqDataArray = $faq->sanitize($faqDataArray);
    // pass the array into our instance
    
    $faq->set($faqDataArray);
    
    // validate
    if ($faq->validate()) {
        // save
        if ($faq->save()) {
            /*$cms->saveBanner($_FILES['banner_image']);*/
            
            header("location: faq-save-success.php");
            exit;
        } else {
            $faqErrorsArray[] = "Save failed";
        }
    } else {
        $faqErrorsArray = $faq->errors;
        $faqDataArray = $faq->data;
    }
}

// display the view
require_once('../tpl/faq-edit.tpl.php');
?>