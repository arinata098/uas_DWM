<?php
  session_start();
  
  if( !isset($_SESSION["login"])== true ) {
    header("Location: form_login.php");
    exit;
  }
?>



<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="style/style.css">

    <div style="text-align:center;">
        <div style="display: inline;">
            <h4 style="color: black; padding-top:3px; margin-right:4px; margin-left:4px; ">Hello <?php echo $_SESSION["name"]; ?> HAhaha </h4>
        </div>
        <div style="position: absolute; right: 5px; display:inline;">  
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </div>




<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-4 offset-sm-4">
            <a href="operational_data_source_harvest_type.php" class="btn btn-success btn-block">1. Operational Data Source Harvest Type</a>
        </div>
        <div class="col-xs-12 col-sm-4 offset-sm-4">
            <a href="operational_data_source_temperature.php" class="btn btn-success btn-block">2. Operational Data Source Temperature</a>
        </div>
        <div class="col-xs-12 col-sm-4 offset-sm-4">
            <a href="k_nearest_neightbor.php" class="btn btn-success btn-block">3. K Nearest Neighbor Algorithm</a>
        </div>
        <div class="col-xs-12 col-sm-4 offset-sm-4">
            <a href="Iklim.php" class="btn btn-success btn-block">4. Iklim</a>
        </div>
        <div class="col-xs-12 col-sm-4 offset-sm-4">
            <a href="https://www.bmkg.go.id/cuaca/prakiraan-cuaca-indonesia.bmkg" target="blank" class="btn btn-success btn-block">5. Perkiraan Cuaca di Indonesia</a>
        </div>
    </div>
</div>
