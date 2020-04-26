<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<style type="text/css" media="screen">
	.error{ color: red; }
	</style>
</head>
<body>
	<h1>Login Results</h1>
<?php 

$okay = true;
// Validate the email address
if (empty($_POST['email'])) {
	print'<p class="error">Please enter your email address./</p>';
	$okay = false;
}
// Validate the password
if (empty($_POST['password'])) {
	print'<p class="error">Please enter your password./</p>';
	$okay = false;
}
//No errors, retrieve the data
if ($okay) {
	$email = $_POST['email'];
	// $password = $_POST['password'];
	// Connect to the database and insert the registration information
	// $dbc mysqli_connect('localhost','root','bmcc','csc','3307');
	require ('../mysqli_connect_csc.php');
	$query = "SELECT password FROM user WHERE email = '$email'";

	if ($r = @mysqli_query($dbc, $query)) {
		while ($row = mysqli_fetch_array($r)) {
			$current_password = $row['password'];
		}
		print '<p>Password retrieved successfully.</p>';
	}
	else {
		print '<p style = "color: red;">Could not retrieve email/password due to error:<br>' .mysqli_error($dbc) . '</p><p>The query being run was: ' . $query . '</p>';
	}
	mysqli_close($dbc); // close the connection
	if (password_verify($_POST['password'],$current_password)) {
		print '<p>Login successfully!</p>';
	}
	else{
		print '<p style = "color: red;">Incorrect password!</p>';
	}
}
?>
</body>
</html>