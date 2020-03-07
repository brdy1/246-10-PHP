<!DOCTYPE html>
<html>
<head>
	<title>King Library - Thanks for Registering!</title>
	<link rel="stylesheet" type="text/css" href="css/KingLib_3.css">
</head>
<body>

<?php 
/*****************************************
File: assignment_3_view_patrons.php
Student: Brady Peneton
Assignment: 3
****************************************/
?>

	<div id="logo">
	 	<img src="images/KingLibLogo.jpg" alt="King Real Estate Logo">
    </div>

    <div id="register">
	
    <h1>View Patrons</h1>

    <table border='1'>

	<tr>
		<th>Last Name</th>
		<th>First Name</th>
		<th>Email</th>
		<th>City</th>
		<th>Birth Year</th>
	</tr>


<?php

$filename = 'data/patrons.txt';

if (file_exists($filename))
	{
		


$display = "";
$line_ctr = 0;

$fp = fopen($filename, 'r');   //opens the file for reading

while(true)
{
	$line = fgets($fp);

	if (feof($fp))
	{
		break;
	}

	$line_ctr++;

	$line_ctr_remainder = $line_ctr % 2;

	if ($line_ctr_remainder == 0)
	{
		$style = "style='background-color: #FFFFCC;'";
	} else {
		$style = "style='background-color: white;'";
	}

	list($lastname, $firstname, $email, $city, $birthyear) = explode('|', $line);

	$display .= "<tr $style>";
		$display .= "<td>".$lastname."</td>";
		$display .= "<td>".$firstname."</td>";
		$display .= "<td>".$email."</td>";
		$display .= "<td>".$city."</td>";
		$display .= "<td>".$birthyear."</td>";
	$display .= "</tr>\n";  //added newline
}

fclose($fp );

print $display;   //This prints the table rows

print "<tfoot></tfoot></table>";

} else {
	echo "No Patrons Found";
	
	}

?>
<br>

</div>

</body>

</html>
