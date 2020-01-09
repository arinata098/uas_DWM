<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="style/style.css">

<?php

require "db_connection.php";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://www.mahendrawardana.com/harvest-type",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$weather = json_decode($response, TRUE);

$sql_delete = 'DELETE FROM harvest_type';
$conn->multi_query($sql_delete);


$sql_weather = 'SELECT * FROM weather';
$data_weather = $conn->query($sql_weather);

$sql = '';
foreach ($weather['data'] as $row) {
    $sql .= "INSERT INTO harvest_type (temperature_min, temperature_max, humidity_min, humidity_max, harvest_type)
VALUES ('" . $row['temperature_min'] . "', '" . $row['temperature_max'] . "', '" . $row['humidity_min'] . "', '" . $row['humidity_max'] . "', '" . $row['harvest_type'] . "');";
}

if ($conn->multi_query($sql) === TRUE) {
    echo '
<div class="container">
    <div class="col-xs-12 col-sm-12">
        <div class="alert alert-success" role="alert">
            Berhasil mendapatkan data tipe kondisi tanaman
        </div>
        <a href="./index.php" class="btn btn-primary">Kembali</a>
    </div>
    <div class="col-xs-12 col-sm-12">
        <br />
        <h3 align="center">Tabel Data Pengaruh Temperatur dan UV Index Kondisi Tanaman</h3>
        <br />
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Minimal Temperatur</th>
                    <th>Maximal Temperatur</th>
                    <th>Minimal Kelembaban</th>
                    <th>Maximal Kelembaban</th>
                    <th>Kondisi Tanaman</th>
                </tr>    
            </thead>
            <tbody>';
    ?>

    <?php
        $no = 1;
    foreach($weather['data'] as $row) { ?>
                <tr>
                    <td><?php echo $no++ ?>.</td>
                    <td><?php echo $row['temperature_min'] ?></td>
                    <td><?php echo $row['temperature_max'] ?></td>
                    <td><?php echo $row['humidity_min'] ?></td>
                    <td><?php echo $row['humidity_max'] ?></td>
                    <td><?php echo $row['harvest_type'] ?></td>
                </tr>
    <?php }
        echo '
            </tbody>
        </table>
    </div>
</div>
    ';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
