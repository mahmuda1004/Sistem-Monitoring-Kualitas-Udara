<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Quality Air Prediction</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
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

        .about-content {
            text-align: justify;
            margin-top: 20px;
            margin-left: 20px;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.10);
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }

        th,
        td {
            padding: 5px 5px 10px 10px;
        }

        .color-box1 {
            background-color: #2ecc71;
        }

        .color-box2 {
            background-color: #40A2E3;
        }

        .color-box3 {
            background-color: #f1c40f;
        }

        .color-box4 {
            background-color: #e74c3c;
        }

        .color-box5 {
            background-color: black;
        }

        /* Responsiveness */
        @media screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }

            .nav-links a {
                margin: 0 5px;
            }

            .about-content {
                margin-top: 10px;
                margin-left: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 20px;
                background-color: rgba(255, 255, 255, 0.10);
                border-radius: 5px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            }

            table {
                width: 100%;
                max-width: 400px;
                /* Max width for the table */
                margin-top: 10px;
                /* Add some space between table and content */
            }

            th,
            td {
                padding: 5px;
                text-align: center;
                /* Center align text */
            }
        }

        .sensor-image {
            display: block;
            margin: 10px auto;
            max-width: 20%;
            max-height: 30%;
            /* height: auto; */
            border-radius: 5px;
            transition: transform 0.2s ease-in-out;
        }

        .sensor-image:hover,
        .sensor-image:active {
            transform: scale(1.5);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Tentang Sistem Monitoring Kualitas Udara</h1>

        <div class="nav-links">
            <a href="index.php" <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="active"'; ?>>Dashboard</a>
            <a href="history.php" <?php if (basename($_SERVER['PHP_SELF']) == 'history.php') echo 'class="active"'; ?>>History</a>
            <a href="about.php" <?php if (basename($_SERVER['PHP_SELF']) == 'about.php') echo 'class="active"'; ?>>About</a>
        </div>

        <div class="about-content">
            <h1>Sistem Monitoring Kualitas Udara</h1>

            <h2>Tujuan</h2>
            <p>Sistem monitoring kualitas udara ini dibuat dengan tujuan untuk menyajikan informasi mengenai kualitas udara secara real-time. Sistem ini menggunakan model regresi linear berganda untuk menghitung Indeks Kualitas Udara (IKU) berdasarkan data polutan yang diukur oleh sensor. IKU yang dihasilkan oleh model digunakan untuk mengklasifikasikan kualitas udara sesuai dengan kategori Indeks Standar Pencemar Udara (ISPU).</p>

            <h2>Sumber Data</h2>
            <p>Sumber data polutan yang digunakan dalam sistem ini diperoleh secara langsung dari sensor yang ditempatkan di Fakultas Teknik Universitas Mulawarman. Data ini mencakup pengukuran dari beberapa polutan utama, termasuk PM2.5, PM10, CO, NO2, dan O3.</p>

            <h2>Pembagian Data dan Pembuatan Model</h2>
            <p>Dataset yang digunakan diambil dari Kaggle, terdiri dari 16.322 baris data. Data ini dibagi menjadi dua bagian:</p>
            <ul>
                <li><b>80% untuk pelatihan (training):</b> Digunakan untuk membangun model prediksi.</li>
                <li><b>20% untuk pengujian (testing):</b> Digunakan untuk menguji keakuratan model.</li>
            </ul>
            <p>Model regresi linear berganda dibuat menggunakan Python di Google Colab. Model ini menghasilkan persamaan prediksi sebagai berikut:</p>
            <p>
                <center><i>Y' = 1.64 + 0.37 * PM2.5 + 0.28 * PM10 + 0.02 * CO + 0.38 * NO2 + 0.04 * O3</i></center>
            </p>
            <p>di mana Y' adalah nilai prediksi IKU.</p>

            <h2>Evaluasi Model</h2>
            <p>Model ini dievaluasi menggunakan dua metrik utama:</p>
            <ul>
                <li><b>Root Mean Squared Error (RMSE):</b> Mengukur seberapa jauh nilai prediksi dari nilai sebenarnya, dengan hasil RMSE 0.24.</li>
                <li><b>Koefisien Determinasi (R²):</b> Mengukur seberapa baik variabel bebas menjelaskan variabel tergantung, dengan hasil R² sebesar 0.84, menunjukkan bahwa model ini cukup baik dalam memprediksi nilai IKU berdasarkan polutan yang ada.</li>
            </ul>

            <h2>Kategori Indeks Standar Pencemar Udara (ISPU)</h2>
            <p>Indeks Standar Pencemar Udara (ISPU) digunakan untuk mengukur dan memantau tingkat polusi udara di seluruh Indonesia. Kualitas udara diklasifikasikan menjadi beberapa kategori berdasarkan nilai IKU:</p>
            <div class="content">
                <table border="1">
                    <tr>
                        <th>Rentang ISPU</th>
                        <th>Warna</th>
                        <th>Kategori</th>
                        <th>Efek Kesehatan</th>
                    </tr>
                    <tr>
                        <td>0-50</td>
                        <td class="color-box1"></td>
                        <td>Baik</td>
                        <td>Tingkat mutu udara yang sangat baik, tidak memberikan efek negatif terhadap manusia, hewan dan tumbuhan.</td>
                    </tr>
                    <tr>
                        <td>51-100</td>
                        <td class="color-box2"></td>
                        <td>Sedang</td>
                        <td>Tingkat mutu udara masih dapat diterima pada kesehatan manusia, hewan dan tumbuhan.</td>
                    </tr>
                    <tr>
                        <td>101-200</td>
                        <td class="color-box3"></td>
                        <td>Tidak Sehat</td>
                        <td>Tingkat mutu udara yang bersifat merugikan pada manusia, hewan, dan tumbuhan.</td>
                    </tr>
                    <tr>
                        <td>201-300</td>
                        <td class="color-box4"></td>
                        <td>Sangat Tidak Sehat</td>
                        <td>Tingkat mutu udara yang dapat meningkatkan resiko kesehatan pada sejumlah segmen populasi yang terpapar.</td>
                    </tr>
                    <tr>
                        <td>301+</td>
                        <td class="color-box5"></td>
                        <td>Berbahaya</td>
                        <td>Tingkat mutu udara yang dapat merugikan kesehatan serius pada populasi dan perlu penanganan cepat.</td>
                    </tr>
                </table>
            </div>

            <h2>Informasi Polutan</h2>
            <ul>
                <li><b>Nitrogen Dioksida (NO2):</b> Polutan berbahaya yang ditandai dengan warna coklat kemerahan dan bau tajam. Batas maksimal menurut WHO: 10 µg/m³ (rata-rata tahunan), 25 µg/m³ (rata-rata 24 jam), 200 µg/m³ (rata-rata 1 jam).</li>
                <li><b>Karbon Monoksida (CO):</b> Gas tak berwarna, tak berbau, dan tak berasa yang beracun. Batas maksimal menurut WHO: 4 mg/m³ (rata-rata 24 jam), 10 mg/m³ (rata-rata 8 jam), 35 mg/m³ (rata-rata 1 jam), 100 mg/m³ (rata-rata 15 menit).</li>
                <li><b>Particulate Matter 2.5 (PM2.5):</b> Partikel halus yang dapat masuk ke dalam paru-paru manusia. Batas maksimal menurut WHO: 5 µg/m³ (rata-rata tahunan), 15 µg/m³ (rata-rata 24 jam).</li>
                <li><b>Particulate Matter 10 (PM10):</b> Partikel kasar yang ditemukan dalam debu dan asap. Batas maksimal menurut WHO: 15 µg/m³ (rata-rata tahunan), 45 µg/m³ (rata-rata 24 jam).</li>
                <li><b>Ozon (O3):</b> Molekul tiga atom oksigen yang dapat mengiritasi tenggorokan dan menghambat fotosintesis tanaman. Batas maksimal menurut WHO: 100 µg/m³ (rata-rata 8 jam).</li>
            </ul>

            <h2>Sensor yang Digunakan</h2>
            <p>Sistem ini menggunakan node sensor yang dilengkapi dengan berbagai sensor untuk mengukur polutan udara. Sensor-sensor yang digunakan meliputi:</p>
            <ul>
                <li><b>MiCS-4514</b>
                    <br>Sensor MiCS-4514 digunakan untuk mengukur konsentrasi gas NO2 dan CO.
                    <br><img src="images/image (3).png" alt="Sensor MiCS-4514" class="sensor-image">
                </li>
                <li><b>PM2.5</b>
                    <br>Sensor PM2.5 digunakan untuk mengukur konsentrasi partikel-partikel kecil dalam udara yaitu PM10 dan PM2.5.
                    <br><img src="images/image (1).png" alt="Sensor PM2.5" class="sensor-image">
                </li>
                <li><b>MQ-131</b>
                    <br>Sensor MQ-131 akan mengukur konsentrasi Ozon (O3).
                    <br><img src="images/image (2).png" alt="Sensor MQ-131" class="sensor-image">
                </li>
                <li>
                    <b>Alat Node Sensor</b>
                    <img src="images/Alat_Node_Sensor.png" alt="Node Sensor" class="sensor-image">
                </li>
            </ul>
            <h2>Kesimpulan</h2>
            <p>Sistem monitoring kualitas udara ini memberikan informasi yang akurat dan real-time mengenai kualitas udara berdasarkan data polutan dari sensor. Dengan menggunakan model regresi linear berganda, sistem ini dapat memprediksi Indeks Kualitas Udara (IKU) dan mengklasifikasikannya sesuai dengan kategori Indeks Standar Pencemar Udara (ISPU), membantu masyarakat untuk lebih waspada dan menjaga kesehatan mereka dari dampak buruk polusi udara.</p>
        </div>
    </div>
    <footer>
        <p><strong>Copyright &copy; 2024</strong></p>
    </footer>
</body>

</html>