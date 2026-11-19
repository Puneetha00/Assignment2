
<?php
$success = false;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"] ?? "");
    $dob = $_POST["dob"] ?? "";
    $gender = $_POST["gender"] ?? "";
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $address = trim($_POST["address"] ?? "");
    $course = $_POST["course"] ?? "";
    $qualification = $_POST["qualification"] ?? "";

    // Server-side validation
    if ($name == "") {
        $errors[] = "Name is required";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Enter a valid email address";
    }

    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        $errors[] = "Enter a valid 10-digit phone number";
    }

    if ($dob == "" || $gender == "" || $address == "" ||
        $course == "" || $qualification == "") {
        $errors[] = "Please fill all the required fields";
    }

    if (empty($errors)) {
        $success = true;
    }
}

function safe($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>

    <link rel="stylesheet" href="style.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="script.js"></script>
</head>

<body>

<header>
    <h1>Student Registration Portal</h1>
    <p>Register yourself for your desired course</p>
</header>

<?php if ($success): ?>

    <div class="result">
        <h2>Registration Successful!</h2>
        <p>Your application has been submitted successfully.</p>

        <div class="details">
            <h3>Registration Details</h3>

            <p><b>Name:</b> <?php echo safe($name); ?></p>
            <p><b>Date of Birth:</b> <?php echo safe($dob); ?></p>
            <p><b>Gender:</b> <?php echo safe($gender); ?></p>
            <p><b>Email:</b> <?php echo safe($email); ?></p>
            <p><b>Phone:</b> <?php echo safe($phone); ?></p>
            <p><b>Address:</b> <?php echo safe($address); ?></p>
            <p><b>Course:</b> <?php echo safe($course); ?></p>
            <p><b>Qualification:</b> <?php echo safe($qualification); ?></p>
        </div>

        <button onclick="window.print()">Print Application</button>

        <a href="index.php" class="back">New Registration</a>
    </div>

<?php else: ?>

    <div class="form-container">

        <h2>Registration Form</h2>

        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo safe($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form id="registrationForm" method="POST" action="index.php">

            <label>Full Name</label>
            <input type="text" name="name" id="name"
                   placeholder="Enter your full name" required>

            <label>Date of Birth</label>
            <input type="date" name="dob" id="dob" required>

            <label>Gender</label>
            <select name="gender" id="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label>Email Address</label>
            <input type="email" name="email" id="email"
                   placeholder="Enter your email" required>

            <label>Phone Number</label>
            <input type="tel" name="phone" id="phone"
                   placeholder="Enter 10 digit number"
                   maxlength="10" required>

            <label>Address</label>
            <textarea name="address" id="address"
                      placeholder="Enter your address" required></textarea>

            <label>Select Course</label>
            <select name="course" id="course" required>
                <option value="">Select Course</option>
                <option value="Computer Science">Computer Science</option>
                <option value="Information Science">Information Science</option>
                <option value="Electronics">Electronics</option>
                <option value="Mechanical">Mechanical</option>
            </select>

            <label>Qualification</label>
            <select name="qualification" id="qualification" required>
                <option value="">Select Qualification</option>
                <option value="PUC">PUC</option>
                <option value="Diploma">Diploma</option>
                <option value="Degree">Degree</option>
            </select>

            <button type="submit">Submit Registration</button>

        </form>
    </div>

<?php endif; ?>

<footer>
    <p>Student Registration Portal | 2026</p>
</footer>

</body>
</html>
