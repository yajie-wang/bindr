<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Registeration</title>
	<style type="text/css" media="screen">
	.error{ color: red; }
	</style>
</head>
<body>
	<h1>Registeration Results</h1>
<?php

$okay = true;
// Validate the email address
if (empty($_POST['email'])) {
	print'<p class="error">Please enter your email address./</p>';
	$okay = false;
}
// Validate the first name
if (empty($_POST['firstname'])) {
	print'<p class="error">Please enter your first name./</p>';
	$okay = false;
}
// Validate the last name
if (empty($_POST['lastname'])) {
	print'<p class="error">Please enter your last name./</p>';
	$okay = false;
}
// Validate the password
if (empty($_POST['password'])) {
	print'<p class="error">Please enter your password./</p>';
	$okay = false;
}
// Check the two passwords for equality
if ($_POST['password'] != $_POST['confirm']) {
	print'<p class="error">Your confirmed password does not match the original password./</p>';
	$okay = false;
}
// If there were no errors, print a success message:
if ($okay) {
	$email = $_POST['email'];
	$lastname = $_POST['lastname'];
	$firstname = $_POST['firstname'];
	$password = $_POST['password'];
	//save the hashed password
	//$hashedpw = password_hash($_POST['password'], PASSWORD_DEFAULT);
	// connect to the database and insert the registration information
	require ('../mysqli_connect_csc.php');
	$query = "INSERT INTO user (email, firstname, lastname, password, active_ind, date_entered)
	VALUES ('$email','$firstname','$lastname','$password','Y', NOW())";
	if (@mysqli_query($dbc, $query)) {
		print '<p>Registeration completed successfully.</p>';
	}
	else{
		print '<p style = "color: red;">Could not register due to error:<br>' . mysqli_error($dbc) . '.</p><p>The query bring run was: '. $query . '</p>';
	}
	mysqli_close($dbc); // close the connection
}

?>
</body>
</html>