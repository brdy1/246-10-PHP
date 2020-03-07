<!DOCTYPE html>
<html>
<head>
	<title>0305 Appending Text</title>
	<link rel="stylesheet" type="text/css" href="css/basic.css">
</head>
<body>
	<?php
		$salutation = $_POST['salutation'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$fullname = $salutation.' '.$firstname.' '.$lastname;

		print "<p>$fullname is a pretty formal way to address you. How about I just call you $firstname?</p>";

	?>

</body>

</head>