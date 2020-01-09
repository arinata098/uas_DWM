<!doctype html>
<html>
    
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Project UTS</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">

</head>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark fixed-top" style="background-color: #0b326d;">
    <div class="container">
      <a class="navbar-brand" href="index.html"><img src="" height="38" width="75" alt="not working"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <!-- <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.html">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="contact.html">Contact</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="product.html">Product</a>
            </li>
        </ul> -->
      </div>
    </div>
  </nav>

<body style="background-image:url(img/body/4.png); background-repeat:no-repeat;
background-size:cover; background-attachment:fixed;" >

  <!-- jumbotron -->
  <div class="jumbotron jumbotron-fluid text-center" style="background-image: url('img/Unitice/glaicer.png'); background-size:cover; color: white;">
    <div class="container">
      <h1 class="display-4">Register Success  </h1>
    </div>
  </div>

  <!-- Page Content -->
  <div class="container mb-5 pt-2 px-3 pb-2" style="background-color:whitesmoke; border-radius: 15px;">

<?php
include "db_connection.php";

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$address = $_POST['address'];
$phone = $_POST['phone'];

$sql = "INSERT INTO account (name, username, email, password, address, phone)
    VALUES ('$name', '$username', '$email', '$password', '$address', '$phone')";

    if ($conn->query($sql) === TRUE) {
        echo "
        <div class='alert alert-primary' role='alert'>
        Your Account created successfully
        </div>
        ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>

<div class="row">
        <div class="offset-lg-11">
            <a class="btn" style="background-color:#0b326d; color:white;" href="form_login.php" >Login</a>
        </div>
    </div>    
  </div>
  <!-- /.container -->
<br>
<br>
  <!-- Footer -->
  <footer class="py-3" style="background-color: #0b326d">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; @ 2019</p>
    </div>
    <!-- /.container -->
  </footer>

</body>
</html>