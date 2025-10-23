<?php
// Fungsi untuk melakukan perhitungan regresi linear
function multipleLinearRegression($pm10, $pm25, $no2, $co, $o3)
{
    // Konversi variabel ke tipe data float jika diperlukan
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
