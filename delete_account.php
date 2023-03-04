<?php
require "custom_functions.php";

// get the inputs' data
$id = $_POST['id'];


// delete an account in database
delete_account_or_comment($id, "account");

?>