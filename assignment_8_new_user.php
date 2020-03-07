<!DOCTYPE HTML>
<html>

	<head>
		<title>New User</title>
		<link rel="stylesheet" type="text/css" href="css/login.css">
	</head>

<!--
/*****************************************
File: assignment_8_new_user.html
Student: Brady Peneton
Assignment: 8
****************************************/
-->
	<body>

		<div class="main" id="newuser">

			<h1>Add User/Password to User</h1>

			<h2>Add a User ID/Password to User List:</h2>

			<form id="newuser" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

				<div class="row"><label for="firstname">First Name:</label>

				<input type="text" name="firstname"></div>

				<div class="row"><label for="lastname">Last Name:</label>

				<input type="text" name="lastname"></div>

				<div class="row"><label for="id">User ID</label>

				<input type="text" name="id"></div>

				<div class="row"><label for="pass">Password</label>

				<input type="text" name="pass"></div>

				<input type="submit" value="Update">

			</form>

			<p><a href="assignment_8_login.php">Return to Login Page</a></p>

			<?php

			$idForm = $_POST['id'];
			$passForm = $_POST['pass'];
			$lastForm = $_POST['lastname'];
			$firstForm = $_POST['firstname'];

			if ($idForm != '' && $passForm != '') {
				if ($lastForm == '' || $firstForm == '') {
					print "Please enter a first and last name to register.";

				} else {
				
				$db = connectDatabase();
				$outputDisplay = insertUser($db, $idForm, $passForm, $lastForm, $firstForm);
				print $outputDisplay;

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

			function insertUser ($db, $id, $pass, $last, $first) {

				$statement = "INSERT INTO usertable ";
				$statement .= "VALUES ('".$id."', '".$pass."', '".$last."', '".$first."')";
				$result = mysqli_query($db, $statement);

				if ($result) {
					$outputDisplay = "<p>Added user with ID ".$id." successfully.</p>";
					return $outputDisplay;
				} else {
					$errno = mysqli_errno($db);

					if ($errno == '1062') {
						$outputdisplay = "<p style='color: red'>ERROR: That user ID (".$id.") is taken. Unable to register.</p>";
						return $outputdisplay;
					} else {
						$outputdisplay .= "<h4>MySQL No: ".mysqli_errno($db)."</h4>";
						$outputdisplay .= "<h4>MySQL Error: ".mysqli_error($db)."</h4>";
						$outputdisplay .= "<h4>SQL: ".$statement."</h4>";
						$outputdisplay .= "<h4>MySQL Affected Rows: ".mysqli_affected_rows($db)."</h4>";
					}
				}
			}
?>
		</div>

	</body>

</html>