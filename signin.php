<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $email = $_POST['email'];
    $pswd = $_POST['pass'];
  }

// config of database
$servername = "localhost";
$username = "mamp";
$password = "b(Sp7k6[wv+#EG5";
$dbname = "InfoSec_Sugino";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
  
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT Email, Password FROM tblAccounts WHERE Email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
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