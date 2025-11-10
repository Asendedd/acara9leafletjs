<!DOCTYPE html> 
<html> 
<body> 
<h2>Form Edit</h2> 
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
    $sql = "SELECT * FROM penduduk WHERE id = $id"; 
    $result = $conn->query($sql); 

    if ($result->num_rows > 0) { 
        echo "<form action='edit.php' onsubmit='return validateForm()' method='post'>"; 
        while($row = $result->fetch_assoc()) { 
            echo "<input type='hidden' name='id' value='".$row['id']."'><br>"; 
            echo "<label for='kecamatan'>Kecamatan:</label><br>"; 
            echo "<input type='text' id='kec' name='kecamatan' value='".$row['kecamatan']."'><br>"; 
            echo "<label for='kecamatan'>Longitude:</label><br>"; 
            echo "<input type='text' id='long' name='longitude' value='".$row['longitude']."'><br>"; 
            echo "<label for='kecamatan'>Latitude:</label><br>"; 
            echo "<input type='text' id='lat' name='latitude' value='".$row['latitude']."'><br>"; 
            echo "<label for='luas'>Luas:</label><br>"; 
            echo "<input type='text' id='luas' name='luas' value='".$row['luas']."'><br>"; 
            echo "<label for='jumlah_penduduk'>Jumlah Penduduk:</label><br>"; 
            echo "<input type='text' id='jml_pddk' name='jumlah_penduduk' 
value='".$row['jumlah_penduduk']."'><br><br>"; 
        } 
        echo "<input type='submit' value='Submit'>";     
        echo "</form>";  
    }    
?> 

<p id="informasi"></p> 

<script> 
    function validateForm() { 

        let luas = document.getElementById("luas").value; 
        let text=""; 
        if (isNaN(luas) || luas < 1) { 
        text = "Data luas harus angka dan tidak boleh bernilai negatif"; 
        // stop the form submission 
        event.preventDefault(); 
        }  

        document.getElementById("informasi").innerHTML = text; 
    } 
</script> 
</body> 
</html>