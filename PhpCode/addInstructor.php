<!-- Barun Singh (1002064749)
 -->
<?php
$servername = "localhost";
$username = "root";
$password ="";
$dname = "doctoral";

$conn = new mysqli($servername, $username, $password, $dname);

if($conn -> connect_error){
    die("Connecction failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $InstructorId = $_POST["InstructorId"] ?? '';
    $FName = $_POST["FName"] ?? '';
    $LName = $_POST["LName"] ?? '';
    $StartDate = $_POST["StartDate"] ?? '';
    $Degree = $_POST["Degree"] ?? '';
    $Rank = $_POST["Rank"] ?? '';
    $Type = $_POST["Type"] ?? '';

    if($InstructorId != '' && $FName != '' && $LName != '' && $StartDate != '' && $Degree != '' && $Rank != '' && $Type != ''){
        $stmt = $conn->prepare("INSERT INTO INSTRUCTOR (InstructorId, FName, LName, StartDate, Degree, Rank, Type) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $InstructorId, $FName, $LName, $StartDate, $Degree, $Rank, $Type);

        if($stmt->execute()){
            echo "Instructor added successfully. InstructorId: " . $InstructorId;
        } else {
            echo "Failed to add instructor.";
        }
    } else {
        echo "Please fill in all the fields.";
    }
}

$conn->close();
?>


<a href = "index.html">Back to Main Page </a>