<?php

if (isset($_GET['type']) && $_GET['type'] === 'csv') {
    // Set header untuk mengatur tipe konten sebagai CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="air_quality_samarinda.csv"');
    include 'rlb.php';
    // Membuat file CSV
    $output = fopen('php://output', 'w');

    // Menulis header CSV
    fputcsv($output, array('Tanggal', 'PM10', 'PM2.5', 'CO', 'NO2', 'O3', 'IKU', 'Kategori'));

    // Menghubungkan dengan database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "air_quality_db";

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Mengambil data dari database
    $sql = "SELECT tanggal, pm10, pm25, co, no2, o3 FROM udara3";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $prediction_date = $row['tanggal'];
        $pm10 = $row['pm10'];
        $pm25 = $row['pm25'];
        $co = $row['co'];
        $no2 = $row['no2'];
        $o3 = $row['o3'];
        $regression_result = multipleLinearRegression($pm10, $pm25, $co, $no2, $o3);
        $iku = number_format($regression_result, 2);
        $air_quality = determineAirQuality($regression_result);

        // Menulis data ke file CSV
        fputcsv($output, array($prediction_date, $pm10, $pm25, $co, $no2, $o3, $iku, $air_quality));
    }

    // Tutup file CSV
    fclose($output);
    exit;
}
