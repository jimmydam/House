<?php
	
	
	
	
	$username1 = 'Jimmy';
	$password1 = 'magiseal';
	$username2 = 'Karen';
	$password2 = 'chicochico';
	
	
	function godMode(){
		echo "<p>{$_SESSION['currentUser']} superuser.</p>";
	}
	
	function crud(){
		echo "<a href='form.php' id='click'>click to CRUD.</a>";
	}

	
	function index(){
		echo "<a href='index.html' id='click'>click to log back in.</a>";
	}
	
	function main(){
		echo "<a href='main.php' id='click'>Main page.</a>";
	}


?>