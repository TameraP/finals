<html>
    <body>
        title: <?php echo (isset($cmsDataArray['title']) ? $cmsDataArray['title'] : ''); ?><br>
        content: <?php echo (isset($cmsDataArray['content']) ? $cmsDataArray['content'] : ''); ?><br>
        h1: <?php echo (isset($cmsDataArray['h1']) ? $cmsDataArray['h1'] : ''); ?><br>
        keywords: <?php echo (isset($cmsDataArray['keywords']) ? $cmsDataArray['keywords'] : ''); ?><br>
        url_key: <?php echo (isset($cmsDataArray['url_key']) ? $cmsDataArray['url_key'] : ''); ?><br>
        
        <?php if (is_file(dirname(__FILE__) . "/../public/images/" . $cmsDataArray['cms_id'] . "_cms_banner.jpg")) { ?>
            <img src="images/<?php echo $cmsDataArray['cms_id'] . "_cms_banner.jpg"; ?>"/>
        <?php } 
        
        var_dump($cmsDataArray['cms_id'])?>
        <a href="cms-list.php">Back to List</a>        
    </body>
</html>