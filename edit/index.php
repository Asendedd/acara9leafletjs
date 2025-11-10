<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kecamatan</title>
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
            <h2 class="h4 mb-0">Form Edit Data Kecamatan</h2>
        </div>
        <div class="card-body">
            <?php 
            // Sesuaikan dengan setting MySQL 
            $servername = "localhost"; 
            $username = "root"; 
            $password = ""; 
            $dbname = "mysql"; 

            // Create connection 
            $conn = new mysqli($servername, $username, $password, $dbname); 

            // Check connection 
            if ($conn->connect_error) { 
                die("Connection failed: " . $conn->connect_error); 
            } 

            $id = $_GET['id']; 
            $sql = "SELECT * FROM data_kecamatan WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result(); 

            if ($result->num_rows > 0) { 
                $row = $result->fetch_assoc();
            ?>
            <form action="edit.php" onsubmit="return validateForm()" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                
                <div class="mb-3">
                    <label for="kecamatan" class="form-label">Kecamatan:</label>
                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="<?php echo $row['kecamatan']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="longitude" class="form-label">Longitude:</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" value="<?php echo $row['longitude']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="latitude" class="form-label">Latitude:</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" value="<?php echo $row['latitude']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="luas" class="form-label">Luas (km²):</label>
                    <input type="text" class="form-control" id="luas" name="luas" value="<?php echo $row['luas']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah_penduduk" class="form-label">Jumlah Penduduk:</label>
                    <input type="text" class="form-control" id="jumlah_penduduk" name="jumlah_penduduk" value="<?php echo $row['jumlah_penduduk']; ?>" required>
                </div>
                
                <div id="informasi" class="text-danger mb-3"></div>

                <div class="d-flex justify-content-between">
                    <a href="../index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            <?php
            } else {
                echo "<div class='alert alert-danger'>Data tidak ditemukan.</div>";
            }
            $stmt->close();
            $conn->close();
            ?>
        </div>
    </div>
</div>

<script> 
    function validateForm() { 
        let luas = document.getElementById("luas").value; 
        let text = ""; 
        if (isNaN(luas) || luas < 1) { 
            text = "Data luas harus angka dan tidak boleh bernilai negatif."; 
            document.getElementById("informasi").innerHTML = text; 
            return false; // stop the form submission
        }  
        return true;
    } 
</script> 

<!-- Load Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>