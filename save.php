<?php
require "custom_functions.php";

// get the inputs' data
$id = $_POST['id'];
$name = $_POST['name'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

$validated_name;
$validated_password;
if (isset($password)) {

    if ($password != $confirm_password) {
        echo "<script>alert('match the password and confirm password');</script>";
        enter_page("admin_account");
    }
    $validated_name = validate($name, "name");
    $validated_password = validate($password, "password");

    // update an account in database
    update_account($id, $validated_name, $validated_password);
} else {
    $validated_name = validate($name, "name");
    // update an account in database
    update_account($id, $validated_name, null);
}

?>