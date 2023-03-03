<?php
include_once 'custom_functions.php';

/**
 * flow
 * 1. get the inputs' value
 * 2. validate the inputs' value
 * 3. insert to database
 */

// get the inputs' value
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

// validate
$validated_name = validate($name, "name");
$validated_email = validate($email, "email");





?>

$created_date = date('Y-m-j');
$sql = "INSERT INTO $tbl_accounts (Name, Email, Password, CreatedDate, ModifiedDate) VALUES('$name', '$email',
'$password', '$created_date', '$created_date')";