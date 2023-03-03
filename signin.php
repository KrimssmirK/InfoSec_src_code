<?php

include_once 'custom_functions.php';

// get the inputs's value
$email = $_POST['email'];
$password = $_POST['password'];

// validate
$validated_email = validate($email, "email");
$validated_password = validate($password, "password");


// insert the data to database
login($validated_email, $validated_password);

// include_once 'config.php';

// $sql = "SELECT Email, Password FROM $tbl_accounts WHERE Email = '$email'";
// $result = mysqli_query($conn, $sql);

// if (mysqli_num_rows($result) > 0) {
//   // output data of each row
//   while ($row = mysqli_fetch_assoc($result)) {
//     // success
//     if ($row['Email'] == $email && $row['Password'] == $password) {
//       header("Location: http://localhost:8888/ui_admin_dashboard.php");
//       die();
//     } else {
//       echo 'Wrong username and password';
//     }
//   }
// } else {
//   echo "user does not exist";
// }

// mysqli_close($conn);
?>