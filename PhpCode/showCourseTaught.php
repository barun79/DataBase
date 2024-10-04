<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctoral";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}


//---------------Query Part----------------

$sql = "SELECT  I.FName, I.LName, C.* FROM coursestaught C, instructor I WHERE C.InstructorId = I.InstructorId";
$result = $conn->query($sql);

echo "<table border='1'><tr><th>InstructorFName</th><th>InstructorLName</th><th>InstructorId</th><th>CourseID</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["FName"]."</td><td>".$row["LName"]."</td><td>".$row["InstructorId"]."</td><td>".$row["CourseID"]."</td></tr>";
}
echo "</table>";
$conn->close();

?>

<a href="index.html">Back to Main Page</a>