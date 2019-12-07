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
<center> <font color="black"> <b> Medication Panel </b> </font> </center>
<font color="black"> <b> New Medication: </b> </font>
<br style = line-height:100px;>

<form method="post">
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

</body>
</html>
