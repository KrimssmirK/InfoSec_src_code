<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $email = $_POST['email'];
  $password = $_POST['password'];



}

include_once 'config.php';

$sql = "SELECT Email, Password FROM $tblaccounts WHERE Email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while ($row = mysqli_fetch_assoc($result)) {
    // success
    if ($row['Email'] == $email && $row['Password'] == $pswd) {
      header("Location: http://localhost:8888/ui_admin_dashboard.php");
      die();
    } else {
      echo 'Wrong username and password';
    }
  }
} else {
  echo "user does not exist";
}

mysqli_close($conn);
?>