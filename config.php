<?php

/**
 * config flow
 * 1. connect to database
 * 2. if fails show the error message
 * 3. if not proceed with next operation
 * 
 * data
 *  - database info (servername, username, password, dbname)
 *  - table names (consistency)
 */


/*
These will be changed due to local configuration
*/

// database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "infosec_sugino";


// table names
$tblaccounts = "tblaccounts";
$tblcomments = "tblcomments";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>