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
$dbname = "InfoSec_Sugino";
$username = "mamp";
$password = "j)Hi/V)WFe*JVpDM";


$tbl_accounts = "tblAccounts";
$tbl_comments = "tblComments";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


?>