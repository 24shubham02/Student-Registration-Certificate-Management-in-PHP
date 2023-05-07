<!-- Retrieve user information from the database -->
<?php include "db.php"; ?>

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$stmt = $db->prepare("SELECT * FROM admins WHERE id = :id");
$stmt->bindParam(":id", $_SESSION["user_id"]);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $db->prepare("SELECT COUNT(*) AS total_students FROM students");
$stmt->execute();
$student_count = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include "nav.php"; ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Registered Students</h5>
                        <p class="card-text"><?php echo $student_count[
                            "total_students"
                        ]; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
