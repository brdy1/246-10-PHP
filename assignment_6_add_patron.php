<!DOCTYPE html>
<html>
<head>
	<title>King Library - Thanks for Registering!</title>
	<link rel="stylesheet" type="text/css" href="css/KingLib_6.css">
</head>
<body>

<?php 
/*****************************************
File: assignment_6_add_patron.php
Student: Brady Peneton
Assignment: 6
****************************************/
?>

	<div id="logo">
	 	<img src="images/KingLibLogo.jpg" alt="King Real Estate Logo">
    </div>

    <div id="register">
	<?php

		include "assignment_6_db_functions.php";

		//Initialize variables via php

		$firstname = trim($_POST['firstname']);

		$lastname = trim($_POST['lastname']);

		$fullname = trim($firstname.' '.$lastname);

		$email = trim($_POST['email']);

		$birthyear = trim($_POST['birthyear']);

		$city = $_POST['city'];

		$currentyear = date('Y');

		$age = $currentyear - $birthyear;

		$goback = 'N';



	//Begin data validation
	if (empty($firstname)) //validate first name existence
	{
		print "<p>Error: You must enter a first name.</p>\n"; //error message for first name

		$goback='Y'; //set goback flag to true

	}


	if (empty($lastname)) //validate last name existence
	{
		print "<p>Error: You must enter a last name.</p>\n"; //error message for last name

		$goback='Y'; //set goback flag to true

	}
	
	if (empty($email))
	{
		print "<p>Error: You must enter a valid email.</p>\n"; //Email error

		$goback='Y'; //set goback flag to true

	}

	if (!is_numeric($birthyear))
	{
		print "<p>Error: You must enter a numeric birth year.</p>\n"; //Birth year numeric error

		$goback='Y'; //set goback flag to true
	}
	else
	{
		$length_of_year = strlen($birthyear); //Store length of $birthyear in $length_of_year.

		if ($length_of_year != 4) //Make sure birthyear is 4 digits long.
		{
			print "<p>Error: Your birth year must be exactly four numbers.</p>\n";
			$goback='Y';
		}

		$validyear = $currentyear - 120; //Valid ages are between 0 and 120.

		if (!($birthyear >= $validyear && $birthyear <= $currentyear))
		{
			print "<p>Error: You must enter a valid birth year between $validyear and $currentyear.</p>\n";
			$goback='Y'; //set goback flag to true
		}
	}

	if ($city == "none")
	{
		print "<p>Error: You must select a city.</p>\n"; //City error

		$goback='Y'; //set goback flag to true
	}


	if ($goback == 'Y')
	{
		print "<p class=\"bold\">WARNING: Due to errors in the form, we were not able to register you. Go BACK and make corrections.</p>\n";
	}

	//End Data Validation -->

		
	if ($goback == 'N')
	{
		//Establish connection to the database and return connection parameters to $db

		$db = connectDatabase();

		//Output variables to patron table

		$rtinfo = insertPatron($db, $lastname, $firstname, $email, $city, $birthyear);

		if ($rtinfo == $lastname) {
			
		//Print data back to user
			print "<h2>Thank you for registering!</h2>\n";
			print "<p>Name: $fullname</p>\n";
			print "<p>Email: $email</p>\n";
			print "<p>City: $city</p>\n";
			print "<p>Section: ";
			
			//Establish section categories

			if ($age <= 15)
			{
				print "Children</p>\n";
				$section = "Children"; 
			}
			
			if ($age >= 16 && $age <= 54)
			{
				print "Adult</p>\n";
				$section = "Adult";
			}
			
			if ($age >= 55)
			{
				print "Senior</p>\n";
				$section = "Senior";
			}
		} else {
			echo "We could not register the user. Please see errors above.";
		}
}

	//End data printback and appending


	//include db functions connectDatabase displayPatrons and insertPatron

	

	?>

	<p>For Admin Use Only: <a href="assignment_6_view_patrons.php">View Patrons</a></p>
	</div>


</body>

</html>
