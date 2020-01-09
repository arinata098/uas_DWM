<?php

/**
 * 1. Require Connection Database
 */
require "db_connection.php";


$get_date = !empty($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$get_temperature = !empty($_GET['temperature']) ? $_GET['temperature'] : 0;
$get_humidity = !empty($_GET['humidity']) ? $_GET['humidity'] : 0;
$get_jumlah_tetangga = !empty($_GET['jumlah_tetangga']) ? $_GET['jumlah_tetangga'] : 0;


/**
 * 2. Delete data table process terlebih dahulu
 */
$sql_process_delete = 'DELETE FROM process';
$conn->query($sql_process_delete);

/**
 * 3. Ambil semua data table weather
 */
$sql_weather = 'SELECT * FROM weather';
$data_weather = $conn->query($sql_weather);
$data_table = array();
$no = 1;
while ($row = $data_weather->fetch_assoc()) {

    $date = $row['date'];
    $temperature = $row['temperature'];
    $humidity = $row['humidity'];

    /**
     * 5. Perhitungan Euclidean Distance
     */
    $euclidean_distance = sqrt(pow(($temperature - $get_temperature), 2) + pow(($humidity - $get_humidity), 2));

    /**
     * 6. Ambil row data untuk menentukan kondisi tanaman
     */
    $sql_data_harvest_type = "SELECT * FROM harvest_type WHERE '" . $temperature . "' BETWEEN temperature_min AND temperature_max AND '" . $humidity . "' BETWEEN humidity_min AND humidity_max";
    $data_harvest_type = $conn->query($sql_data_harvest_type);
    $row_data = $data_harvest_type->fetch_array();

    $data_table[$no] = array(
        'date' => $date,
        'temperature' => $temperature,
        'humidity' => $humidity,
        'harvest_type' => $row_data['harvest_type'],
        'euclidience_distance' => $euclidean_distance
    );

    $no++;

    /**
     * 7. Insert data to table process
     */
    $sql_process = "INSERT INTO process (date, temperature, humidity, euclidience_distance, harvest_type)
VALUES ('" . $date . "', '" . $temperature . "', '" . $humidity . "', '" . $euclidean_distance . "', '" . $row_data['harvest_type'] . "');";
    $conn->query($sql_process);
}


/**
 * 8. Mengurutkan ecludience distance untuk mengambil urutan jarak
 * dengan alur, memperbarui data
 */
$sql_process = 'SELECT * FROM process ORDER BY euclidience_distance ASC';
$data_process = $conn->query($sql_process);
$no = 1;
while ($row = $data_process->fetch_assoc()) {

    $sql_process_update = "UPDATE process SET urutan_jarak='" . $no . "' WHERE process_id=" . $row['process_id'];
    $conn->query($sql_process_update);
    $no++;
}

/**
 * 9. Process apakah termasuk KNN ?
 */

$sql_process = 'SELECT * FROM process ORDER BY euclidience_distance ASC';
$data_process = $conn->query($sql_process);
while ($row = $data_process->fetch_assoc()) {
    $include_knn = $row['urutan_jarak'] <= $get_jumlah_tetangga ? 'Ya' : 'Tidak';
    $sql_process_update = "UPDATE process SET include_knn='" . $include_knn . "' WHERE process_id=" . $row['process_id'];
    $conn->query($sql_process_update);
}

/**
 * 10. Mencari nilai selanjutnya
 */

$sql_hasil = "SELECT COUNT(DISTINCT harvest_type) AS total_beda FROM process WHERE include_knn = 'Ya'";
$data_hasil = $conn->query($sql_hasil);
$row_data = $data_hasil->fetch_array();
$total_beda = $row_data['total_beda'];
$hasil = '';

/**
 * 10.a Jika semua hasil sama
 */
if($total_beda == 1 || $total_beda == $get_jumlah_tetangga) {
    $sql_hasil = "SELECT harvest_type FROM process WHERE include_knn = 'Ya'";
    $data_hasil = $conn->query($sql_hasil);
    $row_data = $data_hasil->fetch_array();
    $hasil = $row_data['harvest_type'];
} else {
    $sql_hasil = "SELECT DISTINCT harvest_type FROM process WHERE include_knn = 'Ya'";
    $data_hasil = $conn->query($sql_hasil);
    while ($row = $data_hasil->fetch_assoc()) {
        $sql_beda = "SELECT COUNT(harvest_type) AS total_beda FROM process WHERE include_knn = 'Ya' AND harvest_type = '".$row['harvest_type']."'";
        $data_beda = $conn->query($sql_beda);
        $row_beda = $data_beda->fetch_array();
        $total_beda = $row_data['total_beda'];

        $hasil = '-';
    }
}

?>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="style/style.css">
<script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">

            <h1 align="center">Algoritma K Nearest Neightbor</h1>
            <br/>
            <a href="./index.php" class="btn btn-primary">Kembali</a>
            <br/>
            <br/>

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                       aria-controls="nav-home" aria-selected="true">1. Tabel Gabungan Data</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                       role="tab" aria-controls="nav-profile" aria-selected="false">2. Input Data Selanjutnya</a>
                    <a class="nav-item nav-link active" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                       role="tab"
                       aria-controls="nav-contact" aria-selected="false">3. Proses Perhitungan Euclidean Distance</a>
                    <a class="nav-item nav-link" id="nav-contact2-tab" data-toggle="tab" href="#nav-contact2" role="tab"
                       aria-controls="nav-contact2" aria-selected="false">4. Urutan Jarak Terdekat</a>
                    <a class="nav-item nav-link" id="nav-contact3-tab" data-toggle="tab" href="#nav-contact3" role="tab"
                       aria-controls="nav-contact3" aria-selected="false">5. Kategori Ya K-NN</a>
                    <a class="nav-item nav-link" id="nav-contact4-tab" data-toggle="tab" href="#nav-contact4" role="tab"
                       aria-controls="nav-contact4" aria-selected="false">6. Hasil Algoritma</a>
                </div>
            </nav>
            <br/>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Temperatur</th>
                            <th>Kelembaban</th>
                            <th>Kondisi Tanaman</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql_process = 'SELECT * FROM process ORDER BY date ASC';
                        $data_process = $conn->query($sql_process);
                        $no = 1;

                        while ($row = $data_process->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['date'] ?></td>
                                <td><?php echo $row['temperature'] ?> &#8451;</td>
                                <td><?php echo $row['humidity'] ?></td>
                                <td><?php echo $row['harvest_type'] ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                     aria-labelledby="nav-profile-tab">
                    <div class="row">
                        <div class="col-xs-12 col-md-4 offset-md-4">
                            <form action="" method="get">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tanggal</label>
                                    <input type="date" name="date" class="form-control" value="<?php echo $get_date ?>"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Temperatur &#8451;</label>
                                    <input type="number" name="temperature" class="form-control"
                                           value="<?php echo $get_temperature ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kelembaban</label>
                                    <input type="number" name="humidity" class="form-control"
                                           value="<?php echo $get_humidity ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jumlah Tetangga Terdekat</label>
                                    <input type="number" name="jumlah_tetangga" class="form-control"
                                           value="<?php echo $get_jumlah_tetangga ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="nav-contact" role="tabpanel"
                     aria-labelledby="nav-contact-tab">

                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Temperatur</th>
                            <th>Kelembaban</th>
                            <th>Euclidean Distance (<?php echo $get_temperature . ',' . $get_humidity ?>)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php


                        $sql_process = 'SELECT * FROM process ORDER BY date ASC';
                        $data_process = $conn->query($sql_process);
                        $no = 1;

                        while ($row = $data_process->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['date'] ?></td>
                                <td><?php echo $row['temperature'] ?> &#8451;</td>
                                <td><?php echo $row['humidity'] ?></td>
                                <td><?php echo $row['euclidience_distance'] ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                </div>
                <div class="tab-pane fade" id="nav-contact2" role="tabpanel" aria-labelledby="nav-contact2-tab">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Temperatur</th>
                            <th>Kelembaban</th>
                            <th>Euclidean Distance (<?php echo $get_temperature . ',' . $get_humidity ?>)</th>
                            <th>Urutan Jarak</th>
                            <th>Apakah termasuk <?php echo $get_jumlah_tetangga ?>-NN ?</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql_process = 'SELECT * FROM process ORDER BY date ASC';
                        $data_process = $conn->query($sql_process);
                        $no = 1;

                        while ($row = $data_process->fetch_assoc()) {

                            ?>
                            <tr <?php echo $row['include_knn'] == 'Ya' ? ' class="table-success"' : '' ?>>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['date'] ?></td>
                                <td><?php echo $row['temperature'] ?> &#8451;</td>
                                <td><?php echo $row['humidity'] ?></td>
                                <td><?php echo $row['euclidience_distance'] ?></td>
                                <td><?php echo $row['urutan_jarak'] ?></td>
                                <td><?php echo $row['include_knn'] ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="nav-contact3" role="tabpanel" aria-labelledby="nav-contact3-tab">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Temperatur</th>
                            <th>Kelembaban</th>
                            <th>Euclidean Distance (<?php echo $get_temperature . ',' . $get_humidity ?>)</th>
                            <th>Urutan Jarak</th>
                            <th>Apakah termasuk <?php echo $get_jumlah_tetangga ?>-NN ?</th>
                            <th>Kategori Ya untuk KNN ?</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql_process = 'SELECT * FROM process ORDER BY date ASC';
                        $data_process = $conn->query($sql_process);
                        $no = 1;

                        while ($row = $data_process->fetch_assoc()) {

                            $status_tetangga = $row['urutan_jarak'] <= $get_jumlah_tetangga ? 'Ya' : 'Tidak';
                            $kategori = $status_tetangga == 'Ya' ? $row['harvest_type'] : '-';

                            ?>
                            <tr <?php echo $status_tetangga == 'Ya' ? ' class="table-success"' : '' ?>>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['date'] ?></td>
                                <td><?php echo $row['temperature'] ?> &#8451;</td>
                                <td><?php echo $row['humidity'] ?></td>
                                <td><?php echo $row['euclidience_distance'] ?></td>
                                <td><?php echo $row['urutan_jarak'] ?></td>
                                <td><?php echo $row['include_knn'] ?></td>
                                <td><?php echo $row['include_knn'] == 'Ya' ? $row['harvest_type'] : '-'; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="nav-contact4" role="tabpanel" aria-labelledby="nav-contact4-tab">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Temperatur</th>
                            <th>Kelembaban</th>
                            <th>Kondisi Tanaman</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $get_date ?></td>
                                <td><?php echo $get_temperature ?></td>
                                <td><?php echo $get_humidity ?></td>
                                <td><?php echo $hasil ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</div>

<?php $conn->close(); ?>
