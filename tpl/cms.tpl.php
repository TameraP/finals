<html>
	<head>
		<title><?php echo (isset($cmsDataArray['title']) ? $cmsDataArray['title'] : ''); ?></title>
		<meta name="keywords" content="<?php echo (isset($cmsDataArray['keywords']) ? $cmsDataArray['keywords'] : ''); ?>"/>
	</head>
    <body>
		<h1><?php echo (isset($cmsDataArray['h1']) ? $cmsDataArray['h1'] : ''); ?></h1>
        <?php if (is_file(dirname(__FILE__) . "/../public/images/" . $cmsDataArray['cms_id'] . "_cms_banner.jpg")) { ?>
            <img src="images/<?php echo $cmsDataArray['cms_id'] . "_cms_banner.jpg"; ?>" width="50" height="50"/>
        <?php } ?>
		<p>
			<?php echo (isset($cmsDataArray['content']) ? $cmsDataArray['content'] : ''); ?>
		</p>
	       <a href="cms-list.php">Back to List</a>
    </body>
</html>