<?php
define("DB_HOST", "localhost");
define("DB_USER", "comp2910admin");
define("DB_PASSWORD", "123456");
define("DB_DATABASE", "comp2910");


function get_db_connection() {
	try {
		$conn = new PDO("mysql:host=".DB_HOST .";dbname=".DB_DATABASE, DB_USER, DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
}
?>
