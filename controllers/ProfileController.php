<?php

session_start();

require_once "../config/database.php";
require_once "../models/Student.php";

// Check if student is logged in
if (!isset($_SESSION["student_id"])) {
    header("Location: ../views/login.php");
    exit;
}

// Create Student model
$studentModel = new Student($conn);

// Get the currently logged-in student's ID
$studentId = $_SESSION["student_id"];

// Get student information
$student = $studentModel->getStudentById($studentId);

// Check if student exists
if (!$student) {
    die("Student record not found.");
}

// Send student data to the View
require "../views/profile.php";

?>