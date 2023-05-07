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

// Retrieve students who have not been issued certificates
$query = "SELECT * FROM students WHERE isCertIssued = 0";
$stmt = $db->query($query);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Issue certificate
if (
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST["issue_certificate"])
) {
    $student_id = $_POST["student_id"];
    $student_name = $_POST["student_name"];
    $course_name = $_POST["course_name"];
    $date_of_joining = $_POST["date_of_joining"];

    // Check if the student already has a certificate
    $query = "SELECT * FROM certificates WHERE student_id = :student_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":student_id", $student_id);
    $stmt->execute();
    $existing_certificate = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_certificate) {
        $error_message = "Certificate already issued for this student.";
    } else {
        // Generate a random certificate ID
        $certificate_id = generateCertificateID();

        // Insert the certificate into the database
        $query = "INSERT INTO certificates (student_id, student_name, certificate_id, course_name, date_of_joining) 
                  VALUES (:student_id, :student_name, :certificate_id, :course_name, :date_of_joining)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":student_name", $student_name);
        $stmt->bindParam(":certificate_id", $certificate_id);
        $stmt->bindParam(":course_name", $course_name);
        $stmt->bindParam(":date_of_joining", $date_of_joining);

        // Update isCertIssued to 1 in the students table
        $updateQuery =
            "UPDATE students SET isCertIssued = 1 WHERE student_id = :student_id";
        $updateStmt = $db->prepare($updateQuery);
        $updateStmt->bindParam(":student_id", $student_id);

        $db->beginTransaction();

        try {
            $stmt->execute();
            $updateStmt->execute();
            $db->commit();
            $success_message = "Certificate issued successfully.";
            echo '<script>
                setTimeout(function() {
                    window.location.href = "issue-certificate.php";
                }, 3000);
            </script>';
        } catch (Exception $e) {
            $db->rollBack();
            $error_message = "Error: " . $e->getMessage();
        }
    }
}
// Function to generate a random certificate ID
function generateCertificateID()
{
    $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $certificate_id = "";

    for ($i = 0; $i < 10; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $certificate_id .= $characters[$index];
    }

    return $certificate_id;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Issue Certificate</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include "nav.php"; ?>
    <div class="container mt-5">
        <h2>Issue Certificate</h2>
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
        <?php if (count($students) > 0): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Course Name</th>
                        <th>Date of Joining</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo $student["student_id"]; ?></td>
                            <td><?php echo $student["student_name"]; ?></td>
                            <td><?php echo $student["course_name"]; ?></td>
                            <td><?php echo $student["date_of_joining"]; ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="student_id" value="<?php echo $student[
                                        "student_id"
                                    ]; ?>">
                                    <input type="hidden" name="student_name" value="<?php echo $student[
                                        "student_name"
                                    ]; ?>">
                                    <input type="hidden" name="course_name" value="<?php echo $student[
                                        "course_name"
                                    ]; ?>">
                                    <input type="hidden" name="date_of_joining" value="<?php echo $student[
                                        "date_of_joining"
                                    ]; ?>">
                                    <button type="submit" name="issue_certificate" class="btn btn-primary">Issue Certificate</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No students available to issue certificates.</p>
        <?php endif; ?> 
    </div>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

