<html>
	<head>
		<title><?php echo (isset($cmsDataArray1['title']) ? $cmsDataArray1['title'] : ''); ?></title>
		<meta name="keywords" content="<?php echo (isset($cmsDataArray['keywords']) ? $cmsDataArray['keywords'] : ''); ?>"/>
	</head>
    <body>
		<h1><?php echo (isset($cmsDataArray1['h1']) ? $cmsDataArray1['h1'] : ''); ?></h1>
        <?php if (is_file(dirname(__FILE__) . "/../public/images/" . $cmsDataArray1['cms_id'] . "_cms_banner.jpg")) { ?>
            <img src="images/<?php echo $cmsDataArray1['cms_id'] . "_cms_banner.jpg"; ?>" width="50" height="50"/>
        <?php } ?>
		<p>
			<?php echo (isset($cmsDataArray1['content']) ? $cmsDataArray1['content'] : ''); ?>
		</p>
	       <a href="cms-list.php">Back to List</a>
    </body>
</html>