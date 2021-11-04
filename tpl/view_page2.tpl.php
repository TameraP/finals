<html>
	<head>
		<title><?php echo (isset($cmsDataArray1['title']) ? $cmsDataArray1['title'] : ''); ?></title>
		<meta name="keywords" content="<?php echo (isset($cmsDataArray['keywords']) ? $cmsDataArray['keywords'] : ''); ?>"/>
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	    <script>
	    
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		  if (this.readyState == 4 && this.status == 200) {
		    var result = JSON.parse(this.responseText);
		    var yesNo = result.ConditionMatched;
		    
		    if(yesNo == "No") {
	              	document.getElementById("outMatch").innerHTML="is not";
	            }
	                
	            else if(yesNo == "Yes") {
	              	document.getElementById("outMatch").innerHTML= "is";
	            }
	            
	            else {
	              	document.getElementById("outMatch").innerHTML= "not working";	            
	            }
		  }
		};
		xmlhttp.open("GET", "../public/curl-test.php", true);
		xmlhttp.send();
	
	    </script>
	</head>
		
     <body>
     		<h1><?php echo (isset($cmsDataArray1['h1']) ? $cmsDataArray1['h1'] : ''); ?></h1>
		<p><?php echo (isset($cmsDataArray1['content']) ? $cmsDataArray1['content'] : ''); ?></p>
		<p>Keywords:<?php echo (isset($cmsDataArray1['keywords']) ? $cmsDataArray1['keywords'] : ''); ?></p>
		<p>URL_KEY:<?php echo (isset($cmsDataArray1['url_key']) ? $cmsDataArray1['url_key'] : ''); ?></p>
		<p>Weather:it <span id="outMatch"></span> going to rain in Des Moines, Iowa tomorrow</p>
	       <a href="cms-list.php">Back to List</a>
    </body>
</html>