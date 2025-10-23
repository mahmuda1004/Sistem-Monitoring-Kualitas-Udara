<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quality Air Prediction Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
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


        .prediction-box {
            background-color: #f5eff8;
            color: #9b59b6;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            margin: 0 auto;
        }

        .waktu {
            padding-bottom: 20px;
        }

        .prediction-box h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .prediction-box p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .prediction-box span {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .air-quality-good {
            background-color: #2ecc71;
        }

        .air-quality-moderate {
            background-color: #f1c40f;
        }

        .air-quality-unhealthy {
            background-color: #e74c3c;
        }

        .prediction-warning {
            background-color: rgba(255, 255, 255, 0.10);
            border-radius: 5px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }

        .prediction-warning p {
            font-size: 16px;
            line-height: 1.5;
            margin: 0;
            padding: 10px 0;
        }

        .prediction-warning strong {
            font-weight: bold;
            color: #e74c3c;
            /* Adjust the color as needed */
        }

        .parameter-values-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(120px, 1fr));
            /* Mengubah jumlah kolom menjadi 5 */
            gap: 10px;
        }

        .parameter-box {
            background-color: #f5eff8;
            color: #9b59b6;
            padding: 8px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .parameter-box:hover {
            transform: scale(1.1);
        }

        .parameter-box p:first-child {
            font-weight: bold;
            margin-bottom: 5px;
            padding-right: 80px;
        }

        .parameter-box p:last-child {
            margin: 0;
            padding-left: 20px;
        }

        .kualitas-udara {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .kategori-udara {
            display: flex;
            align-items: center;

        }

        .iku-and-regression {
            font-size: 16px;
            transition: transform 0.3s ease;
        }

        .iku-and-regression:hover {
            transform: scale(1.1);
        }

        .iku {
            font-weight: bold;
        }

        .regression-result {
            font-size: 15px;
        }

        .air-quality {
            font-size: 25px;
        }

        .air-quality-image {
            width: 100px;
            height: 100px;
            margin-right: 15px;
        }

        .saran {
            flex: 1;
            margin: 10px;
        }

        .saran p {
            font-size: 16px;
            margin: 0;
            padding: 10px 0;
        }

        .chart-container {
            max-width: 600px;
            margin: 0 auto;
            margin-top: 20px;
            align-items: center;
        }

        .map {
            background-color: rgba(255, 255, 255, 0.10);
            border-radius: 5px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow: hidden;
        }


        .map iframe {
            /* Lebar penuh */
            width: 100%;
            /* Tinggi penuh */
            height: 100%;
            border: 0;
        }

        /* Membuat iframe fleksibel pada layar kecil */
        /* Membuat tampilan responsif untuk layar dengan lebar maksimum 600px */
        @media (max-width: 700px) {
            .parameter-values-grid {
                display: block;
                /* Mengubah tampilan menjadi blok */
            }

            .parameter-box {
                margin-bottom: 10px;
                /* Menambahkan jarak antar grid */
            }

            .map {
                padding: 10px;
            }

            .map p {
                font-size: 14px;
                margin: 0;
                padding: 10px 0;
            }

            .prediction-box {
                width: 90%;
                /* Adjust the width as needed */
                max-width: none;
                /* Remove the maximum width */
            }

            .kualitas-udara {
                flex-direction: column;
                /* Change the direction to stack vertically */
                align-items: flex-start;
                /* Align items to the start */
            }

            .kategori-udara {
                width: 100%;
                /* Make the category section full width */
                justify-content: space-between;
                /* Add space between items */
                align-items: center;
            }

            .air-quality-image {
                width: 100px;
                /* Adjust the image size as needed */
                height: 100px;
                margin-right: 5px;
                /* Remove the margin */
                /* margin-bottom: 10px; */
                /* Add margin bottom for spacing */
            }

            .iku-and-regression {
                width: calc(100% - 60px);
                /* Adjust the width to fit the text */
                margin-right: 0;
                /* Remove the margin */
            }

            .saran {
                width: 100%;
                /* Make the advice section full width */
                margin: 10px 0;
                /* Add margin top and bottom */
            }

            .saran p {
                padding: 5px 0;
                /* Adjust the padding */
            }

            .chart-container {
                max-width: 100%;
                /* Make the chart container full width */
            }

            /* Adjust chart height for better visibility */
            canvas {
                height: 400px;
                /* Adjust the height as needed */
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Sistem Monitoring Kualitas Udara</h1>

        <div class="nav-links">
            <a href="index.php" <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="active"'; ?>>Dashboard</a>
            <a href="history.php" <?php if (basename($_SERVER['PHP_SELF']) == 'history.php') echo 'class="active"'; ?>>History</a>
            <a href="about.php" <?php if (basename($_SERVER['PHP_SELF']) == 'about.php') echo 'class="active"'; ?>>About</a>
        </div>


        <?php
        //Fungsi untuk mengambil data dari API
        function getLatestData()
        {
            $url = "https://platform.antares.id:8443/~/antares-cse/antares-id/AQWM/weather_airQuality_nodeCore_teknik/la";
            $headers = [
                "X-M2M-Origin: 983825e56c487fe6:c4d80cf91d63ec37"
            ];

            // Inisialisasi cURL session
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $response = curl_exec($ch);

            // Tutup session cURL
            curl_close($ch);

            // Mengubah format JSON ke array associative
            $dataJson = json_decode($response, true);

            $result = [];

            // Mengonversi format timestamp dari string ke integer
            if (isset($dataJson['m2m:cin']['ct'])) {
                $timestampString = $dataJson['m2m:cin']['ct'];
                $year = substr($timestampString, 0, 4);
                $month = substr($timestampString, 4, 2);
                $day = substr($timestampString, 6, 2);
                $hour = substr($timestampString, 9, 2);
                $minute = substr($timestampString, 11, 2);
                $second = substr($timestampString, 13, 2);

                $timestamp = mktime($hour, $minute, $second, $month, $day, $year);

                $updateTime = date('Y-m-d H:i:s', $timestamp);
                $result['update_time'] = $updateTime;
            } else {
                $result['update_time'] = "Data belum diperbarui";
            }

            // Menampilkan data lainnya
            if (isset($dataJson['m2m:cin']['con'])) {
                $data = json_decode($dataJson['m2m:cin']['con'], true);
                $result['Ozon'] = $data['Ozon'];
                $result['PM2.5'] = $data['PM2.5'];
                $result['PM10'] = $data['PM10'];
                $result['CO'] = $data['CO'];
                $result['NO2'] = $data['NO2'];
            } else {
                $result['data'] = "Tidak ada data yang tersedia";
            }

            return $result;
        }

        // Menggunakan fungsi getLatestData() untuk mendapatkan data terbaru
        $latest_data = getLatestData();
        // $latest_data = json_decode($data['data'], true);

        // Mengambil nilai dari respons API
        // Menyimpan waktu update ke dalam variabel
        $tanggal = $latest_data['update_time'];

        // Set zona waktu ke WIB (Waktu Indonesia Barat)
        date_default_timezone_set('Asia/Jakarta');

        // Mengonversi waktu ke WITA (Waktu Indonesia Tengah)
        $tanggal_wita = date('Y-m-d H:i:s', strtotime('+1 hour', strtotime($tanggal)));
        // Menyimpan data ke dalam variabel
        $pm25 = number_format((float)$latest_data['PM2.5'], 2, '.', '');
        $pm10 = number_format((float)$latest_data['PM10'], 2, '.', '');
        $no2 = number_format((float)$latest_data['NO2'], 2, '.', '');
        $co = number_format((float)$latest_data['CO'], 2, '.', '');
        $o3 = number_format((float)$latest_data['Ozon'], 2, '.', '');

        ?>
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
        ?>

        <?php

        // Memeriksa apakah data sudah ada
        $check_sql = "SELECT COUNT(*) FROM udara3 WHERE tanggal = '$tanggal_wita'";
        $result = mysqli_query($conn, $check_sql);
        $row = mysqli_fetch_array($result);

        if ($row[0] == 0) {
            // Data belum ada, lakukan INSERT
            $sql = "INSERT INTO udara3 (tanggal, pm10, pm25, no2, co, o3) 
            VALUES ('$tanggal_wita', '$pm10', '$pm25', '$no2', '$co', '$o3')";
            mysqli_query($conn, $sql);
        } else {
            // Data sudah ada, berikan pesan
            $pesan = "Data Telah Di Update.";
            echo "<script>alert('$pesan');</script>";
        }
        // Fungsi untuk melakukan perhitungan regresi linear
        function multipleLinearRegression($pm10, $pm25, $no2, $co, $o3)
        {
            // Konversi variabel ke tipe data float 
            $pm10 = floatval($pm10);
            $pm25 = floatval($pm25);
            $no2 = floatval($no2);
            $co = floatval($co);
            $o3 = floatval($o3);
            // Koefisien regresi linear
            $coef_pm10 = 0.37;
            $coef_pm25 = 0.28;
            $coef_no2 = 0.02;
            $coef_co = 0.38;
            $coef_o3 = 0.04;
            $intercept = 1.64;

            // Menghitung nilai prediksi
            $prediction = ($coef_pm10 * $pm10) + ($coef_pm25 * $pm25) + ($coef_no2 * $no2) + ($coef_co * $co) + ($coef_o3 * $o3) + $intercept;

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
        $sql = "SELECT tanggal, pm10, pm25, no2, co, o3 FROM udara3";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mengambil data dari setiap baris
            while ($row = $result->fetch_assoc()) {
                $tanggal_wita = $row['tanggal'];
                $pm10 = $row['pm10'];
                $pm25 = $row['pm25'];
                $no2 = $row['no2'];
                $co = $row['co'];
                $o3 = $row['o3'];

                // Memanggil fungsi untuk melakukan perhitungan regresi linear
                $regression_result = multipleLinearRegression($pm10, $pm25, $no2, $co, $o3);
                // Memformat nilai IKU menjadi dua angka desimal
                $iku = number_format($regression_result, 2);
                // Menentukan kualitas udara berdasarkan hasil regresi
                $air_quality = determineAirQuality($regression_result);
            }
        } else {
            echo "Tidak ada data yang ditemukan.";
        }

        ?>
        <div class="prediction-box">
            <div class="waktu">
                <p><strong>Terakhir diperbarui pada </strong><?php echo $tanggal_wita; ?></p>
            </div>

            <div class="parameter-values-grid">
                <div class="parameter-box">
                    <p>PM₁₀</p>
                    <p><?php echo $pm10; ?> µg/m³</p>
                </div>
                <div class="parameter-box">
                    <p>PM₂.₅</p>
                    <p><?php echo $pm25; ?> µg/m³</p>
                </div>
                <div class="parameter-box">
                    <p>CO</p>
                    <p><?php echo $co; ?> µg/m³</p>
                </div>
                <div class="parameter-box">
                    <p>NO₂</p>
                    <p><?php echo $no2; ?> µg/m³</p>
                </div>
                <div class="parameter-box">
                    <p>O³</p>
                    <p><?php echo $o3; ?> µg/m³</p>
                </div>
            </div>
            <div class="kualitas-udara">
                <div class="kategori-udara">
                    <img class="air-quality-image" src="<?php echo getAirQualityImage($air_quality); ?>" alt="Air Quality">
                    <div class="iku-and-regression" style="background-color:<?php echo getAirQualityColor($air_quality); ?>; color:<?php echo getTextColor($air_quality); ?>; border-radius: 5px;">
                        <div style="background-color: <?php echo getAirQualityColorValue($air_quality); ?>; margin: 10px; border-radius: 5px;">
                            <span class="iku">IKU</span>
                            <span class="regression-result"><?php echo $iku; ?></span>
                        </div>
                        <span class="air-quality" style="color:<?php echo getAirQualityAdviceColor($air_quality); ?>;"><?php echo $air_quality; ?></span>
                    </div>
                </div>
                <div class="saran" style="color:<?php echo getAirQualityAdviceTextColor($air_quality); ?>;">
                    <p><strong><?php echo getAirQualityAdvice($air_quality); ?></strong></p>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="parameter-chart"></canvas>
            </div>
            </p>
            <div class="map">
                <p><strong> Lokasi Sensor : Fakultas Teknik, Universitas Mulawarman</strong></p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3989.685678040946!2d117.1550217!3d-0.4672005!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67902a63f62cf%3A0x1163ef31755fee1c!2sProdi%20Sistem%20Informasi%20%2C%20Fakultas%20Teknik%20UNMUL!5e0!3m2!1sen!2sid!4v1701031545184!5m2!1sen!2sid" width="700" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <?php
        //Fungsi untuk saran dari kualitas udara
        function getAirQualityAdvice($air_quality)
        {
            switch ($air_quality) {
                case 'Baik':
                    return '<p>Udara bersih, Anda dapat melanjutkan aktivitas di luar ruangan tanpa khawatir.</p>';
                case 'Sedang':
                    return '<p>Udara sedikit kurang bersih, jadi lebih baik kurangi aktivitas di luar ruangan, terutama bagi Anda yang sensitif terhadap polusi udara.</p>';
                case 'Tidak Sehat':
                    return '<p>Udara semakin tidak sehat, sebaiknya hindari aktivitas di luar ruangan dan kenakan masker jika harus keluar rumah.</p>';
                case 'Sangat Tidak Sehat':
                    return '<p>Udara sangat buruk, lebih baik tetap berada di dalam ruangan dan memakai masker jika harus keluar rumah.</p>';
                case 'Berbahaya':
                    return '<p><strong>Peringatan!<br></strong> Udara berbahaya, lebih baik tetap berada di dalam rumah dan memakai masker jika harus keluar rumah.</p>';
                default:
                    return '<p>Prediksi kualitas udara yang tidak diketahui.</p>';
            }
        }
        //Fungsi untuk warna teks saran dari kualitas udara
        function getAirQualityAdviceTextColor($air_quality)
        {
            switch ($air_quality) {
                case 'Baik':
                    return '#2E8B57';
                case 'Sedang':
                    return '#375C70';
                case 'Tidak Sehat':
                    return '#8C6C1D';
                case 'Sangat Tidak Sehat':
                    return '#942431';
                case 'Berbahaya':
                    return 'black';
                default:
                    return 'black';
            }
        }
        //Fungsi untuk warna teks untuk kategori kualitas udara
        function getAirQualityAdviceColor($air_quality)
        {
            switch ($air_quality) {
                case 'Baik':
                    return '#2E8B57';
                case 'Sedang':
                    return '#375C70';
                case 'Tidak Sehat':
                    return '#8C6C1D';
                case 'Sangat Tidak Sehat':
                    return '#942431';
                case 'Berbahaya':
                    return 'grey';
                default:
                    return 'black';
            }
        }

        // Fungsi untuk Icon atau gambar kualitas udara
        function getAirQualityImage($air_quality)
        {
            switch ($air_quality) {
                case 'Baik':
                    return './icon/ic-face-green.svg';
                case 'Sedang':
                    return './icon/ic-face-blue.svg';
                case 'Tidak Sehat':
                    return './icon/ic-face-yellow.svg';
                case 'Sangat Tidak Sehat':
                    return './icon/ic-face-red.svg';
                case 'Berbahaya':
                    return './icon/ic-face-black.svg';
                default:
                    return './icon/ic-face-white.svg';
            }
        }
        $imageSource = getAirQualityImage($air_quality);

        // Menampilkan pesan kesalahan jika icon atau gambar tidak ditemukan
        if (!file_exists($imageSource)) {
            echo "File gambar tidak ditemukan: $imageSource";
        }

        // Fungsi untuk mendapatkan warna latar belakang kategori kualitas udara
        function getAirQualityColor($air_quality)
        {
            switch ($air_quality) {
                case 'Baik':
                    return '#2ecc71';
                case 'Sedang':
                    return '#40A2E3';
                case 'Tidak Sehat':
                    return '#f1c40f';
                case 'Sangat Tidak Sehat':
                    return '#e74c3c';
                case 'Berbahaya':
                    return '#000000';
                default:
                    return '#fff';
            }
        }
        // Fungsi untuk mendapatkan warna latar belakang berdasarkan nilai kualitas udara
        function getAirQualityColorValue($air_quality)
        {
            switch ($air_quality) {
                case 'Baik':
                    return '#2E8B57';
                case 'Sedang':
                    return '#375C70';
                case 'Tidak Sehat':
                    return '#8C6C1D';
                case 'Sangat Tidak Sehat':
                    return '#942431';
                case 'Berbahaya':
                    return 'grey';
                default:
                    return '#fff';
            }
        }

        // Fungsi untuk mendapatkan warna tulisan atau teks nilai dari kualitas udara
        function getTextColor($air_quality)
        {
            switch ($air_quality) {
                case 'Baik':
                    return '#fff';
                case 'Sedang':
                    return '#fff';
                case 'Tidak Sehat':
                    return '#fff';
                case 'Sangat Tidak Sehat':
                    return '#fff';
                case 'Berbahaya':
                    return '#fff';
                default:
                    return '#000';
            }
        }
        ?>
    </div>
    <footer>
        <p><strong>Copyright &copy; 2024</strong></p>
    </footer>
    <script>
        //Kode JavaScript untuk pembuatan chart

        <?php
        // Fungsi untuk mendapatkan data parameter atau variabel untuk chart
        function getChartData($pm10, $pm25, $co, $no2, $o3)
        {
            return [
                'PM₁₀' => $pm10,
                'PM₂.₅' => $pm25,
                'CO' => $co,
                'NO₂' => $no2,
                'O³' => $o3,
            ];
        }

        // Mendapatkan data parameter untuk chart
        $chartData = getChartData($pm10, $pm25, $co, $no2, $o3);

        // Mendefinisikan data chart dan warna untuk setiap parameter
        $chartLabels = [];
        $chartValues = [];
        $chartColors = [];

        foreach ($chartData as $label => $value) {
            $chartLabels[] = $label;
            $chartValues[] = $value;
            $chartColors[] = getAirQualityColor($air_quality);
        }
        ?>

        // Membuat chart
        var ctx = document.getElementById('parameter-chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($chartLabels); ?>,
                datasets: [{
                    label: 'Parameter Value',
                    data: <?php echo json_encode($chartValues); ?>,
                    backgroundColor: <?php echo json_encode($chartColors); ?>,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>