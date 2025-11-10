<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Kecamatan</title>
    <!-- Load Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="h4 mb-0">Form Input Data Kecamatan</h2>
        </div>
        <div class="card-body">
            <form action="../proses_input.php" method="post">
                <div class="mb-3">
                    <label for="kecamatan" class="form-label">Kecamatan:</label>
                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                </div>
                <div class="mb-3">
                    <label for="longitude" class="form-label">Longitude:</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" required>
                </div>
                <div class="mb-3">
                    <label for="latitude" class="form-label">Latitude:</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" required>
                </div>
                <div class="mb-3">
                    <label for="luas" class="form-label">Luas (km²):</label>
                    <input type="text" class="form-control" id="luas" name="luas" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah_penduduk" class="form-label">Jumlah Penduduk:</label>
                    <input type="text" class="form-control" id="jumlah_penduduk" name="jumlah_penduduk" required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="../index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form> 
        </div>
    </div>
</div>

<!-- Load Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
