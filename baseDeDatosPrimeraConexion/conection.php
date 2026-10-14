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

/*try {
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
}*/
/*
try {
  $sql = "SELECT nombre, apellidos, email, contrasena FROM usuario";
  // Execute the SQL query
  $result = $conn->query($sql);
  // Process the result set
  if ($result->rowCount() > 0) {
    echo "<table><tr><th>ID</th><th>Firstname</th><th>Lastname</th></tr>";
    // Output data of each row
    while($row = $result->fetch()) {
      echo "<tr>";
      echo "<td>" . $row['nombre'] . "</td>";
      echo "<td>" . $row['apellidos'] . "</td>";
      echo "<td>" . $row['email'] . "</td>";
      echo "<td>" . $row['contrasena'] . "</td>";
      echo "</tr>";
    }
    echo "</table>";
    unset($result);
  } else {
    echo "No records found.";
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}*/

/*try {
  $sql = "SELECT nombre, apellidos, email, contrasena FROM usuario";
  // Execute the SQL query
  $result = $conn->query($sql);
  // Process the result set
  if ($result->rowCount() > 0) {
    echo "<table><tr><th>ID</th><th>Firstname</th><th>Lastname</th></tr>";
    // Output data of each row
    $rows = $result ->fetchAll();
    while($row = $result->fetch()) {
      echo "<tr>";
      echo "<td>" . $row['nombre'] . "</td>";
      echo "<td>" . $row['apellidos'] . "</td>";
      echo "<td>" . $row['email'] . "</td>";
      echo "<td>" . $row['contrasena'] . "</td>";
      echo "</tr>";
    }
    echo "</table>";
    unset($result);
  } else {
    echo "No records found.";
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}*/

$q = intval($_GET['q']);

$sql= "SELECT nombre, apellidos, email, contrasena FROM usuario WHERE id = '".$q."'";
$result = $conn->query($sql);

echo "<table>
  <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Age</th>
    <th>Hometown</th>
    <th>Job</th>
  </tr>";
  
while($row = $result->fetch()) {
  echo "<tr>";
  echo "<td>" . $row['nombre'] . "</td>";
  echo "<td>" . $row['apellidos'] . "</td>";
  echo "<td>" . $row['email'] . "</td>";
  echo "<td>" . $row['contrasena'] . "</td>";
  echo "</tr>";
}
echo "</table>";

$stmt = null;
$conn = null;
