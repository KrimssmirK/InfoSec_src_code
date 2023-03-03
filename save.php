<?php
require "custom_functions.php";

// get the inputs' data
$id = $_POST['id'];
$name = $_POST['name'];
$password = $_POST['password'];

// validate
$validated_name = validate($name, "name");
$validated_password = validate($password, "password");

// update an account in database
update_account($id, $validated_name, $validated_password);
?>