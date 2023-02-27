<?php
// this is the configuration about the database
include_once 'config.php';

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$pwd = $_POST['pswd'];
$newModifiedDate = date('Y-m-j');

$sql = "UPDATE $tblaccounts SET Name = '$name', Email = '$email', Password = '$pwd', ModifiedDate = '$newModifiedDate' WHERE ID = $id";

if (mysqli_query($conn, $sql)) {
  // success
  header("Location: http://localhost:8888/ui_manage_account.php");
  die();
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>