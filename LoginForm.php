<?php
function getUsername() {
	if(isset($_POST['username'])) {
		echo "<p>Username: " . $_POST['username'] . "</p>";
	}
}
function getPassword() {
	if(isset($_POST['password'])) {
		echo "<p>Password: " . $_POST['password'] . "</p>";
	}
}
function confirmPassword() {
	if (strcmp($_POST['password'], $_POST['confirmPassword']) != 0)
                echo "Invalid Password. Please run the form again and retry.";
        else
                echo "Password is valid. The form will proceed.";
}
?>

<html>
<head></head>
<body>
<?php
getUsername();
getPassword();
confirmPassword(); 
?>
<form method="post" action ="LoginForm.php">
Username: <input name="username" type="text" placeholder="Enter your username"/>
Password: <input name="password" type="password" placeholder="Enter your password"/>
Confirm Password: <input name="confirmPassword" type ="password" placeholder="Please re-enter your password"/>
<input type="submit" value="Submit Login Information"/>
</form>
</body>
</html>
