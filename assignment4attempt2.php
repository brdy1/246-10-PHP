<!DOCTYPE html>
<html>
<head>
	<title>King Library</title>
	<link rel="stylesheet" type="text/css" href="css/KingLib_3.css">
</head>
<body>

<?php 
/*****************************************
File: assignment_4_booklist.php
Student: Brady Peneton
Assignment: 4
****************************************/
?>

<div id="logo">
	<img src="images/KingLibLogo.jpg" alt="King Real Estate Logo">
</div>

<div id="main">
<?php

	//initialize variables

	$sortAscending = False;
	$entryArray = array(); //empty array for entries below
	$sort = $_POST['sort']; //pull the sort radio selection into $sort
	$file = 'data/booklist.txt'; // set up the file name
	$display = ""; // set the eventual table print text to blank
	$line_ctr = 0; // start the line counter at 0
	$lines_in_file = count(file($file)); //number of lines in the file
	$fp = fopen($file, 'r');   //opens the file for reading

	if (isset($_POST['query'])) { //store keyword search as $query
		$query = $_POST['query'];
	}
	if ($sort == 'ascending') {
		$sortAscending = True;
	}

	printHeads($query);
	startTable();
	$display = createTable($query, $sort);
	print $display;


function printHeads($query) {

	if ($query != '') {
		print "<h1>Current Titles that match: $query</h1>";
	} else {
		print "<h1>Current Titles:</h1>";
	}

	if ($sort == 'ascending') {
		print "<h2>(Sorted in Alphabetical Order</h2>";
	} else {
		print "<h2>(Sorted in Reverse Alphabetical Order)</h2>";
	}

}

function startTable() {
	print "<table>\n";
	print "<tr>\n";
	print "<th>Title</th>\n";
	print "<th>ISBN</th>\n";
	print "<th>Type</th>\n";
	print "<th>Publication Date</th>\n";
	print "</tr>\n";

}

function createTable($query, $sort) {

if (file_exists($file)) {

	while (!feof($file)) {

       	$line = explode("\n", fgets($file));

       	if ($query != '') {

       		$pos = stripos($line[0], $query);

			if ($pos !== false) {

				continue;

   			}
   		}
   		if ($line[0] == '') {

   			continue;
   		}

   		array_push($entryArray, $line[0]);
	}

   	if ($sortAscending) {
       	asort($entryArray);
   	} else {
       	arsort($entryArray);
   	}
    
   	foreach ($entryArray as $row) {
   		list($title, $type, $date, $isbn) = explode('*', $row)
   		
   		$line_ctr++; // add 1 to the line counter

		if ($line_ctr % 2 == 0) { // set row styles
		$style = "class='even'";
		} else {
			$style = "class='odd'";
			}
		$display .= "<tr $style>";
		$display .= "<td>".$title."</td>";
		$display .= "<td>".$isbn."</td>";
		$display .= "<td>".$type."</td>";
		$display .= "<td>".$publication."</td>";
		$display .= "</tr>\n";  //add new line

		}

		return $display;
	}
}

?>
</div>

</body>

</html>