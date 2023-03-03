<?php
function enter_page($page)
{
    if ($page == "home") {
        echo "<script>window.location.href='index.php';</script>";
    }

    if ($page == "register") {
        echo "<script>window.location.href='ui_register.php';</script>";
    }

    if ($page == "admin") {
        echo "<script>window.location.href='ui_admin_dashboard.php';</script>";
    }

    if ($page == "admin_comment") {
        echo "<script>window.location.href='ui_manage_comment.php';</script>";

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
        enter_page("register");
        exit();
    }

    // check it has length of more than 8
    if (strlen($password) < 8) {
        echo "<script>alert('password must be at least 8 characters');</script>";
        enter_page("register");
        exit();
    }

    return $password;
}

function validate_email($email)
{
    // check if it is not empty
    if (strlen($email) == 0) {
        echo "<script>alert('email must be filled');</script>";
        enter_page("register");
        exit();
    }

    // regex in php to match the pattern in HTML5
    $pattern = "/[^ -<>]@/";
    if (!preg_match($pattern, $email)) {
        echo "<script>alert('match the required pattern in email');</script>";
        enter_page("register");
        exit();
    }

    return $email;
}

function validate_name($name)
{
    // check if it is not empty
    if (strlen($name) == 0) {
        echo "<script>alert('name must be filled');</script>";
        enter_page("register");
        exit();
    }

    // regex in php to match the pattern in HTML5
    $pattern = "/[a-zA-Z ]+/";
    if (preg_match($pattern, $name) == 0) {
        echo "<script>alert('match the required pattern in name');</script>";
        enter_page("register");
        exit();
    }

    return $name;
}

function validate_comment($comment)
{
    // check if it is not empty
    if (strlen($comment) == 0) {
        echo "<script>alert('comment must be filled');</script>";
        enter_page("home");
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

    require 'config.php';
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
        enter_page("home");

    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
}

function print_comment_with_control($id, $comment, $created_date)
{
    $created_date_diff_format = date("d M Y", strtotime($created_date));
    echo '<tr>
                          <td>' . $id . '</td>
                          <td>' . $comment . '</td>
                          <td>' . $created_date_diff_format . '</td>
                          <td>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal-' . $id . '">Delete</button>
                          </td>
                        </tr>
                        <div class="modal" id="myModal-' . $id . '">
                          <div class="modal-dialog">
                            <div class="modal-content">

                        
                              <div class="modal-header">
                                <h4 class="modal-title">Confirmation</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>

                       
                              <div class="modal-body">
                                Sure you would like to delete?
                              </div>

                         
                              <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form action="delete_message.php" method="post">
                                  <input type="hidden" name="id" value="' . $id . '"/>
                                  <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                                </form>
                              </div>

                            </div>
                          </div>
                        </div>';

}

function print_comment($id, $comment, $date, $is_admin)
{
    if ($is_admin) {
        // do something in admin side
        print_comment_with_control($id, $comment, $date);
    } else {
        /**
         * 1. change the date format 
         * 2. view the comments in home page with formatted date
         */


        // 1.
        $date_diff_format = date("d M Y", strtotime($date));


        // 2.
        echo '<tr>
                <td>' . $comment . '</td>
                <td>' . $date_diff_format . '</td>
                </tr>';
    }

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

function retrieve_comments($is_admin = false)
{

    /**----------------------
     * PDO (PHP Data Objects)
     * ----------------------
     * using PDO for MySQL
     * to PREVENT SQL INJECTION!!
     */

    require 'config.php';
    try {
        // connect
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare
        $stmt = $conn->prepare("SELECT ID, Message, PostDate FROM $tbl_comments ORDER BY ID DESC");

        // execute
        $stmt->execute();

        // fetch rows one by one
        while ($row = $stmt->fetch()) {
            print_comment($row[0], add_breakline($row[1]), $row[2], $is_admin);
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

    require 'config.php';
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
        enter_page("home");

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;
}

function login($email, $password)
{
    require 'config.php';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare
        $stmt = $conn->prepare("SELECT Email, Password FROM $tbl_accounts WHERE Email = :EXIST_EMAIL");

        // bind
        $stmt->bindParam(':EXIST_EMAIL', $EXIST_EMAIL);

        // get the data
        $EXIST_EMAIL = $email;
        $stmt->execute();

        while ($row = $stmt->fetch()) {
            if ($row[1] == $password) {
                success("login");
                enter_page("admin");
            }
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;
}

function print_number($table)
{
    require 'config.php';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare
        $stmt;
        if ($table == "accounts") {
            $stmt = $conn->prepare("SELECT * FROM $tbl_accounts");
        }

        if ($table == "comments") {
            $stmt = $conn->prepare("SELECT * FROM $tbl_comments");

        }

        $stmt->execute();

        // while ($row = $stmt->fetch()) {
        //     if ($row[1] == $password) {
        //         success("login");
        //         enter_page("admin");
        //     }
        // }
        $result = $stmt->fetchAll();
        echo '<span class="fs-2 fw-bold">' . sizeof($result) . '</span>';

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;

}

function delete_comment($id)
{
    require 'config.php';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare
        $stmt = $conn->prepare("DELETE FROM $tbl_comments WHERE ID = :EXIST_ID");

        // bind
        $stmt->bindParam(":EXIST_ID", $EXIST_ID);

        //execute
        $EXIST_ID = $id;
        $stmt->execute();

        success("delete a comment");
        enter_page("admin_comment");

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;

}
?>