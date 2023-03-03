<?php include_once 'custom_functions.php'; ?>
<!DOCTYPE html> <!-- HTML5 -->
<html lang="en">

<head>
	<meta charset="utf-8">


	<!-- proper responsive behavior in mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<!-- Bootstrap5 -->
	<link rel="stylesheet" href="css/bootstrap.min.css">


	<title>BlogSite</title>

</head>

<body>

	<!-- 
	<header>, <nav> etc are semantically meaningful HTML5 tag elements
						that tells the browser its meaning and better for
						search engine
	-->
	<header>
		<nav>


			<div class="collapse bg-dark" id="navbarHeader">
				<div class="container">
					<div class="row">
						<div class="col-sm-8 col-md-7 py-4">
							<h4 class="text-white">About Course</h4>
							<p class="text-muted">
							<ul class="text-white">
								<li>Associate in Computer Technology</li>
								<li>BS Information Technology</li>
								<li>BS Computer Science</li>
								<li>Master In Information Technology</li>
								<li>Master Of Science In Computer Science</li>
								<li>Doctor Of Philosophy In Computer Science</li>
							</ul>
							</p>
						</div>
						<div class="col-sm-4 offset-md-1 py-4">
							<h4 class="text-white">Sites</h4>
							<ul class="list-unstyled">
								<li><a href="https://national-u.edu.ph/" class="text-white">Visit Official Website</a>
								</li>
								<li><a href="https://www.facebook.com/NationalUniversityPhilippines"
										class="text-white">Follow on Facebook - National U</a></li>
								<li><a href="https://www.facebook.com/groups/ccitofficial/" class="text-white">Follow on
										Facebook - NUCCIT</a></li>
							</ul>
						</div> <!-- end of col-sm-4 offset-md-1 py-4 -->
					</div> <!-- end of row -->
				</div> <!-- end of container -->
			</div> <!-- end of collapse bg-dark -->


			<div class="navbar navbar-dark bg-dark shadow-sm">
				<div class="container">
					<a href="#" class="navbar-brand d-flex align-items-center">
						<strong>NUCCIT Blog Site</strong>
					</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
						data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false"
						aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
				</div>
			</div>
		</nav>
	</header>


	<main>


		<section class="py-5 text-center container">
			<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img src="images/carousel1.jpg" class="d-block w-100" alt="...">
					</div>
					<div class="carousel-item">
						<img src="images/carousel2.jpg" class="d-block w-100" alt="...">
					</div>
				</div>
				<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
					data-bs-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
					data-bs-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Next</span>
				</button>
			</div>
		</section>


		<section class="py-2 bg-light">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<div class="card shadow-sm">
							<img src="images/INFOSEC.jpg" class="card-img-top" alt="...">
							<div class="card-body">
								<h1 class="display-5">What is information security?</h1>
								<figure>
									<blockquote class="blockquote">
										<p style="text-align: justify; text-justify: inter-word;">
											Information security, often shortened to infosec, is the practice, policies
											and principles to protect digital data and other kinds of information.
											infosec responsibilities include establishing a set of business processes
											that will protect information assets, regardless of how that information is
											formatted or whether it is in transit, is being processed or is at rest in
											storage.
											Generally, an organization applies information security to guard digital
											information as part of an overall cybersecurity program. infosec's three
											primary principles, called the CIA triad, are confidentiality, integrity and
											availability.
											In short, infosec is how you make sure your employees can get the data they
											need, while keeping anyone else from accessing it. It can also be associated
											with risk management and legal regulations.
										</p>
									</blockquote>
									<figcaption class="blockquote-footer">
										Someone famous in <cite title="Source Title">TechTarget</cite>
										<small class="text-muted"><a
												href="https://www.techtarget.com/searchsecurity/definition/information-security-infosec">Source</a></small>
									</figcaption>
								</figure>
							</div>
						</div>
					</div>


					<div class="col-md-4">

						<div class="row">
							<form action="signin.php" method="post" class="form-control" id="frmLogin"
								enctype="multipart/form-data" autocomplete="off">
								<input type="hidden" class="form-control" id="form_name" name="form_name"
									value="frmLogin">
								<h1 class="h3 mb-3 fw-normal">Please sign in</h1>
								<div class="mb-3">
									<label for="email" class="form-label">Email</label>
									<input type="email" class="form-control" id="email" name="email" required>
								</div>
								<div class="mb-3">
									<label for="password" class="form-label">Password</label>
									<input type="password" class="form-control" id="pass" name="password"
										autocomplete=new-password required>
									<!-- added not automatically set the password -->
								</div>
								<div class="d-grid gap-2">
									<button class="btn btn-lg btn-primary" type="submit">Sign in</button>
									<a type='button' class='btn btn-lg btn-info' href='ui_register.php'>Register
										Here</a>
								</div>
							</form>
						</div>


						<div class="row" style="margin-top: 5px;">
							<form action="postmessage.php" class="form-control" id="frmComments" name="frmComments"
								enctype="multipart/form-data" autocomplete="off">
								<h1 class="h3 mb-3 fw-normal">Post Comments</h1>
								<div class="mb-3">
									<textarea id="comment" name="comment" style="width:100%; height: 228px;"
										required></textarea>
								</div>
								<button class="btn btn-lg btn-primary" type="submit">Submit Post</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>


		<section class="py-5">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 class="h3 mb-3 fw-normal">Comments</h1>
						<table class="table table-striped table-responsive">
							<thead>
								<tr>
									<th scope="col">Message</th>
									<th scope="col">Post Date</th>
								</tr>
							</thead>
							<tbody>
								<?php retrieve_comments(); ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>


	</main>


</body>

</html>


<!-- no need to specify the text attribute in HTML5 e.g. type="text/javascript" -->
<script src="js/bootstrap.min.js"></script>