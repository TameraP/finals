<?php
require_once('../inc/CMS.class.php');

// if cancel is pushed, go back to list
if (isset($_POST['Cancel'])) {
    header("location: cms-list.php");
    exit;
}

// create an instance of our class so we can use it
$cms = new CMS();

// initialize some variables to be used by our view
$cmsDataArray = array();
$cmsErrorsArray = array();

// load the article if we have it
if (isset($_REQUEST['cms_id']) && $_REQUEST['cms_id'] > 0) 
{
    $cms->load($_REQUEST['cms_id']);
    // set our article array to our local variable
    $cmsDataArray = $cms->data;
}

// apply the data if we have new data
if (isset($_POST['Save']))
{
    // set the post array to our local variable
    $cmsDataArray = $_POST;
    // sanitize
    $cmsDataArray = $cms->sanitize($cmsDataArray);
    // pass the array into our instance
    
    $cms->set($cmsDataArray);
    
    // validate
    if ($cms->validate()) {
        // save
        if ($cms->save()) {
            $cms->saveBanner($_FILES['banner_image']);
            
            header("location: cms-save-success.php");
            exit;
        } else {
            $cmsErrorsArray[] = "Save failed";
        }
    } else {
        $cmsErrorsArray = $cms->errors;
        $cmsDataArray = $cms->data;
    }
}

// display the view
require_once('../tpl/cms-edit.tpl.php');
?>