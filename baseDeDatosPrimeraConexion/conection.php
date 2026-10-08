<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

try {
  $sql = "INSERT INTO usuario (nombre, apellidos, email, contrasena) VALUES (?, ?, ?, ?)";
  // Prepare the SQL query template
  $stmt = $conn->prepare($sql);
  // Execute with values
  $stmt->execute(['John', 'Doe', 'john@example.com', '1234']);
  $stmt->execute(['Mary', 'Moe', 'mary@example.com', '23124']);
  $stmt->execute(['Julie', 'Dooley', 'julie@example.com', '124325']);
  echo "New records created successfully";
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

$stmt = null;
$conn = null;
