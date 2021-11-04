<html>
	<head>
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
		<div>it <span id="outMatch"></span> going to rain in Des Moines, Iowa tomorrow</div>
	</body>
</html>