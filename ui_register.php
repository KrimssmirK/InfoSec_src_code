<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <!-- Bootstrap v5.0 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- to support viewport for small devices such as phone, tablets and so on -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG</title>
  </head>
  <body>
  <header>
	  <div class="collapse bg-dark" id="navbarHeader">
	    <div class="container">
	      <div class="row">
	        <div class="col-sm-8 col-md-7 py-4">
	          <h4 class="text-white">About Course</h4>
	          <p class="text-muted">Include course description here...</p>
	        </div>
	        <div class="col-sm-4 offset-md-1 py-4">
	          <h4 class="text-white">Sites</h4>
	          <ul class="list-unstyled">
	            <li><a href="https://national-u.edu.ph/" class="text-white">Visit Official Website</a></li>
                <li><a href="https://www.facebook.com/NationalUniversityPhilippines" class="text-white">Follow on Facebook - National U</a></li>
	            <li><a href="https://www.facebook.com/groups/ccitofficial/" class="text-white">Follow on Facebook - NUCCIT</a></li>
	          </ul>
	        </div>
	      </div>
	    </div>
	  </div>
	  <div class="navbar navbar-dark bg-dark shadow-sm">
	    <div class="container">
	      <a href="#" class="navbar-brand d-flex align-items-center">
	        <strong>NUCCIT Blog Site</strong>
	      </a>
	      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="navbar-toggler-icon"></span>
	      </button>
	    </div>
	  </div>
	</header>

  <main>
    <div class="container mt-5 w-25 py-3 border rounded">
      <p>Account Registration</p>
      <hr>
      <form action="register.php" method="post">
        <div class="mb-3 mt-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
        </div>
        <div class="mb-3 mt-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" placeholder="email@example.com" name="email" required>
        <div class="mb-3">
          <label for="pwd" class="form-label">Password</label>
          <input type="password" class="form-control" id="pwd" placeholder="Password" name="pswd" required>
        </div>
        <div class="mb-3">
          <label for="cpwd" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="cpwd" placeholder="Confirm Password" name="cpswd" required onkeyup="validate_password()">
        </div>
        <span id="wrong_pass_alert"></span>
        <hr>
        <div class="d-flex justify-content-end">
          <a href="./index.php" type="submit" class="btn btn-secondary px-3 me-2">Close</a>
          <button type="submit" class="btn btn-primary px-3" id="create">Save</button>
        </div>
      </form>
    </div>
  </main>
  <script>
    function validate_password() {
      var pass = document.getElementById('pwd').value;
      var confirm_pass = document.getElementById('cpwd').value;
      if (pass != confirm_pass) {
        document.getElementById('wrong_pass_alert').style.color = 'red';
        document.getElementById('wrong_pass_alert').innerHTML = '☒ Use same password';
        document.getElementById('create').disabled = true;
        document.getElementById('create').style.opacity = (0.4);
      } else {
        document.getElementById('wrong_pass_alert').style.color = 'green';
        document.getElementById('wrong_pass_alert').innerHTML = '🗹 Password Matched';
        document.getElementById('create').disabled = false;
        document.getElementById('create').style.opacity = (1);
      }
    }
  </script>

    
  </body>

  <!-- to be able to use the functionalities of Bootstrap -->
  <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous">
  </script>
</html>

<?php

?>