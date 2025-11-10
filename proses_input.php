<?php
//koneksi to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mysql";

//Membuat Koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

//Cek Koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data yang dikirim dari form
$kecamatan = $_POST['kecamatan'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$luas = $_POST['luas'];
$jumlah_penduduk = $_POST['jumlah_penduduk'];

// prepare and bind
$stmt = $conn->prepare("INSERT INTO data_kecamatan (kecamatan, longitude, latitude, luas, jumlah_penduduk) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sddii", $kecamatan, $longitude, $latitude, $luas, $jumlah_penduduk);

// execute and check
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: index.php");
?>