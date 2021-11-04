<?php
require_once('../inc/CMS.class.php');

$cms = new CMS();

$cmsDataArray = array();

// load the article if we have it
if (isset($_REQUEST['cms_id']) && $_REQUEST['cms_id'] > 0) {
    $cms->load($_REQUEST['cms_id']);
    $cmsDataArray = $cms->data;
}

// display the view
require_once('../tpl/cms-view.tpl.php');
?>