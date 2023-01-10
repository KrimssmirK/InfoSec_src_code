<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pswd = $_POST['pswd'];
  }
  
  include_once 'config.php';
  $date = date('Y-m-j');
  $sql = "INSERT INTO $tblaccounts (Name, Email, Password, CreatedDate, ModifiedDate) VALUES('$name', '$email', '$pswd', '$date', '$date')";
  
  if (mysqli_query($conn, $sql)) {
    // success
    header("Location: http://localhost:8888");
    die();
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  
  mysqli_close($conn);
?>