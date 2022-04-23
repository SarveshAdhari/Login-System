<?php

	// Connecting to database
	$server = "localhost";
	$username = "root";
	$password = "";
	$database = "users";

	$conn = mysqli_connect($server,$username,$password,$database);
	if(!$conn){
		die("Could not connect to the database. Please try again later.");
	}

?>