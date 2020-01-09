<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="style/style.css">

<?php

require "db_connection.php";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.worldweatheronline.com/premium/v1/past-weather.ashx?tp=24&q=Tabanan&format=json&date=2019-10-01&enddate=2019-11-01&key=b81d0d49805c43bfa9c24734192911",
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

$sql_delete = 'DELETE FROM weather';
$conn->multi_query($sql_delete);


$sql = '';
foreach ($weather['data']['weather'] as $row) {
    $sql .= "INSERT INTO weather (date, temperature, humidity, location)
VALUES ('" . $row['date'] . "', '" . $row['maxtempC'] . "', '" . $row['hourly'][0]['humidity'] . "', '" . $weather['data']['request'][0]['query'] . "');";
}


if ($conn->multi_query($sql) === TRUE) {
    echo '

<div class="container">
    <div class="col-xs-12 col-sm-12">
        <div class="alert alert-success" role="alert">
          Berhasil mendapatkan data temperatur
        </div>
        <a href="./index.php" class="btn btn-primary">Kembali</a>
    </div>
    <div class="col-xs-12 col-sm-12">
        <br />
        <h3 align="center">Tabel Data Riwayat Temperatur</h3>
        <br />
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Temperatur</th>
                    <th>Kelembaban</th>
                    <th>Location</th>
                </tr>    
            </thead>
            <tbody>';
    ?>

    <?php
    $no = 1;
    foreach ($weather['data']['weather'] as $row) { ?>
        <tr>
            <td><?php echo $no++ ?>.</td>
            <td><?php echo $row['date'] ?></td>
            <td><?php echo $row['maxtempC'] ?> &#8451;</td>
            <td><?php echo $row['hourly'][0]['humidity'] ?></td>
            <td><?php echo $weather['data']['request'][0]['query'] ?></td>
        </tr>
    <?php } ?>
    <?php echo '
            </tbody>
        </table>
    </div>
</div>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
