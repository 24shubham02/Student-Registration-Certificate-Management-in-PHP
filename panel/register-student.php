<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include('nav.php'); ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Student Registration Form
                    </div>
                    <div class="card-body">
                        <form action="register.php" method="post">
                            <div class="form-group">
                                <label for="student_name">Student Name:</label>
                                <input type="text" name="student_name" id="student_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="course_name">Course Name:</label>
                                <select name="course_name" id="course_name" class="form-control" required>
                                    <option value="">--Select Course--</option>
                                    <option value="B.Tech">Ethical Hacking & Bug Bounty</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mobile_number">Mobile Number:</label>
                                <input type="text" name="mobile_number" id="mobile_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email_id">Email ID:</label>
                                <input type="email" name="email_id" id="email_id" class="form-control" required>
                            </div>
							<div class="form-group">
								<label for="date_of_joining">Date of Joining:</label>
								<input type="date" name="date_of_joining" id="date_of_joining" class="form-control" required>
							</div>
                            <div class="form-group">
                                <label for="current_address">Current Address:</label>
                                <textarea name="current_address" id="current_address" class="form-control" required></textarea>
                            </div>
							
                            <div class="form-group">
                                <label for="permanent_address">Permanent Address:</label>
                                <textarea name="permanent_address" id="permanent_address" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="parents_contact_number">Parent's Contact Number:</label>
                                <input type="text" name="parents_contact_number" id="parents_contact_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="aadhaar_number">Aadhaar Number:</label>
                                <input type="text" name="aadhaar_number" id="aadhaar_number" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
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
