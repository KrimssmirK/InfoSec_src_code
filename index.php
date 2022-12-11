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
    <div class="container mt-5">
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="./img/i1.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Breaking the scaling limits of analog computing</h5>
              <p>New technique could diminish errors that hamper the performance of super-fast analog optical neural networks.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="./img/i2.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>The task of magnetic classification suddenly looks easier</h5>
              <p>MIT undergraduate researchers Helena Merker, Harry Heiberger, and Linh Nguyen, and PhD student Tongtong Liu, exploit machine-learning techniques to determine the magnetic structure of materials.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="./img/i3.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Study urges caution when comparing neural networks to the brain</h5>
              <p>Computing systems that appear to generate brain-like activity may be the result of researchers guiding them to a specific outcome.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <div class="row mt-5">
        <div class="col-8">
          <div class="card"">
            <img src="./img/ml.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Recent Machine Learning Algorithms</h5>
              <p class="card-text">Different types of ML Algorithms that are used nowadays.</p>
              <a href="#" class="btn btn-primary">Explore</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="email@example.com">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="password">
          </div>
          <div class="d-grid gap-2">
            <button class="btn btn-primary" type="button">Sign In</button>
            <a href="./register.php" class="btn btn-outline-primary" type="button">Register</a>
          </div>
    
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Post Comment</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            <button type="button" class="btn btn-primary mt-2">Submit</button>
          </div>
        </div>
      </div>
      <h2>Comments</h2>      
  <table class="table table-borderless">
    <thead>
      <tr>
        <th>Message</th>
        <th>Post Date</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Cras justo odio. dapibus ac faciisis in. egestas eget quam.</td>
        <td>20 Jan 2016</td>
      </tr>
      <tr>
        <td>Cras justo odio. dapibus ac faciisis in. egestas eget quam.</td>
        <td>08 Feb 2011</td>
      </tr>
      <tr>
        <td>Cras justo odio. dapibus ac faciisis in. egestas eget quam.</td>
        <td>20 Jan 2016</td>
      </tr>
    </tbody>
  </table>
      <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation example  ">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
          </ul>
        </nav>
      </div>



      

    </div>
    

    

     

  </body>

  <!-- to be able to use the functionalities of Bootstrap -->
  <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous">
  </script>
</html>