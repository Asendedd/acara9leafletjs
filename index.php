<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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

    // SQL query is correct and includes all 6 columns
    $sql = "SELECT id, kecamatan, luas, jumlah_penduduk, longitude, latitude FROM data_kecamatan";
    $result = $conn->query($sql);

    echo "<a href='input/index.html'>Input</a>";

    if ($result->num_rows > 0) {

        // versi Edit
        echo "<table border='1px'><tr> 
        <th>Kecamatan</th> 
        <th>Longitude</th> 
        <th>Latitude</th> 
        <th>Luas</th> 
        <th>Jumlah Penduduk</th> 
        <th colspan='2'>Aksi</th>";
        
  // output data of each row 
    while($row = $result->fetch_assoc()) { 
    echo "<tr><td>".$row["kecamatan"]."</td>". 
        "<td>".$row["longitude"]."</td>". 
        "<td>".$row["latitude"]."</td>".   
        "<td>".$row["luas"]."</td>". 
        "<td align='right'>".$row["jumlah_penduduk"]."</td>". 
        "<td><a href=delete.php?id=".$row["id"].">hapus</a></td>". 
                "<td><a href=edit/index.php?id=".$row["id"].">edit</a></td>". 
        "</tr>"; 
    } 
    echo "</table>"; 

    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
    
</body>
</html>