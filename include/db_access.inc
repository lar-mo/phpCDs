<?php

/* declare some relevant variables */
/* must use $_REQUEST['foo']; to retrieve values passed thru URL */

// Load database configuration
require_once __DIR__ . '/../config.php';

$DBhost = DB_SERVER;
$DBuser = DB_USER;
$DBpass = DB_PASS;
$DBName = DB_NAME;
$table = "cds";

?>
