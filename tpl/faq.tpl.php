<html>
	<head>
		<title><?php echo (isset($faqDataArray['faqQuestion']) ? $faqDataArray['faqQuestion'] : ''); ?></title>
	</head>
    <body>
		<h1><?php echo (isset($faqDataArray['faqQuestion']) ? $faqDataArray['faqQuestion'] : ''); ?></h1>
		<p>
			<?php echo (isset($faqDataArray['faqAnswer']) ? $faqDataArray['faqAnswer'] : ''); ?>
		</p>
	       <a href="faq-list.php">Back to List</a>
    </body>
</html>