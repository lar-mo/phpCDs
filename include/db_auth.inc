<?php
// this is the db_auth.inc script for http://www.aretefilms.com/phpCDs/

// Load auth configuration
require_once __DIR__ . '/../config.php';

// Necessary Variables:

$LOGIN = AUTH_LOGIN;
$PASSWORD = AUTH_PASSWORD;

//	En: login /password

// End  Necessary Variables section
/******************************************************************************/

function error ($error_message) {
	echo $error_message."<BR>";
	exit;
}

if ( (!isset($_SERVER['PHP_AUTH_USER'])) || ! (($_SERVER['PHP_AUTH_USER'] == $LOGIN) && ( $PHP_AUTH_PW == "$PASSWORD" )) ) {
	header("WWW-Authenticate: Basic Realm=\"phpCDs database access\", stale=FALSE");
	header("HTTP/1.0 401 Unauthorized");
    	include "html_hdr.inc";
	include "body.inc";
	include "zarkobar.inc";
//	echo "<br>+++aaaaa+++<br>";
//	echo $_SERVER['PHP_AUTO_USER'];
//	echo "<br>+++bbbbb+++<br>";
//	echo $_SERVER['PHP_AUTH_PW'];
//	echo "<br>+++ccccc+++<br>";
//	echo $LOGIN;
//	echo "<br>+++ddddd+++<br>";
//	echo $PASSWORD;
	error("<p>There is a bug with PHP_AUTH_USER in the version (4.4.4) installed on this server.<br><br>Unauthorized access...You are free to browse but you must be authorized to add to the database.</body></html>");
}

?>
