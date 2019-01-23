<!DOCTYPE html>
<!--
I Hung Dam, student 000736057, certify that all code submitted is my own work;
 that I have not copied from any other source. I also certify that I have not allowed my work to be copied by others. If in any instance that an external resource is used,
I will cite/and or give credit to the original author.
-->
<?php

	/* This script process search on the database, search by item name*/
	session_start(); // start session
	include "../connect.php"; //include connection settings for database
	include "../code.php"; // include code has bunch of print statement
	error_reporting(0); //turn off the notice where someone access this page indirectly with out login
	
	// variable from post item name to be searched
	$itemName= filter_input(INPUT_POST, 'item_name', FILTER_SANITIZE_SPECIAL_CHARS);	
  
?>

<html>

    <head>
        <meta charset='UTF-8'>
        <title>Name search</title>
		<link href="../style.css" rel="stylesheet" type="text/css">
    </head>
	
    <body>
		<div class='formTable3'>
				<h1 class='title'>Show freezer items</h1>
				<p>Here is what you have in your freezer.</p>
				<a href="form.php" id="clickSearch"><b>CRUD</b></a>
			
		
	
		<table class='formTable2'>
			<tbody>
				
				<tr><th class="theader"><b>ID<b/></th><th class="theader"><b>Name<b/></th><th class="theader"><b>Type</b></th><th class="theader"><b>Purchase Date<b/></th><th class="theader"><b> Description<b/></th></tr>
				
					<?php
						// if someone is logged in do this
						if(($_SESSION['logged_in'])){
							// query for anything containing in the POST variable
							$sql = "SELECT ID, name, type, date FROM pantry WHERE name LIKE '%{$_POST['item_name']}%';"; 
							// preparing the statement with the database
							$stmt = $dbh->query($sql);
							$result = $stmt->setFetchMode(PDO::FETCH_NUM); // retrieving query, this was taken from http://php.net/manual/en/pdostatement.setfetchmode.php
							// while loop to retrieve data from database
							
							while ($row = $stmt->fetch()) {
							// display the result in a table format
							echo "<tr><td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td> <td>$row[3]</td><td>$row[4]</td>" ;
							echo "<br>";
							} // end of while
							
						}else{
								echo "<p>login error!</p>";
						} // end of if
					?>
	
			</tbody>
		</table>
		<?php
				// if someone is logged in do this
				if(($_SESSION['logged_in'])){
						echo "
						<form id='formSmallDelete' action='delete.php' method='POST'>
							<h3>Delete Item .</h3>
							<label class='update'>ID: </label> <input class='input' type='text' name='id'>
							<input type='submit'  id='submitSearch'>			
						</form> 
						";
				}
			?>
			
		</div>	
		
		<a href="../logout.php" id="logoutSearch">Logout.</a>
    </body>
</html>
