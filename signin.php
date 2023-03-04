<?php

include_once 'custom_functions.php';

// get the inputs's value
$email = $_POST['email'];
$password = $_POST['password'];

// validate
$validated_email = validate($email, "email");
$validated_password = validate($password, "password");


// insert the data to database and if fails alert invalid and return to home page
if (!login($validated_email, $validated_password)) {
    echo "<script>alert('INVALID');</script>";
    enter_page("home");
}

?>