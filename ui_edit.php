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
      <a class="navbar-brand" href="#">
        <img src="images/infosec.png" alt="Logo" width="120" height="24" />
      </a>
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
          <h1 class="h2">Edit User Accounts</h1>
        </div>
        <?php



        // get the inputs's data
        $id = $_POST['id'];

        // get the data from database
        $data = retrieve_account($id);
        $name = $data[0];
        $email = $data[1];


        ?>
        <form action="save.php" method="post">
          <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" value="<?php echo validate($name, "name"); ?>" name="name"
              pattern="[a-zA-Z ]+" required>
          </div>
          <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" value="<?php echo validate($email, "email"); ?>"
              name="email" disabled>
            <div class="mb-3">
              <label for="pwd" class="form-label">New Password</label>
              <input type="password" class="form-control" id="pwd" name="password" minlength="8">
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <hr>
            <div class="d-flex justify-content-end">
              <a href="./ui_manage_account.php" type="submit" class="btn btn-secondary px-3 me-2">Cancel</a>
              <button type="submit" class="btn btn-primary px-3" id="create">Save</button>
            </div>
        </form>




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