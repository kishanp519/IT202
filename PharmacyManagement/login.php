<?php
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<html>
<head></head>
<body>
	<form method="POST"/>
		<input type="text" name="username"/>
		<input type="password" name="password"/>
		<input type="submit" value="Login"/>
	</form>
</body>
</html>
<?php
	if(isset($_POST['username']) && isset($_POST['password'])) {
		$user = $_POST['username'];
		$pass = $_POST['password'];

		try {
			require("config.php");
			$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
			$db = new PDO($conn_string, $username, $password);
			$stmt = $db->prepare("select id, username, password, pharmacy, role from `PharmacyUserData` where username = :username LIMIT 1");
			$stmt->execute(array(":username"=>$user));
			$results = $stmt->fetch(PDO::FETCH_ASSOC);

			if($results && count($results) > 0) {
				if(password_verify($pass, $results['password'])) {
					echo "Welcome, " . $results["username"] . " to your customized Pharmacy Management Panel.";
					echo "Your current role is " . $results["role"] . ".";
					echo "[" . $results["id"] . "]";
					
					$user = array("id"=> $results['id'],
								"name"=> $results['username']
								);

					$user += array("role"=> $results['role']);
					$user += array("pharmacy"=> $results['pharmacy']);

                                        $_SESSION['user'] = $user;
					echo var_export($user, true);
					echo var_export($_SESSION, true);
					header("Location: home.php");
 	 
				} else {
					echo "You have entered in invalid password.";
				}
			} else {
			    echo "The username you have entered is not valid. If you don't have an account yet, then please register.";
			}
		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}
?>

