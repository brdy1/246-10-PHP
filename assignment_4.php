<!DOCTYPE html>
<html>
<head>
	<title>King Library</title>
	<link rel="stylesheet" type="text/css" href="css/KingLib_3.css">
</head>
<body>

<?php 
/*****************************************
File: assignment_4.php
Student: Brady Peneton
Assignment: 4
****************************************/
?>

	<div id="logo">
	 	<img src="images/KingLibLogo.jpg" alt="King Real Estate Logo">
    </div>

    <div id="main">
	<?php

	?>
	<h2>Enter Keyword to Search for Current Titles:</h2>

	<form method="post" action="assignment_4_booklist.php">
		<input type="text" name="query" size="35">(leave blank to list all titles)
		<br>
		<label>Sort Order:</label><br>
			<input type="radio" name="sort" value="ascending" checked> Ascending
 			<input type="radio" name="sort" value="descending"> Descending
		<input type="submit" value="Search" />
	</form>

	

	</div>
</div>

</body>

</html>
