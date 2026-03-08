<?php include_once("includes/header.php") ; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
  /* Make the image fully responsive */
  .carousel-inner img {
    width: 100%;
    /* height: 100%; */
  }
</style>
</head>
<body>
    
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="#">CDF BURSARY APPLICATION MANAGEMENT SYSTEM</a>
  
  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="admin/index.php">Admin Login</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="student/index.php">Student Login</a>
    </li>
  </ul>
</nav>

<div id="demo" class="carousel slide" data-ride="carousel">
  
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/1.jpg" alt="Los Angeles" width="1100" height="640">
    </div>
  </div>

</div>

</body>
</html>