<?php
require 'custom_functions.php';

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
              <a class="nav-link active" aria-current="page" href="ui_admin_dashboard.php">
                <span data-feather="home" class="align-text-bottom"></span>
                Dashboard
              </a>
            </li>
          </ul>

          <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>DATA ADMINISTRATION</span>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="ui_manage_account.php">
                <span data-feather="users" class="align-text-bottom"></span>
                Accounts Management
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="ui_manage_comment.php">
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
          <h1 class="h2">Dashboard</h1>
        </div>


        <div class="card mb-4">
          <div class="card-body bg-warning">
            <div class="d-flex justify-content-between">
              <div>
                <?php print_number("accounts"); ?>

                <p class="card-text">User Registrations</p>
              </div>
              <span data-feather="user-plus" class="align-text-bottom w-auto h-auto"></span>
            </div>
          </div>
          <div class="card-footer text-center" style="background-color: #ba8c00">
            More Info
            <span data-feather="arrow-right-circle"></span>
          </div>
        </div>


        <div class="card">
          <div class="card-body bg-danger">
            <div class="d-flex justify-content-start">
              <span data-feather="message-circle" class="w-auto h-auto me-3"></span>
              <div>
                <p class="card-text text-light">Comments</p>
                <?php print_number("comments"); ?>
              </div>
            </div>

          </div>
        </div>
    </div>


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