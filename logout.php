<?php

	/* This script logs out the current user and ends and destroy the session. */
	// start session
	session_start();
	// destroy session
	session_destroy();
	// let user know they have logged out
	echo "<h3>You have logged out.</h3>";
	// display the link to login page
	echo "<a href='index.html'>Click to log back in.</a>";
	

?>