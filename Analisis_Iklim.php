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
            <a href="https://www.bmkg.go.id/iklim/informasi-hujan-bulanan.bmkg?p=analisis-curah-hujan-dan-sifat-hujan-bulan-desember-2019&tag=&lang=ID" target="blank" class="btn btn-success btn-block">Analisis Curah Hujan</a>
        </div>
        <div class="col-xs-12 col-sm-4 offset-sm-4">
            <a href="https://www.bmkg.go.id/iklim/ketersediaan-air-tanah.bmkg?p=tingkat-ketersediaan-air-bagi-tanaman-desember-2019&tag=&lang=ID" target="blank" class="btn btn-success btn-block">Tingkat Ketersediaan Air Bagi Tanaman</a>
        </div>
        <div class="col-xs-12 col-sm-4 offset-sm-4">
            <a href="https://www.bmkg.go.id/iklim/indeks-presipitasi-terstandarisasi.bmkg" target="blank" class="btn btn-success btn-block">Indeks Presipitasi Terstandarisasi</a>
        </div>
        <div class="col-xs-12 col-sm-4 offset-sm-4">
            <a href="Iklim.php" class="btn btn-success btn-block">Back</a>
        </div>
    </div>
</div>
