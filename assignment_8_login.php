<!DOCTYPE HTML>
<html>

	<head>
		<title>Login Validation</title>
		<link rel="stylesheet" type="text/css" href="css/login.css">
	</head>

<!--
/*****************************************
File: assignment_8_login.html
Student: Brady Peneton
Assignment: 8
****************************************/
-->

	<body>

		<div class="main" id="login">

			<h1>Login Validation</h1>
 
			<h2>Enter User ID/Password to Login:</h2>

			<form id='login' method='post' action="<?php echo $_SERVER['PHP_SELF']; ?>">

		<?php

		$idForm = $_POST['id'];
		$passForm = $_POST['pass']; 

		print "<div class='row'><label for='id'>User ID</label>\n";
		print "<input type='text' name='id' value='".$idForm."'></div>\n";
		print "<div class='row'><label for='pass'>Password</label>\n";
		print "<input type='text' name='pass' value='".$passForm."'></div>\n";
		print "<input type='submit' name='addbutton' value='Login'>\n";
		print "<p>New User? <a href='assignment_8_new_user.php'>Register here</a></p>\n";
		print "</form>";

		if ($idForm != '') {
			$db = connectDatabase();
			list($outputDisplay, $success) = validateUser($db, $idForm, $passForm);
			print $outputDisplay;
			if ($success) {
				$bookList = fetchBooks($db);
				print $bookList;
			}
		}

		function connectDatabase() {
			require('../../DBtest_pptest.php');

			$host =  'localhost';
			$userid =  'P70';
			$password = '7dosql7';
			$dbname = 'testdb';

			$db = mysqli_perry_pconnect($host, $userid, $password, $dbname);

			if (!$db) {
				print "<h1>Unable to Connect to MySQLi</h1>\n";
				exit;
			}

			return $db;
		}

		function validateUser($db, $idForm, $passForm) {
			$statement = "SELECT id ";
			$statement .= "FROM usertable ";
			$statement .= "WHERE id = '".$idForm."' ";
			$statement .= "AND pass = '".$passForm."' ";

			$result = mysqli_query($db, $statement);

			$outputDisplay = "";
			$rowCount = 0;

			if(!$result) {
				$outputDisplay .= "<h4>MySQL No: ".mysqli_errno($db)."</h4>\n";
				$outputDisplay .= "<h4>MySQL Error: ".mysqli_error($db)."</h4>\n";
				$outputDisplay .= "<h4>SQL: ".$statement."</h4>\n";
				$outputDisplay .= "<h4>MySQL Affected Rows: ".mysqli_affected_rows($db)."</h4>\n";
			} else {

				$numresults = mysqli_num_rows($result);

				if ($numresults == 0) {
					$outputDisplay .= "<p>Invalid Login</p>\n";
					return array($outputDisplay, False);
				} else {
					$outputDisplay .= "<p>Valid Login</p>\n";
					return array($outputDisplay, True);
				}
			}
			
			
			
			}

		function fetchBooks($db) {
			$statement = "SELECT title, type ";
			$statement .= "FROM book ";

			$result = mysqli_query($db, $statement);

			$bookList = "";

			if (!$result) {
				$bookList .= "ERROR";
				$bookList .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
				$bookList .= "MySQL Error: ".mysqli_error($db)."<br>";
				$bookList .= "<br>SQL: ".$sql_statement."<br>";
				$bookList .= "<br>MySQL Affected Rows: ".mysqli_affected_rows($db)."</font><br>";
			} else {
				$numresults = mysqli_num_rows($result);

				if ($numresults == 0) {
					
					$bookList = "Oops! No books were found!";

				} else {

					$bookList = "<h2>Books</h1>\n<table border='1'>\n";
					$bookList .= "<tr>\n<th>Title</th><th>Type</th><tr>";
					
					for ($i = 0; $i < $numresults; $i++) {

						$remainder = $i % 2;

						if ($remainder == 0) {
							$style = "style='background-color: #FFFFCC;'";
						} else {
			  				$style = "style='background-color: white;'";
						}

						$row = mysqli_fetch_array($result);

						$title = $row['title'];
						$type = $row['type'];
						
						$bookList .= "<tr $style>";
						$bookList .= "<td>".$title."</td>";
						$bookList .= "<td>".$type."</td>";
						$bookList .= "</tr>\n";  //add newline
					}
				$bookList .= "<tfoot></tfoot></table>";
				}
			return $bookList;
			}
		}

		?>

		</div>

	</body>

</html>