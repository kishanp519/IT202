<?php
function getName() {
	if(isset($_GET['name'])) {
		echo "<p>Hello, " . $_GET['name'] . "</p>";
	}
}
?>
<html>
<head></head>
<body>
<?php getName();?>
<form mode="GET" action="#">
<input name="name" type="text" placeholder="Enter your name"/>
<input name="number" type="number" placeholder="Enter a number"/>
<input name="password" type="password" placeholder="Enter a FAKE password"/>
<label for="Yes">Yes</label>
<input type="radio" name="radio" id="Yes" value="Yes"/>
<label for="No">No</label>
<input type="radio" name="radio" id="No" value="Yes"/>

<select name="dropdown">
	<option value="1">One</option>
	<option value="2">Two</option>
	<option value="3">Three</option>
	<optionvalue="4">Four</option>

<input type="checkbox" name="check"/>
<textarea name="text"/></textarea>
<input type="date" name="date"/>
<input type="submit" value="Try it"/>
</form>
</body>
</html>
