<?php
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function getPharmacyUsers($pharmacy) {
	require("config.php");
	$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
	$db = new PDO($conn_string, $username, $password);
	$query = "SELECT username from PharmacyUserData WHERE pharmacy=:pharmacy";
	$stmt = $db->prepare($query);
	$stmt->bindValue(":pharmacy", $pharmacy);
	$r = $stmt->execute();
	return $stmt->fetchAll();
}

function getPharmacyPatients($pharmacy) {
	require("config.php");
	$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
	$db = new PDO($conn_string, $username, $password);
	$query = "SELECT * from PharmacyPatientData WHERE pharmacy=:pharmacy";
	$stmt = $db->prepare($query);
	$stmt->bindValue(":pharmacy", $pharmacy);
	$r = $stmt->execute();
	return $stmt->fetchAll();
}

function getMedications() {
	require("config.php");
	$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
	$db = new PDO($conn_string, $username, $password);
	$query = "SELECT * from PharmacyMedicationData";
	$stmt = $db->prepare($query);
	$r = $stmt->execute();
	return $stmt->fetchAll();
}
?>

<head>
<style>
.nav{padding:1%;}
</style>
</head>
<body>
<?php
include_once("functions.php");
?>

<section>
<center>

<title> Pharmacy Management Panel </title>

<b> <font color="black"> Pharmacy Management Panel </font> </b>
<br style = line-height:100px;>
</center>
</section>

<section>
<center>
<font color="black"> <b> Username: </b> <?php echo get_username();?>  </font>
<br style = line-height:100px;> 
<font color="black"> <b> Pharmacy: </b> <?php echo get_pharmacy();?>  </font>
<br style = line-height:100px;>
<font color="black"> <b> Role: </b> <?php echo get_role();?>  </font>
<br style = line-height:100px;>
<b> <hr> </b>
</center>
</section>

<section>
<center> <font color="black"> <b> Admin Panel </b> </font> </center>
<font color="black"> <b> Role Change: </b> </font>
<br style = line-height:100px;>
<font color="black"> Member: </font>

<?php
$items = getPharmacyUsers(get_pharmacy());
?>

<form method="POST">
<select name="selectedUser">
<?php foreach($items as $index=>$row):?>
	<option value="<?php echo $row['username'];?>">
		<?php echo $row['username'];?>
	</option>
<?php endforeach;?>
</select>
</section>	

<section>
<font color="black"> Role: </font>
<select name="selectedRole">
	<option value="ADMIN">ADMIN</option>
	<option value="PHARMACIST">PHARMACIST</option>
	<option value="TECHNICIAN">TECHNICIAN</option>
</select>

<input type="submit" value="Execute"/>

<?php
if (isset($_POST['selectedUser']) && isset($_POST['selectedRole'])) {
        $selectedUser = $_POST['selectedUser'];
	$selectedRole = $_POST['selectedRole'];
	if (isAdmin()) {
		setRole($selectedUser, $selectedRole);
		echo "You have set " . $selectedUser . "'s role to " . $selectedRole . ".";
     	} else {
        	echo "You are not allowed to perform this function without ADMIN role.";
     }
} 
?>
<b> <hr> </b>
</form>
</section>

<section>
<center> <font color="black"> <b> Patient Panel </b> </font> </center>
<font color="black"> <b> New Patient: </b> </font>
<br style = line-height:100px;>

<form method="POST">
	First Name:<input name="firstName" type="text" placeholder="Enter first name"/>
	Last Name:<input name="lastName" type="text" placeholder="Enter last name"/>
	Age:<input name="age" type ="number" placeholder="Enter age"/>
	<input type="submit" value="Execute"/>
</form>
<?php
if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['age'])) {
        $first = $_POST['firstName'];
	$last = $_POST['lastName'];
	$age = $_POST['age'];
	createPatient($first, $last, $age, get_pharmacy());
	echo "You have created a new patient with the inputted fields.";
} 
?>
<b> <hr> </b>
</section>

<section>
<center> <font color="black"> <b> Medication Panel </b> </font> </center>
<font color="black"> <b> New Medication: </b> </font>
<br style = line-height:100px;>

<form method="POST">
	Name:<input name="name" type="text" placeholder="Enter name"/>
	Strength:<input name="strength" type="text" placeholder="Enter strength"/>
	Day Supply:<input name="daySupply" type ="number" placeholder="Enter day supply"/>
	<input type="submit" value="Execute"/>
</form>
<?php
if (isset($_POST['name']) && isset($_POST['strength']) && isset($_POST['daySupply'])) {
        $name = $_POST['name'];
	$strength = $_POST['strength'];
	$daySupply = $_POST['daySupply'];
	createMedication($name, $strength, $daySupply);
	echo "You have created a new medication with the inputted fields.";
} 
?>
<b> <hr> </b>
</section>

<section>
<center> <font color="black"> <b> Prescription Panel </b> </font> </center>
<font color="black"> <b> New Prescription: </b> </font>
<br style = line-height:100px;>
<font color="black"> Choose a Patient: </font>

<?php
$patients = getPharmacyPatients(get_pharmacy());
$medications = getMedications();
?>

<form method="POST">

<select name="patientID">
<?php foreach($patients as $index=>$row):?>
	<option value="<?php echo $row['id'];?>">
		<?php echo "Name: " . $row['firstName'] . " " . $row['lastName'] . ", Age: " . $row['age'];?>
	</option>
<?php endforeach;?>
</select>

<br style = line-height:100px;>
<font color="black"> Choose a Medication: </font>

<select name="medicationID">
<?php foreach($medications as $index=>$row):?>
	<option value="<?php echo $row['id'];?>">
		<?php echo "Name: " . $row['name'] . ", Strength: " . $row['strength'] . ", Day Supply: " . $row['daySupply'];?>
	</option>
<?php endforeach;?>
</select>

<br style = line-height:100px;>
<font color="black"> Write Instructions: </font>
Name:<input name="instructions" type="text" placeholder="Enter instructions"/>
<input type="submit" value="Execute"/>
</form>
<?php
if (isset($_POST['patientID']) && isset($_POST['medicationID']) && isset($_POST['instructions'])) {
        $patientID = $_POST['patientID'];
	$medicationID = $_POST['medicationID'];
	$instructions = $_POST['instructions'];
	createPrescription($patientID, $medicationID, $instructions);
	echo "You have created a prescription for the patient with the provided medication.";
} 
?>
</section>	
<b> <hr> </b>


<section>
<center> <font color="black"> <b> Active Prescriptions Panel </b> </font> </center>
<br style = line-height:100px;>

<?php
$prescriptions = getPrescriptions();                                                                                                                                                    
foreach($prescriptions as $index=>$row) {
	$patient = getPatient($row['patientID']);
	$medication = getMedication($row['medicationID']);
	echo "Name: " . $patient['firstName'] . " " . $patient['lastName'] . " Age: " . $patient['age'] . "Med Name: " . $medication['name'];
}
?>
</section>




</body>
</html>
