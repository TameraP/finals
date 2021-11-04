<html>
    <body>
        <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" enctype="multipart/form-data">
            <?php if (isset($faqErrorsArray['faqQuestion']))                 
            { ?>
                <div><?php echo $faqErrorsArray['faqQuestion']; ?>
            <?php } ?>
            Question: <input type="text" name="faqQuestion" value="<?php echo (isset($faqDataArray['faqQuestion']) ? $faqDataArray['faqQuestion'] : ''); ?>"/><br>
	   <?php if (isset($faqErrorsArray['faqAnswer']))                 
            { ?>
                <div><?php echo $faqErrorsArray['faqAnswer']; ?>
            <?php } ?>
            Answer: <input type="text" name="faqAnswer" value="<?php echo (isset($faqDataArray['faqAnswer']) ? $faqDataArray['faqAnswer'] : ''); ?>"/><br>
            <input type="hidden" name="faqID" value="<?php echo (isset($faqDataArray['faqID']) ? $faqDataArray['faqID'] : ''); ?>"/>
            <input type="submit" name="Save" value="Save"/>
            <input type="submit" name="Cancel" value="Cancel"/>            
        </form>        
    </body>
</html>