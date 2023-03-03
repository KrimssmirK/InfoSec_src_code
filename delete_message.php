<?php
require "custom_functions.php";

// get the inputs' data
$id = $_POST['id'];


// delete the comment in database
delete_comment($id);

?>