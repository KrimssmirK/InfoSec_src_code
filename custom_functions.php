<?php
function back()
{
    echo "<script>window.location.href='index.php';</script>";
}

function success($str)
{
    echo "<script>alert('success to " . $str . "');</script>";
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

function insert_comment($comment, $date)
{
    /**
     * using this PDO statement
     * can prevent SQL INJECTION
     */

    include_once 'config.php';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare
        $stmt = $conn->prepare("INSERT INTO $tbl_comments (Message, PostDate)
        VALUES (:Message, :PostDate)");

        // bind
        $stmt->bindParam(':Message', $Message);
        $stmt->bindParam(':PostDate', $PostDate);


        // insert a row
        $Message = $comment;
        $PostDate = $date;
        $stmt->execute();

        success("comment");
        back();

    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
}

function print_comment($message, $date)
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

function retrieve_comments()
{

    /**----------------------
     * PDO (PHP Data Objects)
     * ----------------------
     * using PDO for MySQL
     * to PREVENT SQL INJECTION!!
     */

    include 'config.php';
    try {
        // connect
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare
        $stmt = $conn->prepare("SELECT Message, PostDate FROM $tbl_comments ORDER BY ID DESC");

        // execute
        $stmt->execute();

        // fetch rows one by one
        while ($row = $stmt->fetch()) {
            print_comment($row[0], $row[1]);
        }


    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>