<!-- Barun Singh (1002064749)
 -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctoral";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $GRAId = $_POST["StudentId"] ?? '';

    // Validate input
    if ($GRAId != '') {
        // Check if the student is a GRA student
        $check_query_GRA = "SELECT * FROM GRA WHERE StudentId = ?";
        $check_stmt_GRA = $conn->prepare($check_query_GRA);
        $check_stmt_GRA->bind_param("i", $GRAId);
        $check_stmt_GRA->execute();
        $result_GRA = $check_stmt_GRA->get_result();
        if ($result_GRA->num_rows > 0) {
            // Check if the student has passed any milestone
            $check_query = "SELECT * FROM MILESTONESPASSED WHERE StudentId = ? LIMIT 1";
            $check_stmt = $conn->prepare($check_query);
            $check_stmt->bind_param("i", $GRAId);
            $check_stmt->execute();
            $result = $check_stmt->get_result();

            if ($result->num_rows == 0) {
                // No milestone found, safe to delete the student
                $delete_query_GRA = "DELETE FROM GRA WHERE StudentId = ?";
                $delete_stmt_GRA = $conn->prepare($delete_query_GRA);
                $delete_stmt_GRA->bind_param("i", $GRAId);

                $delete_query_PhD = "DELETE FROM PhDstudent WHERE StudentId = ?";
                $delete_stmt_PhD = $conn->prepare($delete_query_PhD);
                $delete_stmt_PhD->bind_param("i", $GRAId);

                // Execute GRA deletion
                if ($delete_stmt_GRA->execute()) {
                    echo "GRA student deleted successfully.";
                } else {
                    echo "Error deleting GRA student: " . $conn->error;
                }

                // Execute PhD student deletion
                if ($delete_stmt_PhD->execute()) {
                    echo "PhD student deleted successfully.";
                } else {
                    echo "Error deleting PhD student: " . $conn->error;
                }
            } else {
                echo "The GRA student has passed milestone(s) and cannot be deleted.";
            }
        } else {
            echo "The provided student ID does not belong to a GRA student.";
        }    
    } else {
        echo "Please fill in all the fields.";
    }
}

$conn->close();
?>
<a href="index.html">Back to Main Page</a>