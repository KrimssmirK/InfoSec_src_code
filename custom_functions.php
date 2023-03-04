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

    if ($page == "admin_account") {
        echo "<script>window.location.href='ui_manage_account.php';</script>";

    }

    if ($page == "admin_edit") {
        echo "<script>window.location.href='ui_edit.php';</script>";

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
        // enter_page("register");
        exit();
    }

    // check it has length of more than 8
    if (strlen($password) < 8) {
        echo "<script>alert('password must be at least 8 characters');</script>";
        // enter_page("register");
        exit();
    }

    return $password;
}

function validate_email($email)
{
    // check if it is not empty
    if (strlen($email) == 0) {
        echo "<script>alert('email must be filled');</script>";
        // enter_page("register");
        exit();
    }

    // regex in php to match the pattern in HTML5
    $pattern = "/[^ -<>]@/";
    if (!preg_match($pattern, $email)) {
        echo "<script>alert('match the required pattern in email');</script>";
        // enter_page("register");
        exit();
    }

    return $email;
}

function validate_name($name)
{
    // check if it is not empty
    if (strlen($name) == 0) {
        echo "<script>alert('name must be filled');</script>";
        // enter_page("register");
        exit();
    }

    // regex in php to match the pattern in HTML5
    $pattern = "/[a-zA-Z ]+/";
    if (preg_match($pattern, $name) == 0) {
        echo "<script>alert('match the required pattern in name');</script>";
        // enter_page("register");
        exit();
    }

    return $name;
}

