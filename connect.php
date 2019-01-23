<?php
//	session_start();

	try {
		$dbh = new PDO("mysql:host=192.168.1.224;dbname=freezer", "Kobra", "magiseal");
		//echo "<p id='connected'>connected</p>";
	} catch (Exception $e) {
		echo "<p>fail to connect</p>";
		die('Could not connect to DB: ' . $e->getMessage());
	}
?>

