<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="dashboard.php">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="studentsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Students
                </a>
                <div class="dropdown-menu" aria-labelledby="studentsDropdown">
                    <a class="dropdown-item" href="register-student.php">Register New Student</a>
                    <a class="dropdown-item" href="all-students.php">All Students</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="certificateDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Certificate
                </a>
                <div class="dropdown-menu" aria-labelledby="certificateDropdown">
                    <a class="dropdown-item" href="issue-certificate.php">Issue A Certificate</a>
                    <a class="dropdown-item" href="all-certificates.php">View All Certificates</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>
