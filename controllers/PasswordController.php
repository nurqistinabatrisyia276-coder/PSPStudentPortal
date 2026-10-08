<?php

session_start();

require_once "../config/database.php";
require_once "../models/Student.php";

// Check if student is logged in
if (!isset($_SESSION["student_id"])) {
    header("Location: ../views/login.php");
    exit;
}

$studentModel = new Student($conn);
$studentId = $_SESSION["student_id"];

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $oldPassword = $_POST["old_password"];
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    // Server-side validation
    if (
        empty($oldPassword) ||
        empty($newPassword) ||
        empty($confirmPassword)
    ) {
        die("All password fields are required.");
    }

    if (strlen($newPassword) < 6) {
        die("New password must be at least 6 characters.");
    }

    if ($newPassword !== $confirmPassword) {
        die("New password and confirm password do not match.");
    }

    // Get logged-in student
    $student = $studentModel->getStudentById($studentId);

    if (!$student) {
        die("Student record not found.");
    }

    // Verify old password
    if (!password_verify($oldPassword, $student["password"])) {
        die("Old password is incorrect.");
    }

    // Hash new password
    $hashedPassword = password_hash(
        $newPassword,
        PASSWORD_DEFAULT
    );

    // Update password
    $studentModel->updatePassword(
        $studentId,
        $hashedPassword
    );

    $_SESSION["success"] = "Password updated successfully!";
    header("Location: ProfileController.php");
    exit;

} else {

    // Display password form
    require "../views/password.php";
}


?>