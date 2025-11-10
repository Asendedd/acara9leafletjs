<?php 
$id = $_GET['id']; 
  
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

// prepare and bind
$stmt = $conn->prepare("DELETE FROM data_kecamatan WHERE id = ?");
$stmt->bind_param("i", $id);

// execute and check
if ($stmt->execute()) { 
  echo "Record with id = $id deleted successfully"; 
} else { 
  echo "Error: " . $stmt->error; 
} 

$stmt->close();
$conn->close(); 
header("Location: ../index.php"); 
?>