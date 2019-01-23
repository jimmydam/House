<!DOCTYPE html>
<!--
I Hung Dam, student 000736057, certify that all code submitted is my own work;
 that I have not copied from any other source. I also certify that I have not allowed my work to be copied by others. If in any instance that an external resource is used,
I will cite/and or give credit to the original author.
-->
<?php

	/* This script insert new entries into the database, the entries comes from the form.php page. */
	
	session_start();
	include "../connect.php";
	include "../code.php";
    
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $quantity = filter_input(INPUT_POST, "quantity", FILTER_SANITIZE_NUMBER_INT);
	$date = filter_input(INPUT_POST, "purchase_date", FILTER_SANITIZE_SPECIAL_CHARS);
    $pattern = "//";
	
	if(!empty($name)){
	
		// sql  command
		$sql = "INSERT INTO spice (name, date) VALUES ('{$name}', NOW());";
		// sql prepare statement for queries, for security purpose
		$stmt = $dbh->prepare($sql);
		// result would be if the sql statement execute 
		$result = $stmt->execute(); // execute the query
		
		// if result returns true
		if($result){
		$message = 'query was successful'; // let user know their query was successful
		}else{
		$message = 'query failed'; // let user know their query failed
		} // end of if $result
		
		echo "<p>$message</p>"; // echo out result of query
		header('Location: ../spice/form.php'); // redirect to CRUD page
		exit(); // exit script
	
	}
	
?>

<html>
    <head>
        <meta charset='UTF-8'>
        <title>PHP - create</title>
    </head>
    <body>
        <h2>There is an error with your input, please check that you have fill in at least the name and try again.<h2>
		<a href="form.php">Go back</a>
		<br>
		<a href="logout.php" id="logout">click to logout.</a>
    </body>
</html>
