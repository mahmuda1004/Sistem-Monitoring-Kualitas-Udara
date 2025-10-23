# 🌤️ Sistem Monitoring Kualitas Udara (Air Quality Monitoring System)

Proyek ini merupakan sistem berbasis web untuk **memantau kualitas udara secara real-time** menggunakan data sensor yang terhubung ke **cloud server Antares IoT**.  
Sistem menampilkan hasil pengukuran polutan udara seperti **PM2.5, PM10, CO, NO₂, dan O₃** serta **Indeks Kualitas Udara (IKU)** yang diperbarui secara otomatis.  

---

## 📋 Daftar Isi
- [Deskripsi Proyek](#-deskripsi-proyek)
- [Fitur Utama](#-fitur-utama)
- [Struktur Tampilan](#-struktur-tampilan)
  - [Dashboard](#1-dashboard)
  - [History](#2-history)
  - [About](#3-about)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)

---

## 🧭 Deskripsi Proyek

Sistem ini dirancang untuk **memantau, menampilkan, dan menganalisis kualitas udara** berdasarkan data dari sensor yang terhubung ke jaringan IoT.  
Data diperoleh secara **real-time** dari **Antares Cloud Server**, lalu disimpan dalam **basis data MySQL** dan ditampilkan melalui antarmuka web yang **interaktif dan responsif**.

Proyek ini terdiri dari tiga menu utama:
1. **Dashboard** — menampilkan data terkini kualitas udara.  
2. **History** — menampilkan riwayat data dan tren kualitas udara.  
3. **About** — memberikan informasi tentang sistem, metode, sensor, dan kategori ISPU.

---

## 🚀 Fitur Utama

✅ Monitoring data kualitas udara **secara real-time**  
✅ Menampilkan nilai **PM2.5, PM10, CO, NO₂, O₃**, dan **IKU**  
✅ Grafik dan tabel interaktif untuk memvisualisasikan data  
✅ Indikator warna kategori **Indeks Standar Pencemar Udara (ISPU)**  
✅ Fitur **download data dalam format CSV**  
✅ Tampilan **responsif** untuk perangkat desktop dan seluler  
✅ Informasi sensor dan metode yang digunakan pada halaman **About**  

---

## 🖥️ Struktur Tampilan

### 1️⃣ Dashboard
<img width="436" height="419" alt="Dashboard" src="https://github.com/user-attachments/assets/59a059c9-ba43-4df2-8401-58db9abed311" />

Menampilkan:
- Data variabel polutan udara secara **real-time** dari **Antares Cloud Server**.  
- **Indeks kualitas udara (IKU)** dan **kategori ISPU** (Baik, Sedang, Tidak Sehat, dll).  
- **Saran tindakan** berdasarkan kondisi udara.  
- **Diagram batang (bar chart)** dengan indikator warna kualitas udara.  
- Lokasi sensor yang digunakan.

> Tampilan ini berfungsi sebagai halaman utama sistem.

---

### 2️⃣ History
<img width="397" height="335" alt="History1" src="https://github.com/user-attachments/assets/0fd89ef9-2791-4664-8809-158b6bf85162" />
<img width="377" height="178" alt="History2" src="https://github.com/user-attachments/assets/4c53d457-111a-47e9-8638-bf4d1e92e9a0" />


Berisi:
- **Riwayat data kualitas udara** dalam bentuk tabel yang informatif.  
- **Grafik perubahan kualitas udara** dari waktu ke waktu.  
- Tombol untuk **mengunduh data CSV**.  
- Desain tabel dapat **digulir horizontal** agar nyaman dilihat di layar kecil.

> Halaman ini membantu pengguna menganalisis tren polusi udara berdasarkan waktu.

---

### 3️⃣ About
<img width="483" height="410" alt="About1" src="https://github.com/user-attachments/assets/e5b9c82d-5118-49d7-9ad7-3a0f3ef39bae" />
<img width="522" height="338" alt="About2" src="https://github.com/user-attachments/assets/a0af59b7-6d8c-4859-830b-569e0688306c" />
<img width="469" height="393" alt="About3" src="https://github.com/user-attachments/assets/e0eb963a-4484-4a81-adbd-e28673f8a589" />


Menjelaskan:
- **Tujuan pengembangan sistem monitoring kualitas udara.**  
- **Metode dan model prediksi** (misalnya regresi linear berganda).  
- **Sumber dan pembagian data**, serta **evaluasi model (R² dan RMSE)**.  
- **Kategori ISPU** dengan warna dan batas nilai masing-masing.  
- **Informasi sensor yang digunakan**, yaitu:
  - MiCS-4514 (CO & NO₂)
  - PM2.5 Sensor (PM10 & PM2.5)
  - MQ-131 (O₃)
  - Node Sensor (pengirim data ke Antares)

> Halaman ini juga menampilkan **gambar sensor** untuk memperjelas perangkat yang digunakan.

---

## ⚙️ Teknologi yang Digunakan

| Komponen | Teknologi |
|-----------|------------|
| **Frontend** | HTML, CSS, JavaScript |
| **Backend** | PHP |
| **Database** | MySQL |
| **Cloud IoT** | Antares (IoT Cloud by Telkom Indonesia) |
| **Visualisasi** | Chart.js |
| **Format Ekspor** | CSV |
| **Hosting / Deployment** | GitHub Pages / Localhost |

---


