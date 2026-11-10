<?php

// Connect to the database
require_once "db.php";

// Check whether the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect employee information
    $id = trim($_POST["id"]);
    $employee_name = trim($_POST["employee_name"]);
    $national_id = trim($_POST["national_id"]);
    $phone_number = trim($_POST["phone_number"]);
    $email = trim($_POST["email"]);
    $department = trim($_POST["department"]);

    // Validate required fields on the server
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

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email address.");
    }

    // Prepare SQL INSERT statement
    $sql = "INSERT INTO employees
            (id, employee_name, national_id, phone_number, email, department)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    // Bind employee information
    $stmt->bind_param(
        "ssssss",
        $id,
        $employee_name,
        $national_id,
        $phone_number,
        $email,
        $department
    );

    // Execute the SQL statement
    if ($stmt->execute()) {
        echo "<h2>Employee Registered Successfully!</h2>";

       header("Location: index.php");
        exit;

    } else {

        if ($stmt->errno == 1062) {
            echo "Error: This Employee ID already exists.";
        } else {
            echo "Error: Unable to register employee.";
        }

    }

    // Close statement
    $stmt->close();

} else {

    echo "Invalid request.";

}

// Close database connection
$conn->close();

?>