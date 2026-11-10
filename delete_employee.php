<?php

// Connect to database
require_once "db.php";

// Check whether employee ID was provided
if (isset($_GET['id'])) {

    // Collect employee ID
    $id = $_GET['id'];

    // Prepare DELETE SQL statement
    $sql = "DELETE FROM employees WHERE id = ?";

    $stmt = $conn->prepare($sql);

    // Bind employee ID
    $stmt->bind_param("s", $id);

    // Execute DELETE operation
    if ($stmt->execute()) {

        if ($stmt->affected_rows > 0) {

            echo "<h2>Employee Deleted Successfully!</h2>";

        } else {

            echo "<h2>Employee Record Not Found!</h2>";

        }

        header("Location: index.php");
        exit;

    } else {

        echo "Error deleting employee.";

    }

    // Close statement
    $stmt->close();

} else {

    echo "Employee ID is required.";

}

// Close database connection
$conn->close();

?>