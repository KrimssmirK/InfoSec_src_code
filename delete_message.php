<?php

$id = $_POST['id'];
include_once 'config.php';

$sql = "DELETE FROM $tbl_comments WHERE ID = $id";

if (mysqli_query($conn, $sql)) {
  // success
  header("Location: http://localhost:8888/ui_manage_comment.php");
  die();
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>