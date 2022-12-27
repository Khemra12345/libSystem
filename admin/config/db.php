<?php 

	$servername = "localhost";
	$database = "libraryDB";
	$username = "root";
	$password = "";

	try{
		$conn = new PDO("mysql:host=$servername;dbname=$database",$username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		//echo "Conncetion successfully!";
	}
	catch(PDOException $e)
	{
		echo "Connection failed" . $e->getMessage();
	}

 ?>
 <?php
    // $username = 'root';
    // $password = '';
    // $connection = new PDO( 'mysql:host=localhost;dbname=library', $username, $password );
?>