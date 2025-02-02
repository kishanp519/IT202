<?php

function get_username() {
    if (isset($_SESSION['user']['name'])) {
        return $_SESSION['user']['name'];
    } else {
        return "[Session missing]";
    }
}

function get_user_id() {
    if (isset($_SESSION['user']['id'])) {
        return $_SESSION['user']['id'];
    } else {
        return -1;
    }
}

function get_pharmacy() {
    if (isset($_SESSION['user']['pharmacy'])) {
        return $_SESSION['user']['pharmacy'];
    } else {
        return -1;
    }
}

function get_role() {
    if (isset($_SESSION['user']['role'])) {
        return $_SESSION['user']['role'];
    } else {
        return -1;
    }
}

function isAdmin() {
    if (get_role() == "ADMIN") {
        return True;
    } else {
        return False;
    }
}

function setRole($selectedUser, $selectedRole) {  
  try {
        require("config.php");
        $conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
        $db          = new PDO($conn_string, $username, $password);
        $stmt        = $db->prepare("UPDATE `PharmacyUserData` SET `role` = :role WHERE `username` = '" . $selectedUser . "'");
        $result      = $stmt->execute(array(
            ":role" => $selectedRole
        ));

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function createPatient($first, $last, $age, $pharmacy) {
    try {
        require("config.php");
        $conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
        $db          = new PDO($conn_string, $username, $password);
        $stmt        = $db->prepare("INSERT into `PharmacyPatientData` (`firstName`, `lastName`, `age`, `pharmacy`) VALUES(:first, :last, :age, :pharmacy)");
        $result      = $stmt->execute(array(
            ":first" => $first,
            ":last" => $last,
            ":age" => $age,
            ":pharmacy" => $pharmacy
        ));
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function getPatient($id) {
    try {
        require("config.php");
        $conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
        $db          = new PDO($conn_string, $username, $password);
        $stmt        = $db->prepare("SELECT * FROM `PharmacyPatientData` WHERE `id` = :id");
        $result      = $stmt->execute(array(
            ":id" => $id
        ));
        
	return $stmt->fetch();
        
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return -1;
}

function createMedication($name, $strength, $daySupply) {
    try {
        require("config.php");
        $conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
        $db          = new PDO($conn_string, $username, $password);
        $stmt        = $db->prepare("INSERT into `PharmacyMedicationData` (`name`, `strength`, `daySupply`) VALUES(:name, :strength, :daySupply)");
        $result      = $stmt->execute(array(
            ":name" => $name,
            ":strength" => $strength,
            ":daySupply" => $daySupply
        ));
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function getMedication($id) {
    try {
        require("config.php");
        $conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
        $db          = new PDO($conn_string, $username, $password);
        $stmt        = $db->prepare("SELECT * FROM `PharmacyMedicationData` WHERE `id` = :id");
        $result      = $stmt->execute(array(
            ":id" => $id,
        ));

        return $stmt->fetch();
        
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return -1;
}

function createPrescription($patientID, $medicationID, $instructions) {
    try {
        require("config.php");
        $conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
        $db          = new PDO($conn_string, $username, $password);
        $stmt        = $db->prepare("INSERT into `PharmacyPrescriptionData` (`patientID`, `medicationID`, `instructions`) VALUES(:patientID, :medicationID, :instructions)");
        $result      = $stmt->execute(array(
            ":patientID" => $patientID,
            ":medicationID" => $medicationID,
            ":instructions" => $instructions
        ));
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function printPrescriptions($pharmacy) {
    try {
        require("config.php");
        $conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
        $db          = new PDO($conn_string, $username, $password);
        $stmt        = $db->prepare("SELECT * FROM `PharmacyPrescriptionData`");
	$stmt->execute();
        $result = $stmt->fetchAll();

//	echo var_export($stmt->errorInfo());
//	echo var_export($result);
	
	foreach($result as $index=>$row) {
 		$patientID = $row['patientID'];
		$medicationID = $row['medicationID'];
		$patient = getPatient($patientID);
		$medication = getMedication($medicationID);
		
		if ($patient['pharmacy'] == $pharmacy) {
			echo "Name: " . $patient['firstName'] . " " . $patient['lastName'] . ", Age: " . $patient['age'] . " <br>";
			echo "Medication Name: " . $medication['name'] . ", Strength: " . $medication['strength'] . ", Day Supply: " . $medication['daySupply'] . "<br>";
			echo "Instructions: " . $row['instructions'] . "<br> <br>";
		}
	}
      
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>
