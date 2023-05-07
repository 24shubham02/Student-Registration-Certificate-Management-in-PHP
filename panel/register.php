<!-- Retrieve user information from the database -->
<?php include "db.php"; ?>

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

// Create connection
$db = mysqli_connect($host, $username, $password, $dbname);
if (!$db) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $student_name = $_POST["student_name"];
    $course_name = $_POST["course_name"];
    $mobile_number = $_POST["mobile_number"];
    $email_id = $_POST["email_id"];
    $current_address = $_POST["current_address"];
    $permanent_address = $_POST["permanent_address"];
    $parents_contact_number = $_POST["parents_contact_number"];
    $aadhaar_number = $_POST["aadhaar_number"];
    $date_of_joining = $_POST["date_of_joining"];

    // Generate student ID
    $prefix = "RT23"; // Prefix for student ID
    $next_id = 1; // Starting number for student ID

    // Check if the generated ID already exists
    $query = "SELECT student_id FROM students WHERE student_id LIKE '$prefix%'";
    $result = mysqli_query($db, $query);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0) {
        // Extract the numeric part of the last student ID and increment it
        $last_id = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $current_id = intval(substr($row["student_id"], strlen($prefix)));
            $last_id = max($last_id, $current_id);
        }
        $next_id = $last_id + 1;
    }

    $student_id = $prefix . str_pad($next_id, 4, "0", STR_PAD_LEFT);

    // Insert new student into database
    $query = "INSERT INTO students (student_id, student_name, course_name, mobile_number, email_id, current_address, permanent_address, parents_contact_number, aadhaar_number, date_of_joining, isCertIssued) VALUES ('$student_id', '$student_name', '$course_name', '$mobile_number', '$email_id', '$current_address', '$permanent_address', '$parents_contact_number', '$aadhaar_number', '$date_of_joining', 0)";
    if (mysqli_query($db, $query)) {
        $success_message = "Student registered successfully.";
    } else {
        $error_message = "Error: " . mysqli_error($db);
    }
}
?>

<!-- HTML code for displaying success/error messages -->

<!DOCTYPE html>
<html>
<head>
    <title>Registration Result</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include "nav.php"; ?>
    <div class="container mt-5">
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
