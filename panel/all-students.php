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

// Retrieve all students from the database
$query = "SELECT * FROM students";
$stmt = $db->prepare($query);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Students</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include "nav.php"; ?>
    <div class="container mt-5">
        <h2>All Students</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Course Name</th>
					<th>Mobile Number</th>
					<th>Email ID</th>
					<th>Joining Date</th>
                    <th>Actions</th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo $student["student_id"]; ?></td>
                        <td><?php echo $student["student_name"]; ?></td>
                        <td><?php echo $student["course_name"]; ?></td>
						<td><?php echo $student["mobile_number"]; ?></td>
						<td><?php echo $student["email_id"]; ?></td>
						<td><?php echo $student["date_of_joining"]; ?></td>
                        <td>
                            <a href="edit-student.php?id=<?php echo $student[
                                "student_id"
                            ]; ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="delete-student.php?id=<?php echo $student[
                                "student_id"
                            ]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
