<!DOCTYPE html>
<!--
I Hung Dam, student 000736057, certify that all code submitted is my own work;
 that I have not copied from any other source. I also certify that I have not allowed my work to be copied by others. If in any instance that an external resource is used,
I will cite/and or give credit to the original author.
-->
<?php
	/* This script updates the item in database */
		
	session_start(); // start session
	include "../connect.php";
	include "../code.php";
    
	// sanitize number for item ID
	$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    // sanitize string for type
 	$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
    // sanitize string for description
	$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
	
    
    $sql = "UPDATE freezer SET  type = '{$type}', description = '{$description}'  WHERE ID = $id;";
	
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
	header('Location: http://192.168.1.224/freezer/form.php'); // redirect to CRUD page
	exit(); // exit script

?>

<html>
    <head>
        <meta charset='UTF-8'>
        <title>PHP - create</title>
    </head>
    <body>
        <?php

        ?>
		<a href="index.html">Go back</a
    </body>
</html>
