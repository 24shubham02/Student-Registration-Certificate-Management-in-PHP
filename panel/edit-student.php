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
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $student_id = $_POST["student_id"];
    $student_name = $_POST["student_name"];
    $course_name = $_POST["course_name"];
    $mobile_number = $_POST["mobile_number"];
    $email_id = $_POST["email_id"];
    $current_address = $_POST["current_address"];
    $permanent_address = $_POST["permanent_address"];
    $parents_contact_number = $_POST["parents_contact_number"];
    $aadhaar_number = $_POST["aadhaar_number"];
    $date_of_joining = $_POST["date_of_joining"];

    // Update student in the database
    $query =
        "UPDATE students SET student_name = :student_name, course_name = :course_name, mobile_number = :mobile_number, email_id = :email_id, current_address = :current_address, permanent_address = :permanent_address, parents_contact_number = :parents_contact_number, aadhaar_number = :aadhaar_number, date_of_joining = :date_of_joining WHERE student_id = :student_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":student_name", $student_name);
    $stmt->bindParam(":course_name", $course_name);
    $stmt->bindParam(":mobile_number", $mobile_number);
    $stmt->bindParam(":email_id", $email_id);
    $stmt->bindParam(":current_address", $current_address);
    $stmt->bindParam(":permanent_address", $permanent_address);
    $stmt->bindParam(":parents_contact_number", $parents_contact_number);
    $stmt->bindParam(":aadhaar_number", $aadhaar_number);
    $stmt->bindParam(":student_id", $student_id);
    $stmt->bindParam(":date_of_joining", $date_of_joining);

    if ($stmt->execute()) {
        $success_message = "Student updated successfully.";
    } else {
        $error_message = "Error: " . $stmt->errorInfo()[2];
    }
}

// Retrieve student information
if (isset($_GET["id"])) {
    $student_id = $_GET["id"];

    // Retrieve student from the database
    $query = "SELECT * FROM students WHERE student_id = :student_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":student_id", $student_id);
    $stmt->execute();
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if student exists
    if (!$student) {
        die("Student not found.");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include "nav.php"; ?>
    <div class="container mt-5">
                <h2>Edit Student</h2>
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
        <form method="POST">
            <div class="form-group">
                <label for="student_id">Student ID:</label>
                <input type="text" class="form-control" id="student_id" name="student_id" value="<?php echo $student[
                    "student_id"
                ]; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="student_name">Student Name:</label>
                <input type="text" class="form-control" id="student_name" name="student_name" value="<?php echo $student[
                    "student_name"
                ]; ?>" required>
            </div>
            <div class="form-group">
                <label for="course_name">Course Name:</label>
                <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo $student[
                    "course_name"
                ]; ?>" required>
            </div>
            <div class="form-group">
                <label for="mobile_number">Mobile Number:</label>
                <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="<?php echo $student[
                    "mobile_number"
                ]; ?>" required>
            </div>
            <div class="form-group">
                <label for="email_id">Email ID:</label>
                <input type="email" class="form-control" id="email_id" name="email_id" value="<?php echo $student[
                    "email_id"
                ]; ?>" required>
            </div>
			<div class="form-group">
				<label for="date_of_joining">Date of Joining:</label>
				<input type="date" class="form-control" id="date_of_joining" name="date_of_joining" value="<?php echo $student[
        "date_of_joining"
    ]; ?>" required>
			</div>

            <div class="form-group">
                <label for="current_address">Current Address:</label>
                <textarea class="form-control" id="current_address" name="current_address" required><?php echo $student[
                    "current_address"
                ]; ?></textarea>
            </div>
            <div class="form-group">
                <label for="permanent_address">Permanent Address:</label>
                <textarea class="form-control" id="permanent_address" name="permanent_address" required><?php echo $student[
                    "permanent_address"
                ]; ?></textarea>
            </div>
            <div class="form-group">
                <label for="parents_contact_number">Parents Contact Number:</label>
                <input type="text" class="form-control" id="parents_contact_number" name="parents_contact_number" value="<?php echo $student[
                    "parents_contact_number"
                ]; ?>" required>
            </div>
            <div class="form-group">
                <label for="aadhaar_number">Aadhaar Number:</label>
                <input type="text" class="form-control" id="aadhaar_number" name="aadhaar_number" value="<?php echo $student[
                    "aadhaar_number"
                ]; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


