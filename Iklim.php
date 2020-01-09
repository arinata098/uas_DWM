<?php
  session_start();
  
  if( !isset($_SESSION["login"])== true ) {
    header("Location: form_login.php");
    exit;
  }
?>

<h4 style="color: black; padding-top:3px; margin-right:4px; margin-left:4px; ">Hello <?php echo $_SESSION["name"]; ?> HAhaha </h4>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="style/style.css">

<a href="logout.php" class="btn btn-primary">Logout</a>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-4 offset-sm-4">
            <a href="Analisis_Iklim.php" class="btn btn-success btn-block">Analisi Iklim</a>
        </div>
        <div class="col-xs-12 col-sm-4 offset-sm-4">
            <a href="Perkiraan_iklim.php" class="btn btn-success btn-block">Perkiraan Iklim</a>
        </div>
        <div class="col-xs-12 col-sm-4 offset-sm-4">
            <a href="Informasi_Iklim.php" class="btn btn-success btn-block">Informasi Iklim</a>
        </div>
        <div class="col-xs-12 col-sm-4 offset-sm-4">
            <a href="Perubahan_Iklim.php" class="btn btn-success btn-block">Perubahan Iklim</a>
        </div>
        <div class="col-xs-12 col-sm-4 offset-sm-4">
            <a href="Index.php" class="btn btn-success btn-block">Back to Home</a>
        </div>
    </div>
</div>
