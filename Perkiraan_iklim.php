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
            <a href="https://www.bmkg.go.id/iklim/prakiraan-hujan-bulanan.bmkg" target="blank" class="btn btn-success btn-block">Prakiraan Hujan Bulanan</a>
        </div>
        <div class="col-xs-12 col-sm-4 offset-sm-4">
            <a href="https://www.bmkg.go.id/iklim/prakiraan-musim.bmkg" target="blank" class="btn btn-success btn-block">Prakiraan Musim Hujan</a>
        </div>
        <div class="col-xs-12 col-sm-4 offset-sm-4">
            <a href="https://www.bmkg.go.id/iklim/potensi-banjir.bmkg?p=prakiraan-daerah-potensi-banjir-bulan-januari-maret-2020&tag=&lang=ID" target="blank" class="btn btn-success btn-block">Prakiraan Daerah Potensi Banjir</a>
        </div>
        <div class="col-xs-12 col-sm-4 offset-sm-4">
            <a href="Iklim.php" class="btn btn-success btn-block">Back</a>
        </div>
    </div>
</div>
