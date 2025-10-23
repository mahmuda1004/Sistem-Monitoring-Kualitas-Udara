<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quality Air Prediction</title>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <style>
        /* CSS styles */
        body {
            background: linear-gradient(to right, #9b59b6, #3498db);
            font-family: Arial, sans-serif;
            color: #fff;
            text-align: center;
            margin: 0;
            padding: 0;

        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            padding-top: 10px;
        }

        h2 {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .nav-links {
            margin-bottom: 20px;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }

        .nav-links a.active {
            font-weight: bold;
            color: yellow;

        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .history-table th,
        .history-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .history-table th {
            background-color: #9b59b6;
        }

        .download-buttons {
            margin-top: 20px;
        }

        .download-button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .download-button:hover {
            background-color: #2980b9;
        }

        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pagination a {
            display: inline-block;
            padding: 5px 10px;
            margin: 0 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
        }

        .pagination .active {
            background-color: #3498db;
            color: #fff;
        }

        .chart-container {
            max-width: 600px;
            margin: 0 auto;
            margin-top: 20px;
        }

        #history-chart {
            background-color: rgba(255, 255, 255, 0.10);
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }

        footer {
            padding-top: 20px;
        }

        /* Responsiveness */
        @media screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }

            .nav-links a {
                margin: 0 5px;
            }

            .history-table th,
            .history-table td {
                padding: 5px;
            }

            .chart-container {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Riwayat Sistem Monitoring Kualitas Udara</h1>
        <!-- <h2>Data Hasil Monitoring Kualitas Udara Dengan Regresi Linear Berganda</h2> -->
        <div class="nav-links">
            <a href="index.php" <?php if (basename($_SERVER['PHP_SELF']) == 'dashboard.php') echo 'class="active"'; ?>>Dashboard</a>
            <a href="history.php" <?php if (basename($_SERVER['PHP_SELF']) == 'history.php') echo 'class="active"'; ?>>History</a>
            <a href="about.php" <?php if (basename($_SERVER['PHP_SELF']) == 'about.php') echo 'class="active"'; ?>>About</a>
        </div>
        <div id="history-results">
            <!-- Data riwayat akan diperbarui di sini -->
            <div class="download-buttons">
                <a href="download.php?type=csv" class="download-button">Download as CSV</a>
            </div>
            <?php
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
            // Set zona waktu ke WITA
            // date_default_timezone_set('Asia/Makassar');
            // Menyimpan waktu ke dalam format MySQL
            // $prediction_date = date('Y-m-d H:i:s');


            // Fungsi untuk melakukan perhitungan regresi linear
            function multipleLinearRegression($pm10, $pm25, $co, $no2, $o3)
            {
                // Konversi variabel ke tipe data float jika diperlukan
                $pm10 = floatval($pm10);
                $pm25 = floatval($pm25);
                $co = floatval($co);
                $no2 = floatval($no2);
                $o3 = floatval($o3);
                // Koefisien regresi linear
                $coef_pm10 = 0.21;
                $coef_pm25 = 0.47;
                $coef_co = 0.40;
                $coef_no2 = 0.03;
                $coef_o3 = 0.04;
                $intercept = 1.55;

                // Menghitung nilai prediksi
                $prediction = ($coef_pm10 * $pm10) + ($coef_pm25 * $pm25) + ($coef_co * $co) + ($coef_no2 * $no2) + ($coef_o3 * $o3) + $intercept;

                return $prediction;
            }

            // Fungsi untuk menentukan kualitas udara berdasarkan hasil regresi
            function determineAirQuality($prediction)
            {
                if ($prediction >= 0 && $prediction < 50) {
                    return 'Baik';
                } elseif ($prediction >= 50 && $prediction < 100) {
                    return 'Sedang';
                } elseif ($prediction >= 100 && $prediction < 200) {
                    return 'Tidak Sehat';
                } elseif ($prediction >= 200 && $prediction < 300) {
                    return 'Sangat Tidak Sehat';
                } elseif ($prediction >= 300) {
                    return 'Berbahaya';
                } else {
                    return 'Unknown';
                }
            }
            // Mendapatkan data dari database
            $sql = "SELECT tanggal, pm10, pm25, co, no2, o3 FROM udara3";
            $result = $conn->query($sql);

            // Menghitung total baris
            $total_rows = $result->num_rows;

            // Jumlah baris per halaman
            $rows_per_page = 10;

            // Menghitung total halaman
            $total_pages = ceil($total_rows / $rows_per_page);

            // Define $current_page
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

            // Hitung offset
            $offset = ($current_page - 1) * $rows_per_page;

            // Mengambil data dari database
            $sql = "SELECT tanggal, pm10, pm25, co, no2, o3 FROM udara3 ORDER BY tanggal DESC LIMIT $offset, $rows_per_page";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<div style="overflow-x:auto;">';
                echo '<table class="history-table">';
                echo '<tr>';
                echo '<th>Tanggal</th>';
                echo '<th>PM10</th>';
                echo '<th>PM2.5</th>';
                echo '<th>CO</th>';
                echo '<th>NO2</th>';
                echo '<th>O3</th>';
                echo '<th>IKU</th>';
                echo '<th>Kategori</th>';
                echo '</tr>';
                // Mengambil data dari setiap baris
                while ($row = $result->fetch_assoc()) {
                    $prediction_date = $row['tanggal'];
                    $pm10 = $row['pm10'];
                    $pm25 = $row['pm25'];
                    $co = $row['co'];
                    $no2 = $row['no2'];
                    $o3 = $row['o3'];

                    // Memanggil fungsi untuk melakukan perhitungan regresi linear
                    $regression_result = multipleLinearRegression($pm10, $pm25, $co, $no2, $o3);
                    // Memformat nilai IKU menjadi dua angka desimal
                    $iku = number_format($regression_result, 2);
                    // Menentukan kualitas udara berdasarkan hasil regresi
                    $air_quality = determineAirQuality($regression_result);

                    echo '<tr>';
                    echo '<td>' . $prediction_date . '</td>';
                    echo '<td>' . $pm10 . '</td>';
                    echo '<td>' . $pm25 . '</td>';
                    echo '<td>' . $co . '</td>';
                    echo '<td>' . $no2 . '</td>';
                    echo '<td>' . $o3 . '</td>';
                    echo '<td class="air-quality-status ' . strtolower(str_replace(' ', '-', $iku)) . '">' . $iku . '</td>';
                    echo '<td>' . $air_quality . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
                echo '</div>';
                // Tampilkan pagination
                // Tampilkan pagination
                echo '<div class="pagination">';
                if ($total_pages > 1) {
                    if ($current_page > 1) {
                        echo '<a href="?page=' . ($current_page - 1) . '">Prev</a>';
                    }

                    // Tampilkan angka halaman
                    $start_page = max(1, $current_page - 2);
                    $end_page = min($total_pages, $current_page + 2);

                    for ($i = $start_page; $i <= $end_page; $i++) {
                        $active_class = ($i == $current_page) ? 'class="active"' : '';
                        echo '<a href="?page=' . $i . '" ' . $active_class . '>' . $i . '</a>';
                    }

                    if ($current_page < $total_pages) {
                        echo '<a href="?page=' . ($current_page + 1) . '">Next</a>';
                    }
                }
                echo '</div>';
            }
            ?>
            <!-- Menampilkan grafik -->
            <div id="chartContainer" style="height: 370px; width: 100%; padding-top: 20px;"></div>

        </div>
    </div>
    </div>
    <?php
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
    $chartData = [];
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

        // Menambahkan data untuk grafik
        $chartData[] = [
            'axisX' => $prediction_date,
            'axisY' => $iku
        ];
    }
    ?>

    <script>
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "Data Kualitas Udara"
                },
                axisX: {
                    title: "Tanggal"
                },
                axisY: {
                    title: "IKU"
                },
                data: [{
                    type: "line",
                    // name: "PM10",
                    // showInLegend: true,
                    dataPoints: [
                        <?php
                        // Loop through the PHP array and create JavaScript objects
                        foreach ($chartData as $dataPoint) {
                            echo "{ x: new Date('{$dataPoint['axisX']}'), y: {$dataPoint['axisY']} },";
                        }
                        ?>
                    ]
                }]
            });

            chart.render();
        }
    </script>
    <footer>
        <p><strong>Copyright &copy; 2024</strong></p>
    </footer>
</body>

</html>