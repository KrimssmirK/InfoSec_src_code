<?php
function back($page)
{
    if ($page == "home") {
        echo "<script>window.location.href='index.php';</script>";
    }

    if ($page == "register") {
        echo "<script>window.location.href='ui_register.php';</script>";
    }

}

function success($str)
{
    echo "<script>alert('success to " . $str . "');</script>";
}



function validate($target_input, $type)
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

    switch ($type) {
        case "comment":
            return validate_comment($target_input);

        case "name":
            return validate_name($target_input);

        case "email":
            return validate_email($target_input);

        case "password":
            return validate_password($target_input);

        default:
            echo "error or nothing is implemented";
    }


}

function validate_password($password)
{
    // check if it is not empty
    if (strlen($password) == 0) {
        echo "<script>alert('password must be filled');</script>";
        back("register");
        exit();
    }

    // check it has length of more than 8
    if (strlen($password) < 8) {
        echo "<script>alert('password must be at least 8 characters');</script>";
        back("register");
        exit();
    }

    return $password;
}

function validate_email($email)
{
    // check if it is not empty
    if (strlen($email) == 0) {
        echo "<script>alert('email must be filled');</script>";
        back("register");
        exit();
    }

    // regex in php to match the pattern in HTML5
    $pattern = "/[^ -<>]@/";
    if (!preg_match($pattern, $email)) {
        echo "<script>alert('match the required pattern in email');</script>";
        back("register");
        exit();
    }

    return $email;
}

function validate_name($name)
{
    // check if it is not empty
    if (strlen($name) == 0) {
        echo "<script>alert('name must be filled');</script>";
        back("register");
        exit();
    }

    // regex in php to match the pattern in HTML5
    $pattern = "/[a-zA-Z ]+/";
    if (preg_match($pattern, $name) == 0) {
        echo "<script>alert('match the required pattern in name');</script>";
        back("register");
        exit();
    }

    return $name;
}

function validate_comment($comment)
{
    // check if it is not empty
    if (strlen($comment) == 0) {
        echo "<script>alert('comment must be filled');</script>";
        back("home");
        exit();
    }
    return filter_var($comment, FILTER_SANITIZE_SPECIAL_CHARS);

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
        back("home");

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
            print_comment(add_breakline($row[0]), $row[1]);
        }


    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}

function insert_account($name, $email, $password)
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


        $stmt_check_account = $conn->prepare("SELECT Email FROM $tbl_accounts WHERE Email = :EXIST_EMAIL");

        $stmt_check_account->bindParam(':EXIST_EMAIL', $EXIST_EMAIL);
        $EXIST_EMAIL = $email;

        $stmt_check_account->execute();

        // fetch rows one by one
        if ($row = $stmt_check_account->fetch()) {
            if ($row[0] == $email) {
                echo "<script>alert('email is already exist!');</script>";
                echo "<script>window.location.href='ui_register.php';</script>";
                exit();
            }

        }

        // prepare
        $stmt = $conn->prepare("INSERT INTO $tbl_accounts (Name, Email, Password, CreatedDate, ModifiedDate)
        VALUES (:Name, :Email, :Password, :CreatedDate, :ModifiedDate)");

        // bind
        $stmt->bindParam(':Name', $Name);
        $stmt->bindParam(':Email', $Email);
        $stmt->bindParam(':Password', $Password);
        $stmt->bindParam(':CreatedDate', $CreatedDate);
        $stmt->bindParam(':ModifiedDate', $ModifiedDate);


        // insert a row
        $Name = $name;
        $Email = $email;
        $Password = $password;

        // the date when the account is created
        $created_date = date('Y-m-j');

        $CreatedDate = $created_date;
        $ModifiedDate = $created_date;
        $stmt->execute();

        success("register");
        back("home");

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;
}
?>