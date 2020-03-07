<html>
	<head>
		<title> </title>
		<style> </style>
	</head>
	<body>
		<h1>0302 Displaying HTML from a PHP program</h1>
		<p>What are script tags and why do we need them to run PHP?</p>
		<?php
			$today = date('Y-m-d h:g:s');
			print "<p><span style='color:red; font-weight:bold;'>Today is $today</p>";
			
		?>
		<p>Do you want to see that again?<p>
		<?php
			print "<p><span style='color:green;'>Today is $today</span></p>";
			
		?>
	</body>

</html>