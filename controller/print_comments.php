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

function add_breakline($comment)
{
    /**
     * this function add the comment a breakline to 101 index of it
     * to constraint the length to show in comment section in index.php
     */
    if (strlen($comment) > 100) {
        $comment = substr($comment, 0, 100) . "\n" . substr($comment, 101, strlen($comment));
    }
    return $comment;
}


// it is relative path
include_once 'config.php';


$sql = "SELECT Message, PostDate FROM $tbl_comments ORDER BY ID DESC";
$result = mysqli_query($conn, $sql);

// if there is a data in tbl_comments
if (mysqli_num_rows($result) > 0) {
    // get each row in tbl_comments table
    while ($row = mysqli_fetch_assoc($result)) {
        $retrieved_comment = add_breakline($row['Message']);
        print_comment($row['PostDate'], $retrieved_comment);
    }
}

mysqli_close($conn);
?>