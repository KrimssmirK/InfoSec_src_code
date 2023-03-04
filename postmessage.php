<?php

// custom functions (self developed)
include_once 'custom_functions.php';


// get the inputs' data
$comment = $_GET['comment'];

// prepare the data
$validated_comment = validate($comment, "comment");
$created_date = date('Y-m-j');


// insert the data to database
session_start();
insert_comment($validated_comment, $_SESSION['id'], $created_date);
?>