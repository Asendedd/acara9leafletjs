<!DOCTYPE html>
<html>
<head>
    <title>Hasil Input</title>
</head>
<body>
    <h1>Hasil Data Input</h1>

    <?php
    // Cek apakah data sudah dikirim melalui metode POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Ambil data yang dikirim dari form_input.php
        $kecamatan = $_POST['kecamatan'];
        $luas = $_POST['luas'];
        $penduduk = $_POST['penduduk'];

        // Tampilkan data yang sudah diproses (atau bisa juga di-insert ke database di sini)
        echo "<p>Kecamatan yang diinput: **" . htmlspecialchars($kecamatan) . "**</p>";
        echo "<p>Luas yang diinput: **" . htmlspecialchars($luas) . "**</p>";
        echo "<p>Jumlah Penduduk yang diinput: **" . htmlspecialchars($penduduk) . "**</p>";
        
    } else {
        // Jika diakses tanpa melalui form POST
        echo "<p>Akses tidak valid. Silakan isi form terlebih dahulu.</p>";
    }
    ?>

    <br>
    <a href="latihan7c.php">Kembali ke Form</a>

</body>
</html>