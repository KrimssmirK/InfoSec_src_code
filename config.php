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

/**--------------------------
* VM database configuration
--------------------------*/
//  $servername = "localhost";
//  $username = "root";
//  $password = "";
//  $dbname = "infosec_sugino";

//  $tbl_accounts = "tblaccounts";
//  $tbl_comments = "tblcomments";

/* -----------------------------
* local database configuration
-----------------------------*/
$servername = "localhost";
$username = "mamp";
$password = "j)Hi/V)WFe*JVpDM";
$dbname = "InfoSec_Sugino";

$tbl_accounts = "tblAccounts";
$tbl_comments = "tblComments";



// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>