function validate_comment($comment)
{
    // check if it is not empty
    if (strlen($comment) == 0) {
        echo "<script>alert('comment must be filled');</script>";
        // enter_page("home");
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

function print_account_with_control($id, $name, $created_date, $modified_date)
{
    $created_date_diff_format = date("d M Y", strtotime($created_date));
    $modified_date_diff_format = date("d M Y", strtotime($modified_date));

    echo '<tr>
    <td>' . $id . '</td>
    <td>' . $name . '</td>
    <td>' . $created_date_diff_format . '</td>
    <td>' . $modified_date_diff_format . '</td>
    <td>
      <form method="POST" action="ui_edit.php">
        <input type="hidden" name="id" value="' . $id . '" />
        <button type="submit" class="btn btn-primary">Edit</button>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal-' . $id . '">Delete</button>
      </form>
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
          <form action="delete_account.php" method="post">
            <input type="hidden" name="id" value="' . $id . '"/>
            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
          </form>
        </div>

      </div>
    </div>
  </div>';

}

function retrieve_account($id)
{

    /**----------------------
     * PDO (PHP Data Objects)
     * ----------------------
     * using PDO for MySQL
     * to PREVENT SQL INJECTION!!
     */

    require 'config.php';
    try {

        // prepare
        $stmt = $conn->prepare("SELECT Name, Email, Password FROM $tbl_accounts WHERE ID = :EXIST_ID");

        // bind
        $stmt->bindParam(":EXIST_ID", $EXIST_ID);

        // execute
        $EXIST_ID = $id;
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $name = $result['Name'];
        $email = $result['Email'];
        $password = $result['Password'];


    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;

    return array($name, $email, $password);
}

function retrieve_accounts()
{

    /**----------------------
     * PDO (PHP Data Objects)
     * ----------------------
     * using PDO for MySQL
     * to PREVENT SQL INJECTION!!
     */

    require 'config.php';
    try {

        // prepare
        $stmt = $conn->prepare("SELECT ID, Name, CreatedDate, ModifiedDate FROM $tbl_accounts");

        // execute
        $stmt->execute();

        // fetch rows one by one
        while ($row = $stmt->fetch()) {
            print_account_with_control($row[0], $row[1], $row[2], $row[3]);
        }


    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}


function register_account($name, $email, $password)
{
    /**
     * using this PDO statement
     * can prevent SQL INJECTION
     */

    require 'config.php';
    try {
        $stmt_check_account = $conn->prepare("SELECT Email FROM $tbl_accounts WHERE Email = :EXIST_EMAIL");

        $stmt_check_account->bindParam(':EXIST_EMAIL', $EXIST_EMAIL);
        $EXIST_EMAIL = $email;

        $stmt_check_account->execute();

        $result = $stmt_check_account->fetch(PDO::FETCH_ASSOC);

        $retrieved_email = $result['Email'];


        // if the email does not exist create an account
        if (!isset($retrieved_email)) {
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

            // password encryption using bcrypt
            // password_hash(target_variable, PASSWORD_DEFAULT)
            $Password = password_hash($password, PASSWORD_DEFAULT);

            // the date when the account is created
            $created_date = date('Y-m-j');

            $CreatedDate = $created_date;
            $ModifiedDate = $created_date;
            $stmt->execute();

            success("register");
            enter_page("home");
        } else {
            echo "<script>alert('email is already exist!');</script>";
            echo "<script>window.location.href='ui_register.php';</script>";
            exit();
        }





    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;
}

function update_account($id, $name, $password, $role)
{
    /**
     * using this PDO statement
     * can prevent SQL INJECTION
     */

    require 'config.php';
    try {

        if (!empty($password)) {
            // prepare
            $stmt_with_password = $conn->prepare("UPDATE $tbl_accounts SET Name = :Name, Password = :Password, Role = :Role, ModifiedDate = :ModifiedDate WHERE ID = :EXIST_ID");

            // bind
            $stmt_with_password->bindParam(':Name', $Name);
            $stmt_with_password->bindParam(':Password', $Password);
            $stmt_with_password->bindParam(':Role', $Role);
            $stmt_with_password->bindParam(':ModifiedDate', $ModifiedDate);
            $stmt_with_password->bindParam(':EXIST_ID', $EXIST_ID);

            // execute
            $Name = $name;
            $Password = password_hash($password, PASSWORD_DEFAULT);
            $Role = $role;
            $ModifiedDate = date('Y-m-j');
            $EXIST_ID = $id;
            $stmt_with_password->execute();

            session_start();
            unset($_SESSION['name']);
            unset($_SESSION['role']);
            $_SESSION['name'] = $name;
            $_SESSION['role'] = $role;


            success("update an account");
            enter_page("admin_account");

        } else {
            // prepare
            $stmt_without_password = $conn->prepare("UPDATE $tbl_accounts SET Name = :Name, Role = :Role ModifiedDate = :ModifiedDate WHERE ID = :EXIST_ID");

            // bind
            $stmt_without_password->bindParam(':Name', $Name);
            $stmt_without_password->bindParam(':Role', $Role);
            $stmt_without_password->bindParam(':ModifiedDate', $ModifiedDate);
            $stmt_without_password->bindParam(':EXIST_ID', $EXIST_ID);

            // execute
            $Name = $name;
            $Role = $role;
            $ModifiedDate = date('Y-m-j');
            $EXIST_ID = $id;
            $stmt_without_password->execute();

            session_start();
            unset($_SESSION['name']);
            unset($_SESSION['role']);
            $_SESSION['name'] = $name;
            $_SESSION['role'] = $role;

            success("update an account");
            enter_page("admin_account");
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;
}


function login($email, $password)
{


    require 'config.php';
    try {


        // prepare
        $stmt = $conn->prepare("SELECT Name, Email, Password, Role FROM $tbl_accounts WHERE Email = :EXIST_EMAIL");

        // bind
        $stmt->bindParam(':EXIST_EMAIL', $EXIST_EMAIL);

        // get the data
        $EXIST_EMAIL = $email;
        $stmt->execute();

        /**
         * flow for authentication in login
         * 1. get existing email  ..ok
         * 2. if none return response  ..ok
         * 3. if there is compare the password  ..ok
         * 4. if fails more than 3 save the account name with current time
         * 5. to login again, if the saved time in database is less than 10 min in current time
         */

        // 1.
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $retrieved_name = $result['Name'];
        $retrieved_email = $result['Email'];
        $retrieved_password = $result['Password'];
        $retrieved_role = $result['Role'];

        if (!isset($retrieved_email)) {
            return false;
        }

        if (password_verify($password, $retrieved_password)) {
            success("login");
            create_session($retrieved_name, $retrieved_role);
            enter_page("admin");
        } else {
            // save email and number of error in db
            // if the number of error is more than 3
            // save email and current time
            // set the number of error 3 to 0
            // return false (saying account is locked for 10min)
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

function delete_account_or_comment($id, $type)
{
    require 'config.php';
    try {

        // prepare
        $stmt;
        if ($type == "account") {
            $stmt = $conn->prepare("DELETE FROM $tbl_accounts WHERE ID = :EXIST_ID");
            // bind
            $stmt->bindParam(":EXIST_ID", $EXIST_ID);

            //execute
            $EXIST_ID = $id;
            $stmt->execute();

            success("delete an account");
            enter_page("admin_account");

        }

        if ($type == "comment") {
            $stmt = $conn->prepare("DELETE FROM $tbl_comments WHERE ID = :EXIST_ID");
            // bind
            $stmt->bindParam(":EXIST_ID", $EXIST_ID);

            //execute
            $EXIST_ID = $id;
            $stmt->execute();

            success("delete a comment");
            enter_page("admin_comment");
        }



    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;

}

function start_session()
{
    // this starts the session so that can retrieve the value in GLOBAL session
    session_start();

    if (!isset($_SESSION['name'])) {
        echo "<script>alert('you cannot enter this page');</script>";
        enter_page("home");
    }
}

function create_session($name, $role)
{
    session_start();
    $_SESSION['name'] = $name;
    $_SESSION['role'] = $role;
}


function stop_session()
{
    session_start();
    session_unset();
    session_destroy();
    enter_page("home");
}
?>