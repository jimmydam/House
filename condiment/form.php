
 
<?php
	/*  I Hung Dam, student 000736057, certify that all code submitted is my own work;
	 that I have not copied from any other source. I also certify that I have not allowed
	 my work to be copied by others. If in any instance that an external resource is used, 
	 I will cite/and or give credit to the original author.
	 */
	
	/* This is the CRUD page, the user can create, read, update, and delete entries in the database. */
	
	session_start(); // start session
	include "../connect.php";
	include "../code.php";
	error_reporting(0); //turn off the notice where someone access this page indirectly with out login
	
	$name = []; // array for name
	//$type = []; // array for type
	$id = []; // array for ID
	$date = []; // array for purchase date
	$remaining = []; // array for description
	
	// if no user logged on
	if(!empty($_SESSION['currrentUser'])){
		printError(); // print no user error
	}else{
		
		// sql SELECT command
		$command = "SELECT  ID, name, date, remaining FROM condiment ORDER BY ID DESC;";
		// sql prepare statement for queries, for security purpose
		$stmt = $dbh->prepare($command);
		$stmt->execute(); // execute the query

		while($row = $stmt->fetch()){
			array_push($id, $row['ID']); // store ID into this array		
			array_push($name, $row['name']); // store name into this array
			//array_push($type, $row['type']); // store type into this array
			array_push($date, $row['date']); // store date into this array
			array_push($remaining, $row['remaining']); // store description into this array
		} // end of while	
	} // end of if	
?>

<!DOCTYPE html>
<!--
 I Hung Dam, student 000736057, certify that all code submitted is my own work;
 that I have not copied from any other source. I also certify that I have not allowed
 my work to be copied by others. If in any instance that an external resource is used, 
 I will cite/and or give credit to the original author.
-->
<html>
    <head>
        <title>Form</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
		<link href="../style.css" rel="stylesheet" type="text/css">
    </head> 
	
    <body>
		<div id="status"> 
		<h3> CONDIMENT</h3>
		<a href="../freezer/form.php" id="freezer">Freezer</a>
		<a href="../pantry/form.php" id="pantry">Pantry</a>
		<a href="../spice/form.php" id="spice">Spice</a>
		<a href="../condiment/form.php" id="condiment">Condiment</a>
		<a href="../utility/form.php" id="utility">Utility</a>
		<a href="../logout.php" id="logout">Logout.</a>
			<?php
				if(!empty($_SESSION['currrentUser'])){
					echo "<p>login error!</p>";
				}else{
					echo "<p id='current_user'>the current user is {$_SESSION['currentUser']}</p>";
				};
			?>
		</div>
		
		
		<?php 
			// if user is logged on
			if($_SESSION['logged_in']){
				
				// display this set of html code
				echo "
				
					
					<form class='form' action='insert.php' method='POST'>
						<h3>Create New Item</h3>
						<label class='update'>Name:</label> <input type='text' class='input' name='name'><br>
						<label class='update'>Quantity:</label> <input type='text'  class='input' name='quantity' value='1'><br>
						<!--<label class='update'>Purchase Date:</label> <input type='text' class='input' name='purchase_date'><br>-->
						<input type='submit' id='submit'>			
						
					</form>
				
			
				<form class='form' action='update.php' method='POST'>
					<h3>Update Item </h3>
					<label class='update'>ID:</label> <input class='input' type='text' name='id'><br>
					<label class='update'>Type:</label> <input class='input' value='NULL' type='text' name='type'><br>
					<!--<label class='update'>Description: </label> <input class='input' value='NULL' type='text' name='description'><br>-->

					<input type='submit' id='submit2'>			
				
				</form>
			
		

			
				
				<form class='formSmall' action='delete.php' method='POST'>
					<h3>Delete Item .</h3>
					<label class='update'>ID: </label> <input class='input' type='text' name='id'>
					<input type='submit'  id='submit3'>			
				</form>
			
			
			
			
				<form class='formSmall' action='search.php' method='POST'>
						<h3>Search By Name</h3>
					<label class='update'>Item Name: </label> <input class='input' type='text' name='item_name'>
					<input type='submit'  id='submit3'>			
				</form>
			
			
				
				<form class='formSmall' action='search_type.php' method='POST'>
					<h3>Search By Type.</h3>
					<label class='update'>Type: </label> <input class='input' type='text' name='type_name'>
					<input type='submit'  id='submit3'>			
				</form>
			";
			}
			?>
			

			
			<div id='formLinks'>
				<h3 id="a7">Show freezer items</h3>
			
				<p id="a6">Click on the link below to sort the list to your likings</p>
				
			
				<a id="a1" href="sort_by_name.php"><h2>Name</h2></a>
				<a id="a2" href="sort_by_type.php"><h2>Type</h2></a>
				<a id="a3" href="sort_by_date.php"><h2>Date</h2></a>
				<a id="a4" href="form.php"><h2>ID</h2></a>
				<a id="a5" href="form.php" ><h2>CRUD</h2></a>
				
			</div>	
			<table>
				<tbody>					
					<tr><th class="theader"><b>ID<b/></th><th class="theader"><b>Name<b/></th><th class="theader"><b>Purchase Date<b/></th><th class="theader"><b> Remaining<b/></th></tr>					
					<?php
							// if user is logged on
							if(($_SESSION['logged_in'])){
							
								$arrlength = count($name); // count the last_name array length			
								for($x = 0; $x < $arrlength; $x++){
									// echoes out result in table format
									echo "<tr><td>$id[$x]</td> <td>$name[$x]</td>  <td>$date[$x]</td><td>$remaining[$x]</td>" ;
									echo "<br>";
								}
							}
					?>		
				</tbody>
			</table>		
		</div>
	</body>	
</html>
