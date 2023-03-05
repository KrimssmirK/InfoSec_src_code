<?php

require "custom_functions.php";


start_session();

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BlogSite</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dashboard.css">

  <script src="js/jquery-3.6.0.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
</head>

<body>
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="images/infosec.png" alt="Logo" width="120" height="24" />
      </a>
      <?php

      $name = retrieve_logged_in_name($_SESSION['id']);

      $hello_doc = <<<HELLO_DOC
        <span style="color: white;font-size: large;">$name</span>
      HELLO_DOC;

      echo $hello_doc;

      ?>
      <a class="btn btn-outline-success" href="logout.php">Logout</a>
    </div>
  </header>


  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3 sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="ui_admin_dashboard.php">
                <span data-feather="home" class="align-text-bottom"></span>
                Dashboard
              </a>
            </li>
          </ul>

          <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>
              <?php
              if ($_SESSION['role'] == "admin") {
                echo "DATA ADMINISTRATION";
              }

              if ($_SESSION['role'] == "user") {
                echo "USER";
              }
              ?>
            </span>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href=<?php
              if ($_SESSION['role'] == "admin") {
                echo "ui_manage_account.php";
              }

              if ($_SESSION['role'] == "user") {
                echo "ui_edit.php";
              }
              ?>>
                <span data-feather="users" class="align-text-bottom"></span>
                <?php
                if ($_SESSION['role'] == "admin") {
                  echo "Accounts Management";
                }

                if ($_SESSION['role'] == "user") {
                  echo "Edit Account";
                }
                ?>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="ui_manage_comment.php">
                <span data-feather="message-circle" class="align-text-bottom"></span>
                Posts Management
              </a>
            </li>
          </ul>
        </div>
      </nav>


      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Post Management</h1>
        </div>

        <table class="table table-borderless">
          <thead>
            <tr>
              <th>ID</th>
              <th>Message</th>
              <th>Post Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($_SESSION['role'] == "admin") {
              retrieve_comments($is_admin = true, $_SESSION['role']);
            }

            if ($_SESSION['role'] == "user") {
              retrieve_comments($is_admin = true, $_SESSION['role']);
            }

            ?>
          </tbody>
        </table>

      </main>
    </div>
  </div>

  <script src="js/dashboard.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/feather.min.js"></script>
  <script>
    feather.replace()
  </script>
</body>

</html>