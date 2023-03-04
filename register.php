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

// check the password and confirm_password if it is matched
if ($password != $confirm_password) {
  echo "<script>alert('match the password and confirm password');</script>";
  echo "<script>window.location.href='ui_register.php';</script>";
}

// validate
$validated_name = validate($name, "name");
$validated_email = validate($email, "email");
$validated_password = validate($password, "password");


// insert the new account to database
register_account($validated_name, $validated_email, $validated_password);



?>