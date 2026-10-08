<?php

session_start();

require_once "../config/database.php";
require_once "../models/Student.php";

$studentModel = new Student($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nric = trim($_POST["nric"]);
    $password = $_POST["password"];

    // Server-side validation
    if (empty($nric) || empty($password)) {
        $_SESSION["login_error"] = "Please enter your NRIC and password.";
        header("Location: ../views/login.php");
        exit;
    }

    // Find student
    $student = $studentModel->getStudentByNric($nric);

    // Verify password
    if ($student && password_verify($password, $student["password"])) {

        // Store only the logged-in student's ID
        $_SESSION["student_id"] = $student["id"];

        header("Location: ../controllers/ProfileController.php");
        exit;

    } else {

        $_SESSION["login_error"] = "Invalid NRIC or password.";
        header("Location: ../views/login.php");
        exit;
    }
}
?>