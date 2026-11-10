// Employee Registration Form Validation

function validateForm() {

    // Get form values
    let employeeID = document.getElementById("id").value.trim();

    let fullName = document.getElementById("employee_name").value.trim();

    let nationalID = document.getElementById("national_id").value.trim();

    let phoneNumber = document.getElementById("phone_number").value.trim();

    let emailAddress = document.getElementById("email").value.trim();

    let department = document.getElementById("department").value;

    // Check whether required fields are empty
    if (
        employeeID === "" ||
        fullName === "" ||
        nationalID === "" ||
        phoneNumber === "" ||
        emailAddress === "" ||
        department === ""
    ) {

        alert("Please fill in all employee details.");

        return false;
    }

    // Validate email address
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(emailAddress)) {

        alert("Please enter a valid email address.");

        return false;
    }

    // Validate employee name
    if (!/^[a-zA-Z\s'-]+$/.test(fullName)) {

        alert("Please enter a valid employee name.");

        return false;
    }

    // Confirm submission
    alert("Employee information validated successfully!");

    return true;
}