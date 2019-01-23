<!DOCTYPE html>
<?php
	
	/* This script deletes the selected entries from the database, the entries comes from 
		form.php page. */
	include "../connect.php";
	include "../code.php";
	


	$id= filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
	$sql = "DELETE FROM spice WHERE ID={$id};";

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
	header('Location: ../pantry/form.php'); // redirect to CRUD page
	exit(); // exit script
	echo "<a href='form.php' id='click'>click to CRUD.</a>";


?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Delete Polls</title>
        <link rel="stylesheet" href="../style.css">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <div id="container">
		
			<?php
			
			/* echo "<p>$message</p>";
			echo "<p>you have deleted  id {$id}</p>"; */
			?>
			<a href="index.html">Go back</a>
			<a href="logout.php" id="click">click to logout.</a>
			<a href="freezer/form.php" id="freezer">Freezer</a>
			
        </div>
    </body>
</html>
