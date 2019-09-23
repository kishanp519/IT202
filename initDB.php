<?php
#turn error reporting on
ini_Set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('config.php');
echo $host;
$connection_string = "mysql:host=$host;dbname=$database;username=$username;password=$password;charset=utf8mb4";

try {
	$db = new PDO($connection_string, $username, $password);
	echo " - Database should have connected.";
         
       $query = "create table if not exists `TestUsers` (
						`id` int auto_increment not null, 
						`username` varchar(30) not null unique, 
						`pin` int default 0, 
						PRIMARY KEY (`id`)
						) CHARACTER SET utf8 COLLATE utf8_general_ci";
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$stmt = $db->prepare($query);
	$r = $stmt->execute();
	echo "<br>" . ($r>0?"Created table or already exists.":"Failed to create table.") . "<br>";
	unset($r);
	$insert_query = "INSERT INTO `TestUsers`(`username`, `pin`) VALUES (:username, :pin)";
	$stmt = $db->prepare($insert_query);
	$newUser = "Billy";
	$newPin = 1234;
	$r = $stmt->execute(array(":username"=> $newUser, ":pin"=> $newPin));

	print_r($stmt->errorInfo());

	echo "<br>" . ($r>0?"Insert successful":"Insert failed") . "<br>";

	$select_query = "select * from `TestUsers` where username = :username";
	$stmt = $db->prepare($select_query);
	$r = $stmt->execute(array(":username"=> "Billy"));
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
	echo "<pre>" . var_export($results, true) . "</pre>";

} catch (Exception $e) {
	echo $e->getMessage();
	exit(" - Database didn't connect.");
}
?>

