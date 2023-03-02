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
      <a class="btn btn-outline-success" href="index.php">Logout</a>
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
              <a class="nav-link active" href="ui_manage_account.php">
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
          <h1 class="h2">User Accounts Management</h1>
        </div>

        <table class="table table-borderless">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Created Date</th>
              <th>Modified Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include_once 'config.php';
            $sql = "SELECT ID, Name, CreatedDate, ModifiedDate FROM $tbl_accounts";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              // output data of each row
              while ($row = mysqli_fetch_assoc($result)) {
                $orgCreatedDate = $row['CreatedDate'];
                $newCreatedDate = date("d M Y", strtotime($orgCreatedDate));
                $orgModifiedDate = $row['ModifiedDate'];
                $newModifiedDate = date("d M Y", strtotime($orgModifiedDate));
                echo '<tr>
                          <td>' . $row['ID'] . '</td>
                          <td>' . $row['Name'] . '</td>
                          <td>' . $newCreatedDate . '</td>
                          <td>' . $newModifiedDate . '</td>
                          <td>
                            <form method="POST" action="edit.php">
                              <input type="hidden" name="id" value="' . $row['ID'] . '" />
                              <button type="submit" class="btn btn-primary">Edit</button>
                              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal-' . $row['ID'] . '">Delete</button>
                            </form>
                          </td>
                        </tr>
                        <div class="modal" id="myModal-' . $row['ID'] . '">
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
                                  <input type="hidden" name="id" value="' . $row['ID'] . '"/>
                                  <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                                </form>
                              </div>

                            </div>
                          </div>
                        </div>';
              }
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

<?php
mysqli_close($conn);
?>