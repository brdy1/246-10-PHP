<?php

	/*****************************************
	File: assignment_6_db_functions.php
	Student: Brady Peneton
	Assignment: 6
	****************************************/

		function connectDatabase() {
			require('../../DBtest_pptest.php');

			$host =  'localhost';
			$userid =  'P70';
			$password = '7dosql7';
			$dbname = 'testdb';

			$db = mysqli_perry_pconnect($host, $userid, $password, $dbname);

			if (!$db)
			{
				print "<h1>Unable to Connect to MySQLi</h1>";
				exit;
			}

			return $db;
		}

		function displayPatrons($db, $statement) {
			$statement = "SELECT * ";
			$statement .= "FROM patrontable ";
			$statement .= "ORDER BY lastname, firstname ASC ";

			$result = mysqli_query($db, $statement);

			if (!$result) {
				$output .= "ERROR";
				$output .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
				$output .= "MySQL Error: ".mysqli_error($db)."<br>";
				$output .= "<br>SQL: ".$sql_statement."<br>";
				$output .= "<br>MySQL Affected Rows: ".mysqli_affected_rows($db)."</font><br>";
			} else {
				$numresults = mysqli_num_rows($result);

				if ($numresults == 0) {
					
					$output = "No Patrons Found.";

				} else {

					$output = "<table border='1'>\n";
					$output .= "<tr>\n<th>Last Name</th><th>First Name</th>";
					$output .= "<th>Email</th><th>City</th><th>Birth Year</th>\n</tr>";

					for ($i = 0; $i < $numresults; $i++) {

						$remainder = $i % 2;

						if ($remainder == 0) {
							$style = "style='background-color: #FFFFCC;'";
						} else {
			  				$style = "style='background-color: white;'";
						}

						$row = mysqli_fetch_array($result);

						$lastname = $row['lastname'];
						$firstname = $row['firstname'];
						$email = $row['email'];
						$city = $row['city'];
						$birthyear = $row['birthyear'];

						$output .= "<tr $style>";
						$output .= "<td>".$lastname."</td>";
						$output .= "<td>".$firstname."</td>";
						$output .= "<td>".$email."</td>";
						$output .= "<td>".$city."</td>";
						$output .= "<td>".$birthyear."</td>";
						$output .= "</tr>\n";  //added newline
					}
				$output .= "<tfoot></tfoot></table>";
				}
			return $output;
			}
		}

		function insertPatron($db, $lastname, $firstname, $email, $city, $birthyear) {
			$statement = "INSERT into patrontable (lastname, firstname, email, city, birthyear) ";
			$statement .= "values (";
			$statement .= "'".$lastname."', '".$firstname."', '".$email."', '".$city."', '".$birthyear."'";
			$statement .= ")";

			$result = mysqli_query($db, $statement);

			if($result) {
				return $lastname;
			} else {
				$errno = mysqli_errno($db);

				if ($errno == '1062') {
					echo "<p style='color: red'>Author with SSN of ".$myssn. " is already in Table ";
				} else {
					echo("<h4>MySQL No: ".mysqli_errno($db)."</h4>");
					echo("<h4>MySQL Error: ".mysqli_error($db)."</h4>");
					echo("<h4>SQL: ".$statement."</h4>");
					echo("<h4>MySQL Affected Rows: ".mysqli_affected_rows($db)."</h4>");
				}
				return 'NotAdded';
			}

		}
?>