<?php
require "custom_functions.php";

// get the inputs' data
$id = $_POST['id'];
$name = $_POST['name'];
$role = $_POST['role'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];


$validated_name;
$validated_password;

$success = null;
if (!empty($password)) {

    if ($password != $confirm_password) {
        echo "<script>alert('match the password and confirm password');</script>";
        enter_page("admin_account");
    }
    $validated_name = validate($name, "name");
    $validated_password = validate($password, "password");

    // update an account in database
    $success = update_account($id, $validated_name, $validated_password, $role);
} else {
    $validated_name = validate($name, "name");
    // update an account in database
    $success = update_account($id, $validated_name, null, $role);
}

session_start();
if (!$success) {
    echo "<script>alert('failed in database');</script>";
    if ($_SESSION['role'] == "admin") {
        enter_page("admin_account");
    }

    if ($_SESSION['role'] == "user") {
        enter_page("admin_edit");
    }
    exit();
}

success("update an account");
if ($_SESSION['role'] == "admin") {
    enter_page("admin_account");
}

if ($_SESSION['role'] == "user") {
    enter_page("admin_edit");
}



?>