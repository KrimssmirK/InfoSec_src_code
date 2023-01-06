<?php 
  /*
  These will be changed due to local configuration
  */
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
?>