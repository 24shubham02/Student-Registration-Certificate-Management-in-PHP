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

// Retrieve all issued certificates
$query = "SELECT * FROM certificates";
$stmt = $db->query($query);
$certificates = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Certificates</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include "nav.php"; ?>
    <div class="container mt-5">
        <h2>All Certificates</h2>
        <?php if (count($certificates) > 0): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Course Name</th>
                        <th>Certificate ID</th>
                        <th>Date of Joining</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($certificates as $certificate): ?>
                        <tr>
                            <td><?php echo $certificate["student_id"]; ?></td>
                            <td><?php echo $certificate["student_name"]; ?></td>
                            <td><?php echo $certificate["course_name"]; ?></td>
                            <td><?php echo $certificate[
                                "certificate_id"
                            ]; ?></td>
                            <td><?php echo $certificate[
                                "date_of_joining"
                            ]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No certificates issued yet.</p>
        <?php endif; ?> 
    </div>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
