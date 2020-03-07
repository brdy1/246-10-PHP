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

	$entry_array = array(); //empty array for entries below
	$sort = $_POST['sort']; //pull the sort radio selection into $sort
	$file = 'data/booklist.txt'; // set up the file name
	$display = ""; // set the eventual table print text to blank
	$line_ctr = 0; // start the line counter at 0
	$lines_in_file = count(file($file)); //number of lines in the file
	$fp = fopen($file, 'r');   //opens the file for reading	

	if (isset($_POST['query'])) {
	$query = $_POST['query'];
	if ($query != '') {


		print "<h1>Current Titles that match: $query</h1>";
	} else {
		print "<h1>Current Titles:</h1>";
	}
	?>

    <table>

	<tr>
		<th>Title</th>
		<th>ISBN</th>
		<th>Type</th>
		<th>Publication Date</th>
	</tr>


<?php

if (file_exists($file))
	{
	if (!empty($query)){ //if the query is not empty
		while(true)
		{
			$line = fgets($fp);

			if (feof($fp)) //test for end of file on a file pointer
			{
				break; // exit loop if end of file
			}

			list($title, $type, $publication, $isbn) = explode('*', $line);
			//use * as a data separator
			$entry = $title.$isbn.$type.$publication;

			$pos = stripos($entry, $query);

			if ($pos !== false)
			{
			$line_ctr++; // add 1 to the line counter

			array_push($entry_array, $line) //add the current line to the array

			$line_ctr_remainder = $line_ctr % 2;

			if ($line_ctr_remainder == 0) // set row styles
			{
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
		}

		fclose($fp ); //close the file

		print $display;   //this prints the table rows

		print "<tfoot></tfoot></table>";
	} else {
		while(true)
		{
		$line = fgets($fp);

		if (feof($fp)) //test for end of file on a file pointer
		{
		break; // exit loop if end of file
		}

		$line_ctr++; // add 1 to the line counter

		$line_ctr_remainder = $line_ctr % 2;

		if ($line_ctr_remainder == 0) // on even color it, odd leave it blank
		{
			$style = "class='even'";
		} else {
			$style = "class='odd'";
		}

		list($title, $type, $publication, $isbn) = explode('*', $line);
		//use * as a data separator

		$display .= "<tr $style>";
		$display .= "<td>".$title."</td>";
		$display .= "<td>".$isbn."</td>";
		$display .= "<td>".$type."</td>";
		$display .= "<td>".$publication."</td>";
		$display .= "</tr>\n";  //add new line
		}
		fclose($fp ); //close the file

		print $display;   //this prints the table rows

		print "<tfoot></tfoot></table>";
	}

	} else {
		echo "<p>There was an error loading the file booklist.txt</p>";
		}

?>
<br>

</div>

</body>

</html>
