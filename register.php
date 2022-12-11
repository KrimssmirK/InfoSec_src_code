<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <!-- Bootstrap v5.0 -->
    <link 
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
      rel="stylesheet" 
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
      crossorigin="anonymous"
    >

    <!-- to support viewport for small devices such as phone, tablets and so on -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG</title>
  </head>
  <body>
    <div class="container mt-5 w-25">
      <p>Account Registration</p>
          <form action="">
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Name" name="name">
        </div>
        <div class="mb-3 mt-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" placeholder="email@example.com" name="email">
        <div class="mb-3">
            <label for="pwd" class="form-label">Password</label>
            <input type="password" class="form-control" id="pwd" placeholder="Password" name="pswd">
        </div>
        <div class="mb-3">
          <label for="cpwd" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="cpwd" placeholder="Confirm Password" name="cpswd">
        </div>
        <div class="d-flex justify-content-end">
          <a href="./index.php" type="submit" class="btn btn-secondary px-3 me-2">Close</a>
          <button type="submit" class="btn btn-primary px-3">Save</button>
        </div>
        
      </form>

    

    </div>
  </body>

  <!-- to be able to use the functionalities of Bootstrap -->
  <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous">
  </script>
</html>