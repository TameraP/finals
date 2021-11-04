<?php
require_once('../inc/CMS.class.php');

$cms1 = new CMS();

$cmsDataArray1 = array();

// load the article if we have it
if (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) {
    $cms1->loadKey($_REQUEST['page']);
    $cmsDataArray1 = $cms1->data;
}


// display the view
require_once('../tpl/view_page2.tpl.php');
?>