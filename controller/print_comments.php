<?php

function print_comment($date, $message)
{
    /**
     * 1. change the date format 
     * 2. view the comments in home page with formatted date
     */


    // 1.
    $date_diff_format = date("d M Y", strtotime($date));


    // 2.
    echo '<tr>
    <td>' . $message . '</td>
    <td>' . $date_diff_format . '</td>
    </tr>';
}


// it is relative path
include_once 'config.php';


$sql = "SELECT Message, PostDate FROM $tbl_comments";
$result = mysqli_query($conn, $sql);

// if there is a data in tbl_comments
if (mysqli_num_rows($result) > 0) {
    // get each row in tbl_comments table
    while ($row = mysqli_fetch_assoc($result)) {
        print_comment($row['PostDate'], $row['Message']);
    }
}

mysqli_close($conn);
?>