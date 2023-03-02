<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];


  // config module that has the configuration of database (mysql)
  include_once 'config.php';

  $created_date = date('Y-m-j');
  $sql = "INSERT INTO $tbl_accounts (Name, Email, Password, CreatedDate, ModifiedDate) VALUES('$name', '$email', '$password', '$created_date', '$created_date')";


  // open and connect to the database and make a query
  if (mysqli_query($conn, $sql)) {
    // success to make a query to the database

    // show the alert saying success to register
    echo '<script>';
    echo 'window.alert("success to register new account!")';
    echo '</script>';


    // redirect to home page
    echo '<script>window.location = "http://localhost:8888"</script>';

  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

/**
 * header() (bult-in)
 * i used this but it does not show the alert before this function and I do not why.
 */

mysqli_close($conn);
?>