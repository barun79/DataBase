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

$sql = "SELECT P.FName, P.LName, M.StudentId , M.MId, M.PassDate FROM milestonespassed M, phdstudent P WHERE P.StudentId = M.StudentId";
$result = $conn ->query($sql);

echo "<table border = '1'><tr><th>FName</th><th>LName</th><th>StudentId</th><th>MId</th><th>PassDate</th></tr>";
while ($row = $result->fetch_assoc()){
    echo "<tr><td>".$row["FName"]."</td><td>".$row["LName"]."</td><td>".$row["StudentId"]."</td><td>".$row["MId"]."</td><td>".$row["PassDate"]."</td></tr>";
}
$conn->close();
?>

<a href = "index.html">Back to Main Page </a>