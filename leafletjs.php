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
$dbname     = "data_kecamatan";

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
// Inisialisasi peta tanpa posisi awal
const map = L.map('map');

// Tambahkan tile layer dari OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 20,
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

// Array untuk menyimpan posisi marker
let markers = [];