<!-- Barun Singh (1002064749)
 -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctoral";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $InstructorId = $_POST["InstructorId"] ?? '';
    $StudentId = $_POST["StudentId"] ?? '';

    if($InstructorId != '' && $StudentId != ''){
        $stmt = $conn->prepare("INSERT INTO PhdCommittee (StudentId, InstructorId) VALUES (?,?)");
        $stmt -> bind_param("ss", $StudentId, $InstructorId);

        if ($stmt->execute())
        {
            echo "Instructor linked successfully to Student! StudentId: " . $StudentId;
        }
        else {
            echo "Error adding Instructor: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Please fill in all the fields";
    } 
}


$conn->close();
?>

<a href="index.html">Back to Main Page</a>

