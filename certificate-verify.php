<?php
// Database connection
include('panel/db.php');

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Verify Certificate
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $certificate_id = $_POST['certificate_id'];

    // Check if certificate exists
    $query = "SELECT * FROM certificates WHERE certificate_id = :certificate_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':certificate_id', $certificate_id);
    $stmt->execute();
    $certificate = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($certificate) {
        $student_id = $certificate['student_id'];

        // Retrieve student information
        $query = "SELECT * FROM students WHERE student_id = :student_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student) {
            // Display student information
            
        } else {
            
        }
    } else {
        
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify Certificate</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        .container {
            max-width: 500px;
            margin-top: 50px;
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            color: #555;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0069d9;
        }

        .alert {
            margin-top: 20px;
            text-align: center;
        }

        .alert i {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Verify Certificate</h2>
        <form method="POST">
            <div class="form-group">
                <label for="certificate_id">Certificate ID:</label>
                <input type="text" class="form-control" id="certificate_id" name="certificate_id" required>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Verify</button>
        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <?php if ($certificate): ?>
                <div class="alert alert-success" role="alert">
                    <h1><i class="fas fa-check-circle"></i> Congratulations!! <br> Certificate is valid! </h1>
                    <div class="mt-3">
						<table class="table">
							<tr>
								<th>Student ID</th>
								<td><?php echo $student['student_id']; ?></td>
							</tr>
							<tr>
								<th>Student Name</th>
								<td><?php echo $student['student_name']; ?></td>
							</tr>
							<tr>
								<th>Course Name</th>
								<td><?php echo $student['course_name']; ?></td>
							</tr>
							<tr>
								<th>Date of Joining</th>
								<td><?php echo $student['date_of_joining']; ?></td>
							</tr>
						</table>
					</div>
                </div>
            <?php else: ?>
                <div class="alert alert-danger" role="alert">
                    <h1><i class="fas fa-times-circle"></i> Invalid Certificate</h1>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>
