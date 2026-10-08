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

$action = $_GET["action"] ?? "list";


// =========================
// PROFILE PICTURE UPLOAD
// =========================

if ($action == "uploadProfilePicture") {

    uploadProfilePicture();

    exit;
}


// =========================
// READ - Display students
// =========================

if ($action == "list") {

    $students = $studentModel->getAllStudents();

    require "../views/students/index.php";

    exit;
}


// =========================
// CREATE - Show form
// =========================

if ($action == "create" && $_SERVER["REQUEST_METHOD"] == "GET") {

    require "../views/students/create.php";

    exit;
}


// =========================
// CREATE - Add student
// =========================

if ($action == "create" && $_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $nric = trim($_POST["nric"]);
    $program = trim($_POST["program"]);
    $marks = trim($_POST["marks"]);


    // Validation
    if (
        empty($name) ||
        empty($nric) ||
        empty($program) ||
        $marks === ""
    ) {
        die("All fields are required.");
    }


    // Check marks
    if (!is_numeric($marks) || $marks < 0 || $marks > 100) {

        die("Marks must be between 0 and 100.");

    }


    // Check duplicate NRIC
    if ($studentModel->getStudentByNric($nric)) {

        die("NRIC already exists.");

    }


    // Default password
    $password = password_hash(
        "123456",
        PASSWORD_DEFAULT
    );


    // Add student
    $studentModel->createStudent(
        $name,
        $nric,
        $program,
        $marks,
        $password
    );


    // Return to student list
    header(
        "Location: StudentController.php?action=list"
    );

    exit;
}


// =========================
// UPDATE - Show edit form
// =========================

if ($action == "edit" && $_SERVER["REQUEST_METHOD"] == "GET") {

    $id = $_GET["id"] ?? "";

    if (!ctype_digit($id)) {
        die("Invalid student ID.");
    }

    $student = $studentModel->getStudentById($id);

    if (!$student) {
        die("Student not found.");
    }

    require "../views/students/edit.php";

    exit;
}


// =========================
// UPDATE - Save changes
// =========================

if ($action == "update" && $_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"] ?? "";
    $name = trim($_POST["name"]);
    $nric = trim($_POST["nric"]);
    $program = trim($_POST["program"]);
    $marks = trim($_POST["marks"]);


    // Validate ID
    if (!ctype_digit($id)) {
        die("Invalid student ID.");
    }


    // Validation
    if (
        empty($name) ||
        empty($nric) ||
        empty($program) ||
        $marks === ""
    ) {
        die("All fields are required.");
    }


    // Check marks
    if (!is_numeric($marks) || $marks < 0 || $marks > 100) {

        die("Marks must be between 0 and 100.");

    }


    // Check duplicate NRIC
    $existingStudent = $studentModel->getStudentByNric($nric);

    if ($existingStudent && $existingStudent["id"] != $id) {

        die("NRIC already exists.");

    }


    // Update student
    $studentModel->updateStudent(
        $id,
        $name,
        $nric,
        $program,
        $marks
    );


    // Return to student list
    header(
        "Location: /PSPStudentPortal/controllers/StudentController.php?action=list"
    );

    exit;
}


// =========================
// DELETE - Delete student
// =========================

if ($action == "delete" && $_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"] ?? "";

    // Validate ID
    if (!ctype_digit($id)) {
        die("Invalid student ID.");
    }

    // Delete student
    $studentModel->deleteStudent($id);

    // Return to student list
    header(
        "Location: /PSPStudentPortal/controllers/StudentController.php?action=list"
    );

    exit;
}


// =========================
// FUNCTION: Upload Profile Picture
// =========================

function uploadProfilePicture()
{
    global $studentModel;


    // Check if student is logged in
    if (!isset($_SESSION["student_id"])) {

        header("Location: ../views/login.php");

        exit();
    }


    // Get logged-in student's ID
    $student_id = $_SESSION["student_id"];


    // Check if file was uploaded
    if (
        !isset($_FILES["profile_picture"]) ||
        $_FILES["profile_picture"]["error"] != 0
    ) {

        die("Error uploading file.");

    }


    $file = $_FILES["profile_picture"];


    // =========================
    // Check file size
    // Maximum = 2MB
    // =========================

    if ($file["size"] > 2 * 1024 * 1024) {

        die("File size must not exceed 2MB.");

    }


    // =========================
    // Get file extension
    // =========================

    $extension = strtolower(
        pathinfo(
            $file["name"],
            PATHINFO_EXTENSION
        )
    );


    // =========================
    // Allowed file types
    // =========================

    $allowed_extensions = [
        "jpg",
        "jpeg",
        "png"
    ];


    if (!in_array(
        $extension,
        $allowed_extensions
    )) {

        die(
            "Only JPG, JPEG and PNG files are allowed."
        );

    }


    // =========================
    // Generate unique filename
    // =========================

    $new_filename = uniqid() . "." . $extension;


    // =========================
    // Upload location
    // =========================

    $upload_path = "../uploads/" . $new_filename;


    // =========================
    // Move uploaded file
    // =========================

    if (
        move_uploaded_file(
            $file["tmp_name"],
            $upload_path
        )
    ) {


        // =========================
        // Save filename to database
        // =========================

        if (
            $studentModel->updateProfilePicture(
                $student_id,
                $new_filename
            )
        ) {

            header(
                "Location: ../views/profile.php?success=1"
            );

            exit();

        } else {

            die(
                "Failed to save filename to database."
            );

        }

    } else {

        die(
            "Failed to upload file."
        );

    }
}

?>