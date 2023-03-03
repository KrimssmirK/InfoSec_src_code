<?php
include_once 'config.php';
include_once 'custom_functions.php';


// get the value input
$comment = $_GET['comment'];
$validated_comment = validate($comment);
$createdDate = date('Y-m-j');


$sql = "INSERT INTO $tbl_comments (Message, PostDate) VALUES('$validated_comment', '$createdDate')";


insert_data_to_database($conn, $sql);

?>