<?php
		
	/* This is the first page after user successfully log into the system. This page display the
	current user, and all the items in the database. From here they can navigate to 
	perform other queries on the database. */
	
	session_start(); // start session
	include "connect.php"; //include connection settings for database
	include "code.php"; // include code has bunch of print statement
	error_reporting(0); //turn off the notice where someone access this page indirectly with out login
	
	$_SESSION['logged_in'] = false; // boolean for if anybody thats logged in
	$message = ''; // empty string
	
	//$loginPassword = $_POST['password'];
	$username = 'Jimmy'; // hardcoded user name value
	$password = 'magiseal'; // hardcoded password value
	
	$loginName = $_POST['username']; // post variable is set to $logingName variable
	$loginPassword = $_POST['password'];// post variable is set to $loginPassword variable
	
	//login process is false, if all the steps have succeeded, change it to true
	//the steps are logging in successfully and querying successfully
	$login = false;	
	$name = []; // array for name
	$type = []; // array for type
	$id = []; // array for ID
	$date = []; // array for purchase date
	$description = []; // array for description
?>

<html>
    <head>
        <meta charset='UTF-8'>
        <title>PHP - create</title>
		<link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
		
		<div id="status"> 
			<h2 id="status2"> STATUS</h2>
			<?php
				// if login credential matches
				if ($loginName === $username1 && $loginPassword === $password1){
					
					$_SESSION['currentUser'] = $_POST['username']; // set session current user to the user that just logged in
					$_SESSION['logged_in'] = true; //  some has logged into the session	
					echo "<p>Your login is correct.</p>"; // let user know their credential is accepted
					$_SESSION['currentUser'] = $loginName; // set session user to recently logged in user
					
					// sql SELECT command
					$command = "SELECT  ID, name, type, date, description FROM freezer ORDER BY ID ;";
					// sql prepare statement for queries, for security purpose
					$stmt = $dbh->prepare($command);
					$stmt->execute(); // execute the query
				
					while($row = $stmt->fetch()){
						array_push($id, $row['ID']); // store ID into this array		
						array_push($name, $row['name']); // store name into this array
						array_push($type, $row['type']); // store type into this array
						array_push($date, $row['date']); // store date into this array
						array_push($description, $row['description']);  // store description into this array
					} // end of while loop
							
					// result would be if the sql statement execute 
					$result = $stmt->execute();
					
					// if result returns true
					if($result){
					$message = 'query was successful'; // let user know their query was successful
					}else{
					$message = 'query failed'; // let user know their query failed
					} // end of if $result
					
					echo "<p>$message</p>"; // echo the result of the query 
					echo "<p id='current_user'>The current user is {$_SESSION['currentUser']}.</p>"; // display the current logged on user
					$login = true; // all the loggin process succeeded, change to true, final step is to display query
					// link goes to CRUD page, for manipulating database
					echo "<a href='freezer/form.php' id='click'>Click here to CRUD.</a>";
					// this describe what CRUD is. Create, Read, Update, Delete 
					echo "<p id='crud'>CRUD is Create, Read, Update, Delete.</p>";
							
				}else{					
					echo "<p>Your login is incorrect, please check and try again.</p>"; // notify login credential failed
					index(); // display login link  
				} // end of if credential matches
			?>
		</div>
		
		<div class="table">	
			<?php 
				// someone is logged in, display this set of html codes
				if($_SESSION['logged_in']){
					//display this set of html codes
					echo "
				
						
						<form class='form' action='freezer/insert.php' method='POST'>
						<h3>Create New Item </h3>
							<label class='update'>Name:</label> <input type='text' class='input' name='name' class='input'><br>
							<label class='update'>Type:</label> <input type='text'  class='input' name='type' class='input' value='NULL'><br>
							<!--<label class='update'>Purchase Date:</label> <input type='text' class='update' name='purchase_date'><br>-->
							<input type='submit' class='submit'>			
							
						</form>
				 
			
						<form class='formSmall' action='freezer/delete.php' method='POST'>
							<h3>Delete Item .</h3>
							<label class='update'>ID: </label> <input class='input' type='text' name='id'>
							<input type='submit'  id='submit2'>			
						</form>
				
			
					<div class='formTable'>
						<h3>Show freezer items</h3>
						<p>Here is what you have in your freezer.</p>
						<p>Click on the link below to sort the list to your likings</p>
						<a href='freezer/sort_by_name.php'><h2>Name</h2></a>
						<a href='freezer/sort_by_type.php'><h2>Type</h2></a>
						<a href='freezer/sort_by_date.php'><h2>Date</h2></a>
						<a href='freezer/form.php'><h2>ID</h2></a><br>
						<a href='freezer/form.php' id='crud2'><h2>CRUD</h2></a>
					</div>"; // end of echo statement
				} // end of if
			?>
		
			<table id="main_table">
				<tbody id="main_table2">					
					<tr><th class="theader"><b>ID<b/></th><th class="theader"><b>Name<b/></th><th class="theader"><b>Type</b></th><th class="theader"><b>Purchase Date<b/></th><th class="theader"><b>Description<b/></th></tr>					
					<?php
						// if login process was successful, display the wuery result in table format
						if($login == true){
							$arrlength = count($name); // count the last_name array length			
							for($x = 0; $x < $arrlength; $x++){
								// echoes out result in table format
								echo "<tr><td>$id[$x]</td> <td>$name[$x]</td> <td>$type[$x]</td> <td>$date[$x]</td><td>$description[$x]</td>" ;
								echo "<br>";
							} // end of for loop
						}else{
							echo "<p>You need to log back in to see whats inside.</p>"; // let user know they need to log in to see freezer content
						} // end of if
					?>		
				</tbody>
			</table>		
		</div>
		
		<?php
			// display the link if someone is logged on
			if($_SESSION['logged_in']){	
				echo "<a href='logout.php' id='logout'>click to logout.</a>"; // display logout page link
		    }
		?>	
		
    </body>
	
</html>
