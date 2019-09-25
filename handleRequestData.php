<?php
	echo "<pre>" . var_dump($_GET, true) . "</pre>";
	
	if(isset($_GET['name'])) {
		echo "<br>Name:" . $_GET['name'] . "<br>";
	}

	if(isset($_GET['age'])) {
		echo "<br>Age: " . $_GET['age'] . "<br>";
	}
?>
