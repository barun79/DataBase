<!-- Barun Singh (1002064749)
 -->
<?php
$servername = "localhost";
$username = "root";
$password ="";
$dname = "doctoral";

// Create connection
$conn = new mysqli($servername, $username, $password, $dname);

// Check connection
if($conn -> connect_error){
    die("Connecction failed: " . $conn->connect_error);
}

// ---------------------------  Query Part -------------------------------

$sql = "SELECT * FROM INSTRUCTOR";
$result = $conn ->query($sql);

echo "<table border = '1'><tr><th>InstructorID</th><th>FName</th><th>LName</th><th>StartDate</th><th>Degree</th><th>Rank</th><th>Type</th></tr>";
while ($row = $result->fetch_assoc()){
    echo "<tr><td>".$row["InstructorId"]."</td><td>".$row["FName"]."</td><td>".$row["LName"]."</td><td>".$row["StartDate"]."</td><td>".$row["Degree"]."</td><td>".$row["Rank"]."</td><td>".$row["Type"]."</td></tr>";
}
$conn->close();
?>

<a href = "index.html">Back to Main Page </a>