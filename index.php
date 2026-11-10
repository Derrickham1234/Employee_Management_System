<?php
require_once "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Management System</title>

    <link rel="stylesheet" href="style.css">
    <script src="js/validation.js" defer></script>
</head>

<body>

    <div class="container">

        <h1>Employee Management System</h1>

        <p>Register and manage company employees.</p>

        <div class="form-container">

            <h2>Employee Registration</h2>

            <form action="save_employee.php" method="POST"
                  onsubmit="return validateForm()">

                <label>Employee ID</label>
                <input type="text" id="id" name="id"
                       placeholder="Enter Employee ID" required>

                <label>Full Name</label>
                <input type="text" id="employee_name"
                       name="employee_name"
                       placeholder="Enter Full Name" required>

                <label>National ID</label>
                <input type="text" id="national_id"
                       name="national_id"
                       placeholder="Enter National ID" required>

                <label>Phone Number</label>
                <input type="tel" id="phone_number"
                       name="phone_number"
                       placeholder="Enter Phone Number" required>

                <label>Email Address</label>
                <input type="email" id="email" name="email"
                       placeholder="Enter Email Address" required>

                <label>Department</label>
                <select id="department" name="department" required>

                    <option value="">Select Department</option>
                    <option value="ICT">ICT</option>
                    <option value="Human Resources">Human Resources</option>
                    <option value="Finance">Finance</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Administration">Administration</option>

                </select>

                <div class="buttons">

                    <button type="submit" name="save">
                        Save Employee
                    </button>

                    <button type="reset" class="clear">
                        Clear Form
                    </button>

                </div>

            </form>

        </div>
      <!-- EMPLOYEE RECORDS SECTION -->

<div class="table-container">

    <h2>Registered Employees</h2>

    <?php

    // Retrieve all employee records
    $sql = "SELECT * FROM employees ORDER BY employee_name ASC";

    $result = $conn->query($sql);

    ?>

    <table>

        <thead>

            <tr>
                <th>Employee ID</th>
                <th>Full Name</th>
                <th>National ID</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>

        </thead>

        <tbody>

            <?php

            // Check whether employee records exist
            if ($result && $result->num_rows > 0) {

                // Display employee records
                while ($row = $result->fetch_assoc()) {

            ?>

            <tr>

                <td><?php echo htmlspecialchars($row['id']); ?></td>

                <td><?php echo htmlspecialchars($row['employee_name']); ?></td>

                <td><?php echo htmlspecialchars($row['national_id']); ?></td>

                <td><?php echo htmlspecialchars($row['phone_number']); ?></td>

                <td><?php echo htmlspecialchars($row['email']); ?></td>

                <td><?php echo htmlspecialchars($row['department']); ?></td>

                <td>

                    <a href="edit_employee.php?id=<?php echo urlencode($row['id']); ?>">
                        Edit
                    </a>

                    |

                    <a href="delete_employee.php?id=<?php echo urlencode($row['id']); ?>"
                       onclick="return confirm('Are you sure you want to delete this employee?')">
                        Delete
                    </a>

                </td>

            </tr>

            <?php

                }

            } else {

                echo "<tr><td colspan='7'>No employees registered yet.</td></tr>";

            }

            ?>

        </tbody>

    </table>

</div>  
    </div>

</body>
</html>