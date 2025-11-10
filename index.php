<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Data Kecamatan</title>
    <!-- Load Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Load Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 450px;
            width: 100%;
            border-radius: 0.375rem; /* Match bootstrap's border radius */
        }
        body {
            background-color: #f8f9fa;
        }
        .container {
            padding-top: 20px;
        }
        .table-actions {
            white-space: nowrap;
            width: 1%;
        }
    </style>
</head>
<body>

    <div class="container">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Dashboard Data Kecamatan</h1>
            <a href='input/index.php' class="btn btn-primary">Input Data Baru</a>
        </header>

        <div class="card shadow-sm mb-4">
            <div class="card-header">
                Peta Wilayah Kecamatan
            </div>
            <div class="card-body">
                <div id="map"></div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">
                Tabel Data
            </div>
            <div class="card-body">
                <div class="table-responsive">
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

                    // SQL query
                    $sql = "SELECT id, kecamatan, luas, jumlah_penduduk, longitude, latitude FROM data_kecamatan";
                    $result = $conn->query($sql);

                    $data_for_map = []; // Array to hold data for the map

                    if ($result->num_rows > 0) {
                        echo "<table class='table table-striped table-hover caption-top'>
                                <caption>List of regions</caption>
                                <thead class='table-dark'>
                                    <tr> 
                                        <th>Kecamatan</th> 
                                        <th>Longitude</th> 
                                        <th>Latitude</th> 
                                        <th>Luas (km²)</th> 
                                        <th>Jumlah Penduduk</th> 
                                        <th class='text-center'>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>";
                        
                        while($row = $result->fetch_assoc()) { 
                            $data_for_map[] = $row; // Add row to map data array
                            echo "<tr>
                                    <td>".$row["kecamatan"]."</td>". 
                                    "<td>".$row["longitude"]."</td>". 
                                    "<td>".$row["latitude"]."</td>".   
                                    "<td>".$row["luas"]."</td>". 
                                    "<td class='text-end'>".number_format($row["jumlah_penduduk"])."</td>". 
                                    "<td class='table-actions text-center'>
                                        <a href='edit/index.php?id=".$row["id"]."' class='btn btn-sm btn-outline-primary'>Edit</a>
                                        <a href='delete/delete.php?id=".$row["id"]."' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Are you sure you want to delete this item?\");'>Hapus</a>
                                    </td>". 
                                  "</tr>"; 
                        } 
                        echo "</tbody></table>"; 

                    } else {
                        echo "<div class='alert alert-info'>Tidak ada data untuk ditampilkan. Silakan <a href='input/index.php' class='alert-link'>input data baru</a>.</div>";
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Load Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Load Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    
    <?php
    // Ubah data ke format JSON untuk digunakan di JavaScript
    echo "<script>const dataWilayah = " . json_encode($data_for_map) . ";</script>";
    ?>

    <script>
    // Inisialisasi peta
    const map = L.map('map');

    // Tambahkan tile layer dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    if (dataWilayah.length > 0) {
        const markers = [];
        dataWilayah.forEach(function(wilayah) {
            if (wilayah.latitude && wilayah.longitude) {
                const marker = L.marker([wilayah.latitude, wilayah.longitude]);
                marker.bindPopup("<b>" + wilayah.kecamatan + "</b><br>Luas: " + wilayah.luas + " km²<br>Jumlah Penduduk: " + wilayah.jumlah_penduduk);
                markers.push(marker);
            }
        });

        const featureGroup = L.featureGroup(markers).addTo(map);
        map.fitBounds(featureGroup.getBounds().pad(0.1)); // Zoom to fit all markers

    } else {
        map.setView([-7.7956, 110.3695], 12); // Default view of Yogyakarta
    }
    </script>
    
</body>
</html>