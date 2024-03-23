<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Portfolio</title>
  <!-- Link to Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Custom CSS */
    /* Add your custom styles here */
    .project-card {
      margin-bottom: 20px;
    }
    .project-card img {
      max-height: 200px;
      object-fit: cover;
    }
    /* Apply the font to the text */
    #about {
      font-family: 'Roboto', sans-serif;
    }
    /* Set containers to fill width and height */
    html, body {
      height: 100%;
    }
    .container {
      min-height: 100%;
    }
    .contact-section {
      padding: 100px 0;
      background-color: #f8f9fa; /* Light gray background */
    }
    .contact-section h2 {
      color: #333; /* Dark text color */
    }
    .contact-section p {
      color: #666; /* Medium gray text color */
    }
    .contact-section .social-icons a {
      color: #333; /* Dark text color for icons */
      transition: color 0.3s ease-in-out; /* Smooth transition for icon color change */
    }
    .contact-section .social-icons a:hover {
      color: #007bff; /* Blue color on hover */
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">Jaylen</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#projects">Projects</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5" id="home">
  <div class="row align-items-center">
    <div class="col-md-3 text-center">
      <!-- Adjusting the size of the photo -->
      <img src="photo.gif" alt="Bryalla's Photo" class="img-fluid" style="max-width: 100%; height: auto;">
    </div>
    <div class="col-md-9">
      <div class="text-md-left text-center">
        <!-- Centering the content vertically -->
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
          <div>
            <h1 class="mt-5">Bryalla</h1>
            <p class="lead">Web Developer</p>
            <hr>
            <p class="text-muted">As a web developer, I am part artist, part technologist, crafting digital experiences that captivate and engage users across the vast landscape of the internet. With a blend of creativity and technical prowess, I bring websites and web applications to life, seamlessly blending form and function to deliver immersive online experiences.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="container mt-5" id="about">
    <div class="row">
        <div class="col-md-6">
            <img src="profile.png" alt="Profile Picture" class="img-fluid mb-4 border border-dark" style="max-width: 100%;">
        </div>

        <div class="col-md-6">
            <h1 class="mb-4">About Me</h1>
            <p class="lead">Hello I'm Jaylen Sumalinog Dumaboc , simple yet determined to push life in success with the help of God which is my anchor in everything. I love going back to where my roots began which is my hometown island OLUTANGA.</p>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Name:</strong> Jaylen Dumaboc</p>
                    <p><strong>Age:</strong> 30</p>
                    <p><strong>Address:</strong> 123 Main St, Cityville</p>
             
                    <p><strong>Phone number:</strong> 555-1234</p>
                    <p><strong>Email:</strong> jaylen@example.com</p>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container mt-5" id="projects">
    <h1 class="mb-4">My Projects</h1>
    <div class="row">
      <div class="col-md-4">
        <div class="card project-card">
          <img src="project1.jpg" class="card-img-top" alt="Project 1">
          <div class="card-body">
            <h5 class="card-title">Project Title 1</h5>
            <p class="card-text">Date: January 1, 2023</p>
            <!-- Add more project details here if needed -->
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card project-card">
          <img src="project2.jpg" class="card-img-top" alt="Project 2">
          <div class="card-body">
            <h5 class="card-title">Project Title 2</h5>
            <p class="card-text">Date: February 15, 2023</p>
            <!-- Add more project details here if needed -->
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card project-card">
          <img src="project3.jpg" class="card-img-top" alt="Project 3">
          <div class="card-body">
            <h5 class="card-title">Project Title 3</h5>
            <p class="card-text">Date: March 30, 2023</p>
            <!-- Add more project details here if needed -->
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card project-card">
          <img src="project3.jpg" class="card-img-top" alt="Project 3">
          <div class="card-body">
            <h5 class="card-title">Project Title 3</h5>
            <p class="card-text">Date: March 30, 2023</p>
            <!-- Add more project details here if needed -->
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card project-card">
          <img src="project3.jpg" class="card-img-top" alt="Project 3">
          <div class="card-body">
            <h5 class="card-title">Project Title 3</h5>
            <p class="card-text">Date: March 30, 2023</p>
            <!-- Add more project details here if needed -->
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card project-card">
          <img src="project3.jpg" class="card-img-top" alt="Project 3">
          <div class="card-body">
            <h5 class="card-title">Project Title 3</h5>
            <p class="card-text">Date: March 30, 2023</p>
            <!-- Add more project details here if needed -->
          </div>
        </div>
      </div>
    </div>
  </div>
   


  <section class="contact-section" id="contact">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 text-center">
        <h2 class="mb-4">Contact Us</h2>
        <p class="text-muted">Feel free to connect with us through our social media channels.</p>
      </div>
    </div>
    <div class="row justify-content-center social-icons">
      <div class="col-lg-6">
        <ul class="list-inline text-center">
          <li class="list-inline-item mr-4">
            <a href="https://www.facebook.com/example" target="_blank" class="text-decoration-none text-dark">
              <i class="fab fa-facebook fa-2x"></i>
            </a>
          </li>
          <li class="list-inline-item mr-4">
            <a href="https://twitter.com/example" target="_blank" class="text-decoration-none text-dark">
              <i class="fab fa-twitter fa-2x"></i>
            </a>
          </li>
          <li class="list-inline-item mr-4">
            <a href="https://www.instagram.com/example/" target="_blank" class="text-decoration-none text-dark">
              <i class="fab fa-instagram fa-2x"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="mailto:info@example.com" class="text-decoration-none text-dark">
              <i class="fas fa-envelope fa-2x"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Font Awesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
