<?php
require "custom_functions.php";

// get the inputs' data
$id = $_POST['id'];


// delete an account in database
delete($id, "account");

?>