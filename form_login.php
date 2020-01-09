<?php
  session_start();
  
  if( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">

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

<body >
  <!-- Page Content -->
  <div class="container mb-5 pt-2 pb-2" style="background-color:whitesmoke; border-radius: 15px; width:700px">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3" style="text-align: center " >Login Form
      <small></small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Please register if you don't have account... </li>
    </ol>

    <!-- Contact Form -->
    <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <!-- Bigining Contact Us -->
    <section id="ContactUs" class="ContactUs mb-5">
            <div class="container" style="width: 400px;">
                <div class="card card-login mx-auto mt-5">
                  <div class="card-header">Login</div>
                  <div class="card-body">
                    <form action="login.php" method="post">
                      <div class="form-group">
                        <div class="form-label-group">
                          <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-label-group">
                          <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="remember-me">
                            Remember Password
                          </label>
                        </div>
                      </div>
                      <div class="btn btn-primary btn-block">
                        <div class="form-label-group">
                          <button class="btn btn-primary btn-block">Login</button>
                        </div>
                      </div>
                    </form>
                    <div class="text-center">
                      <a class="d-block small mt-3" href="form_register.php">Register an Account</a>
                      <!-- <a class="d-block small" href="forgot-password.html">Forgot Password?</a> -->
                    </div>
                  </div>
                </div>
              </div>

        </div>
    </section>
    <!-- Ending Contact us -->
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <div>
    
  </div>

  <!-- Footer -->
  <footer class="py-3" style="background-color: #0b326d">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; @ 2019</p>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Contact form JavaScript -->
  <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

</body>

</html>
