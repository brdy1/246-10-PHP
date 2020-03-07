<!DOCTYPE html>
<html>
<head>
	<title>King Library - Thanks for Registering!</title>
	<link rel="stylesheet" type="text/css" href="css/basic.css">
</head>
<body>

<?php 
/*****************************************
File: assignment_1_add_patron.php
Student: Brady Peneton
Assignment: 1
****************************************/
?>

	<div id="logo">
	 	<img src="images/KingLibLogo.jpg" alt="King Real Estate Logo">
    </div>
    <div id="register">
	<?php

		//Initialize variables via php

		$firstname = $_POST['firstname'];

		$lastname = $_POST['lastname'];

		$fullname = $firstname.' '.$lastname;

		$email = $_POST['email'];

		$city = $_POST['city'];

	?>

	<h2>Thank you for registering!</h2>

		<!-- Print back data to user -->

	<p>
		Name: 
		<?php
		print "$fullname";
		?>
	</p>
	<p>
		Email: 
		<?php
		print "$email";
		?>
	</p>
	<p>
		City:
		<?php
		print "$city";
		?>
	</p>
</div>


</body>

</html>
