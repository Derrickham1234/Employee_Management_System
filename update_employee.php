<?php

// Connect to database
require_once "db.php";

// Check whether the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect updated employee information
    $id = trim($_POST["id"]);
    $employee_name = trim($_POST["employee_name"]);
    $national_id = trim($_POST["national_id"]);
    $phone_number = trim($_POST["phone_number"]);
    $email = trim($_POST["email"]);
    $department = trim($_POST["department"]);

    // Validate required fields
    if (
        empty($id) ||
        empty($employee_name) ||
        empty($national_id) ||
        empty($phone_number) ||
        empty($email) ||
        empty($department)
    ) {
        die("Error: All fields are required.");
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email address.");
    }

    // SQL UPDATE statement
    $sql = "UPDATE employees SET
            employee_name = ?,
            national_id = ?,
            phone_number = ?,
            email = ?,
            department = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param(
        "ssssss",
        $employee_name,
        $national_id,
        $phone_number,
        $email,
        $department,
        $id
    );

    // Execute update
    if ($stmt->execute()) {

        header("Location: index.php");
        exit;

    } else {

        echo "Error updating employee: " . htmlspecialchars($stmt->error);

    }

    // Close statement
    $stmt->close();

} else {

    echo "Invalid request.";

}

// Close connection
$conn->close();

?>