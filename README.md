### student-certificate-management-php

# Student Registration &amp; Certificate Management System

## Description
>This is a simple student registration and certificate management system in php completely developed using ChatGPT. It has an Admin login where you can register students, Issue certificate for them when their course has finished, Later anyone can validate the certificate by certificate ID.

>  Motive of sharing this repo is to aware people how much chatGPT is powerful and can be useful in your coding needs.

## Features and Functions of the portal:

### 1.	Admin Panel:
> •	The admin panel provides a secure dashboard for trainers or admins to manage the portal.

>	•	Trainers or admins can view all registered students, issued certificates, and perform various administrative tasks.

### 2.	Student Registration:
>	•	Trainers or admins can register new students manually through the admin panel.
	
### 3.	Certificate Issuance:	
>	•	Trainers or admins can issue certificates to students upon successful completion of a course.

>	•	Certificates are generated with unique identification numbers and contain relevant details about the course and the student.
	
### 4.	Certificate Verification:
>	•	Students or any interested parties can verify the authenticity of a certificate using the unique certificate ID.

>	•	The certificate verification function compares the provided certificate ID against the database records to validate its authenticity.

### 5.	Student Management:
>	•	Trainers or admins can view, edit, or delete student records.

>	•	Student information, such as name, email, and contact details, can be modified as needed.
	
### 6.	User-Friendly Interface:	
>	•	The portal provides a user-friendly interface for students, trainers, and admins to navigate and interact with the system easily.

>	•	Intuitive forms, menus, and navigation elements are implemented to enhance the user experience.
	
### 7.	Scalability and Customization:	
>	•	The portal is designed to be scalable, allowing for future enhancements and customization as per specific requirements.

>	•	Additional features or functionalities can be integrated to meet the evolving needs.

## Setup Instructions

### Environment Requirements:
  - Web server (such as Apache or Nginx)
  - PHP (version 7.0 or higher)
  - MySQL or MariaDB database
  
### Clone the Repository:
  - Clone the repository containing your project files to your local development environment or server.

### Database Setup:
  - Create a new database in your MySQL or MariaDB server.
  - Import the "shubhamsahu_panel.sql" file into the newly created database. This file contains the necessary database structure and initial data.

### Update Database Configuration:
  - Open the "db.php" file located in the "panel" directory.
  - Modify the database connection settings to match your database credentials (hostname, database name, username, and password).

### Accessing the Portal:
  - Once everything is set up, open a web browser and visit the URL where your project is hosted.
  - You should see the login page.
      
### Credentials:
  > Username - admin

  > Password - admin@123

## File Structure:-

### /panel/
  - all-certificates.php
    > This file displays all the certificates issued.
  - all-students.php 
    > This file displays information about all registered students.
  - dashboard.php  
    > This file serves as the main dashboard for the admin or trainer.
  - db.php 
    > This file contains the necessary code for connecting to the database.
  - delete-student.php 
    > This file handles the functionality to delete a student's record.
  - edit-student.php 
    > This file allows editing the information of a registered student.
  - index.php 
    > This file serves as the main entry point of the admin panel.
  - issue-certificate.php 
    > This file handles the process of issuing certificates to students.
  - logout.php 
    > This file handles the logout functionality for the admin or trainer.
  - nav.php 
    > This file contains the navigation menu code, which is included in other pages.
  - register.php 
    > This file provides the registration form for new students.
  - register-student.php 
    > This file handles the registration process for new students.
### - certificate-verify.php
> This file handles the certificate verification functionality, allowing users to verify the authenticity of a certificate.
### - shubhamsahu_panel.sql
> This file is an SQL script that contains the database structure and initial data needed for your project.
