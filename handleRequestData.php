<?php
	echo "<pre>" . var_export($_GET, true) . "</pre>";
	if(isset($_GET['first'])) {
		echo "<br>First Name: " . $_GET['first'] . "<br>";
	}
	
	if(isset($_GET['last'])) {
		echo "<br>Last Name: " . $_GET['last'] . "<br>";
	}

	if(isset($_GET['age'])) {
		echo "<br>Age: " . $_GET['age'] . "<br>";
	
	  	if(is_numeric($_GET['age'])) {
			echo "<br>The value above is a valid number.<br>";
		} else {
			echo "<br>The value above is NOT a valid number.<br>";
		}
	}

	if(isset($_GET['section'])) {
		echo "<br>Class Section: " . $_GET['section'] . "<br>";

                if (is_numeric($_GET['section'])) {
                	echo "<br>The value above is a valid number.<br>";	
                } else {
                	echo "<br>The value above is NOT a valid number.<br>";
                }
	}
?>
