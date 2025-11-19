<?php

	// This page contains the connection routine for the
	// database as well as getting the ID of the cart, etc

	// Load database configuration
	require_once __DIR__ . '/../config.php';

	$dbServer = DB_SERVER;
	$dbUser = DB_USER;
	$dbPass = DB_PASS;
	$dbName = DB_NAME;

	function ConnectToDb($server, $user, $pass, $database)
	{
		// Connect to the database and return
		// true/false depending on whether or
		// not a connection could be made.

		//$s = mysqli_connect($server, $user, $pass);
		//$d = mysqli_select_db($database, $s);

		$s = mysqli_connect($dbServer,$dbUser,$dbPass) or die("Unable to connect to database" . mysqli_errno($con));
		$d = mysqli_select_db($s, "$dbName") or die("Unable to select database $DBName" . mysqli_errno($con));

		if(!$s || !$d)
			return false;
		else
			return true;
	}

	function GetCartId()
	{
		// This function will generate an encrypted string and
		// will set it as a cookie using set_cookie. This will
		// also be used as the cookieId field in the cart table

		if(isset($_COOKIE["cartId"]))
		{
			return $_COOKIE["cartId"];
		}
		else
		{
			// There is no cookie set. We will set the cookie
			// and return the value of the users session ID

			session_start();
			setcookie("cartId", session_id());
			return session_id();
		}
	}

?>
