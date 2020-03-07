<!DOCTYPE html>
<html>
<head>
	<title>King Library - Thanks for Registering!</title>
	<link rel="stylesheet" type="text/css" href="css/KingLib_6.css">
</head>
<body>

	<?php 
	/*****************************************
	File: assignment_6_view_patrons.php
	Student: Brady Peneton
	Assignment: 6
	****************************************/
	?>

	<div id="logo">
		 	<img src="images/KingLibLogo.jpg" alt="King Real Estate Logo">
	</div>

	<div id="register">
		
	<h1>View Patrons</h1>

	<?php

	//include db functions connectDatabase displayPatrons and insertPatron

	include "assignment_6_db_functions.php";

	$db = connectDatabase();

	$display = displayPatrons($db, $sql_statement);

	print $display;   //This prints the table rows

	print "<tfoot></tfoot></table>";

	?>

	<br>

</div>

</body>

</html>
