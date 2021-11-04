<html>
    <body>
        Question: <?php echo (isset($faqDataArray['faqQuestion']) ? $faqDataArray['faqQuestion'] : ''); ?><br>
        Answer: <?php echo (isset($faqDataArray['faqAnswer']) ? $faqDataArray['faqAnswer'] : ''); ?><br>

        <a href="faq-list.php">Back to List</a>        
    </body>
</html>