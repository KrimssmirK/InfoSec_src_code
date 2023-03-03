<?php
function back()
{
    echo "<script>window.location.href='index.php';</script>";
}

function validate($target_input)
{

    /**----------------
     * INPUT VALIDATION
     * ----------------
     * 1. sanitize
     * 2. input checking
     * 3. feedback
     * 4. logging
     */


    /**-----------
     * Solution #1
     * -----------
     * 1 check each character in comment
     * 2 if the next character is ' then add \ before it
     * 3 return the sanitized comment
     */

    /**-----------
     * Solution #2
     * -----------
     * using php built-in function
     * 
     * addcslashes() function
     * returns a string with backslashes in front of the specified characters.
     */

    /**-----------
     * Solution #3
     * -----------
     * using php FILTERS
     * 
     */


    // $sanitized_comment = addcslashes($comment, "'");
    // $checked_comment = htmlentities($sanitized_comment);
    // return $checked_comment;


    if (strlen($target_input) == 0) {
        echo "<script>alert('comment must be filled');</script>";
        back();
        exit();
    }


    return filter_var($target_input, FILTER_SANITIZE_SPECIAL_CHARS);
}

function insert_data_to_database($conn, $sql)
{
    /**
     * need to apply SQL INJECTION PREVENTION
     */

    if (mysqli_query($conn, $sql)) {
        // success
        echo "<script>alert('success');</script>";
        back();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>