<!DOCTYPE html>
<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function checkPasswords(){
	if(isset($_POST['password']) && isset($_POST['confirm'])){
		if($_POST['password'] == $_POST['confirm']){
			echo "<br>Passwords Matched!<br>";
		}
		else{
			echo "<br>Passwords didn't match!<br>";
		}
	}
}
?>
<html>
<head>
<script>
function validate(){
	var form = document.forms[0];
	var password = form.password.value;
	var conf = form.confirm.value;
	console.log(password);
	console.log(conf);
	let pv = document.getElementById("validation.password");
	let succeeded = true;
	if(password == conf){
		
		pv.style.display = "none";
		form.confirm.className= "noerror";	
	}
	else{
		pv.style.display = "block";
		pv.innerText = "Passwords don't match";
		//form.confirm.focus();
		form.confirm.className = "error";
		//form.confirm.style = "border: 1px solid red;";
		succeeded = false;
	}
	var email = form.email.value;
	var ev = document.getElementById("validation.email");
	//this won't show if type="email" since browser handles
	//better validation. Change to type="text" to test
	if(email.indexOf('@') > -1){
		ev.style.display = "none";
	}
	else{
		ev.style.display = "block";
		ev.innerText = "Please enter a valid email address";
		succeeded = false;
	}
	
	var dv = document.getElementById("validation.accounts");
	var sel = form.accounts;

	if (sel.selectedIndex == 0) {
		dv.style.display = "block";
		dv.innerText = "Please select a valid dropdown option";
		succeeded = false;
	}

	return succeeded;
}
</script>
<style>
input { border: 1px solid black; }
.error {border: 1px solid red;}
.noerror {border: 1px solid black;}
</style>
</head>
<body>
<div style="margin-left: 50%; margin-right:50%;">
<form method="POST" action="#" onsubmit="return validate();">
<input name="name" type="text" placeholder="Enter your name"/>

<input name="email" type="email" placeholder="name@example.com"/>
<span id="validation.email" style="display:none;"></span>

<input type="password" name="password" placeholder="Enter password"/>
<input type="password" name="confirm" placeholder="Re-Enter password"/>
<span style="display:none;" id="validation.password"></span>

<select name="accounts">
	<option value ="Select One">Select One</option>
	<option value="Savings">Savings</option>
	<option value="Checking">Checking</option>
	<option value="College Card">College Card</option>
	<option value="Rewards">Rewards</option>
</select>
<span id="validation.accounts" style="display:none;"></span>

<input type="submit" value="Submit"/>
</form>
</div>
</body>
</html>
<?php checkPasswords();?>
<?php
if(isset($_POST)){
	echo "<br><pre>" . var_export($_POST, true) . "</pre><br>";
}
?>
