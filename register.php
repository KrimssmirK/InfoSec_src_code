<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pswd = $_POST['pswd'];
  }
  
  // config
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
  $date = date('Y-m-j');
  $sql = "INSERT INTO tblAccounts (Name, Email, Password, CreatedDate, ModifiedDate) VALUES('$name', '$email', '$pswd', '$date', '$date')";
  
  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  
  mysqli_close($conn);
?>