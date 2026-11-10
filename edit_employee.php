<?php

require_once "db.php";

// Check whether employee ID was provided
if (!isset($_GET['id'])) {
    die("Employee ID not provided.");
}

$id = $_GET['id'];

// Retrieve employee details
$sql = "SELECT * FROM employees WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Employee not found.");
}

$employee = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="form-container">

        <h2>Update Employee Information</h2>

        <form action="update_employee.php" method="POST">

            <label>Employee ID</label>

            <input type="text" name="id"
                   value="<?php echo htmlspecialchars($employee['id']); ?>"
                   readonly>

            <label>Full Name</label>

            <input type="text" name="employee_name"
                   value="<?php echo htmlspecialchars($employee['employee_name']); ?>"
                   required>

            <label>National ID</label>

            <input type="text" name="national_id"
                   value="<?php echo htmlspecialchars($employee['national_id']); ?>"
                   required>

            <label>Phone Number</label>

            <input type="tel" name="phone_number"
                   value="<?php echo htmlspecialchars($employee['phone_number']); ?>"
                   required>

            <label>Email Address</label>

            <input type="email" name="email"
                   value="<?php echo htmlspecialchars($employee['email']); ?>"
                   required>

            <label>Department</label>

            <input type="text" name="department"
                   value="<?php echo htmlspecialchars($employee['department']); ?>"
                   required>

            <div class="buttons">

                <button type="submit">Update Employee</button>

                <a href="index.php">Cancel</a>

            </div>

        </form>

    </div>

</div>

</body>
</html>