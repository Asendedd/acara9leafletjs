<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Peta Wilayah Kecamatan Yogyakarta</title>

    <!-- Load Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <style>
        #map {
            height: 600px;
            width: 100%;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>

<h2>Peta Wilayah Kecamatan</h2>
<div id="map"></div>

<!-- Load Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<?php
// Koneksi ke database
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "mysql";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data wilayah
$sql = "SELECT * FROM data_kecamatan";
$result = $conn->query($sql);

// Simpan hasil query ke array
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Tutup koneksi
$conn->close();

// Ubah data ke format JSON untuk digunakan di JavaScript
echo "<script>const dataWilayah = " . json_encode($data) . ";</script>";
?>

<script>
// Inisialisasi peta
const map = L.map('map');

// Tambahkan tile layer dari OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 20,
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

// Array untuk menyimpan posisi marker
let markers = [];

if (dataWilayah.length > 0) {
    // Loop melalui data dan tambahkan marker
    dataWilayah.forEach(function(wilayah) {
        if (wilayah.latitude && wilayah.longitude) {
            const marker = L.marker([wilayah.latitude, wilayah.longitude]).addTo(map);
            marker.bindPopup("<b>" + wilayah.kecamatan + "</b><br>Luas: " + wilayah.luas + " km²<br>Jumlah Penduduk: " + wilayah.jumlah_penduduk);
            markers.push(marker);
        }
    });

    // Atur view peta berdasarkan marker pertama
    if (markers.length > 0) {
        map.setView([dataWilayah[0].latitude, dataWilayah[0].longitude], 13);
    } else {
        // Fallback view jika tidak ada marker
        map.setView([-7.7956, 110.3695], 12); // Default view of Yogyakarta
    }
} else {
    // Fallback view jika tidak ada data
    map.setView([-7.7956, 110.3695], 12); // Default view of Yogyakarta
}
</script>
</body>
</html>