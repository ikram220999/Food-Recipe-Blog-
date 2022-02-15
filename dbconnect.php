<?php

/**
	* Page function : Established connection to database (MySQLi Procedural)
	* Page description :
		- Accept all the requirements needed to make connection
		- Connect to the database using the database connection
		- Output message if database not exist
		- Check connection
		- Output message and reason if connection to database failed
*/
	$host = "localhost";
	$user = "root";
	$pass = "";
 
	$conn = mysqli_connect($host, $user, $pass);
	$db = mysqli_select_db($conn, "recipe")or die("Database Does not Exist."); // Connection to database using database name
 	
 	if($conn)
 	{
 		// Execute the code below if the connection successful
 		date_default_timezone_set('Asia/Kuala_Lumpur'); // Set local timezone
		$currentdate = new DateTime(date("Y-m-d")); // Set the date by using 'Year-month-day' format
	}
	else
	{
		// Output the message and reason the connection to database failed
		echo "Connection to Database Failed. " . mysqli_connect_error();
	}

?>