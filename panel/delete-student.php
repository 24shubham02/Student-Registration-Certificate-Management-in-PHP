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

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $student_id = $_GET["id"];

    // Delete the student from the database
    $query = "DELETE FROM students WHERE student_id = :student_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":student_id", $student_id);

    if ($stmt->execute()) {
        $success_message = "Student deleted successfully.";

        // Redirect to all students page after 3 seconds
        sleep(3);
        header("Location: all-students.php");
        exit();
    } else {
        $error_message = "Error deleting student: " . $stmt->errorInfo()[2];
    }
} else {
    // Invalid request, redirect to the student list page
    header("Location: all-students.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Student</title>
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
