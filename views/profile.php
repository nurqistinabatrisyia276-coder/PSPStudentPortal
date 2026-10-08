<?php

session_start();

// Connect to database and Student model
require_once "../config/database.php";
require_once "../models/Student.php";

// Check if student is logged in
if (!isset($_SESSION["student_id"])) {
    header("Location: login.php");
    exit;
}

// Create Student model
$studentModel = new Student($conn);

// Get current logged-in student's ID
$student_id = $_SESSION["student_id"];

// Get student information from database
$student = $studentModel->getStudentById($student_id);

// Check if student exists
if (!$student) {
    die("Student not found.");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Profile</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body class="bg-light">

<!-- Navigation Bar -->
<nav class="navbar navbar-dark bg-primary">

    <div class="container">

        <span class="navbar-brand">
            PSP Student Portal
        </span>

        <a href="logout.php" class="btn btn-danger">
            Logout
        </a>

    </div>

</nav>


<!-- Main Content -->
<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-body">

                    <h3 class="mb-4 text-center">
                        Student Profile
                    </h3>


                    <!-- SUCCESS MESSAGE -->
                    <?php if (isset($_GET['success'])): ?>

                        <div class="alert alert-success">
                            Profile picture uploaded successfully!
                        </div>

                    <?php endif; ?>


                    <!-- PROFILE PICTURE -->
                    <div class="text-center mb-4">

                        <?php if (!empty($student['profile_picture'])): ?>

                            <img
                                src="../uploads/<?php echo htmlspecialchars($student['profile_picture']); ?>"
                                width="150"
                                height="150"
                                style="object-fit: cover; border-radius: 50%;"
                                alt="Profile Picture"
                            >

                        <?php else: ?>

                            <div
                                class="border rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                style="width: 150px; height: 150px;"
                            >

                                <span class="text-muted">
                                    No Picture
                                </span>

                            </div>

                        <?php endif; ?>

                    </div>


                    <!-- UPLOAD PROFILE PICTURE -->
                    <form
                        action="../controllers/StudentController.php?action=uploadProfilePicture"
                        method="POST"
                        enctype="multipart/form-data"
                        class="mb-4"
                    >

                        <label class="form-label fw-bold">
                            Upload Profile Picture
                        </label>

                        <input
                            type="file"
                            name="profile_picture"
                            accept=".jpg,.jpeg,.png"
                            class="form-control mb-2"
                            required
                        >

                        <small class="text-muted">
                            Only JPG, JPEG and PNG files are allowed.
                            Maximum size: 2MB.
                        </small>

                        <br><br>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Upload Picture
                        </button>

                    </form>


                    <!-- STUDENT NAME -->
                    <div class="mb-3">

                        <label class="fw-bold">
                            Name
                        </label>

                        <p>
                            <?= htmlspecialchars($student["name"]) ?>
                        </p>

                    </div>


                    <!-- NRIC -->
                    <div class="mb-3">

                        <label class="fw-bold">
                            NRIC
                        </label>

                        <p>
                            <?= htmlspecialchars($student["nric"]) ?>
                        </p>

                    </div>


                    <!-- PROGRAM -->
                    <div class="mb-3">

                        <label class="fw-bold">
                            Program
                        </label>

                        <p>
                            <?= htmlspecialchars($student["program"]) ?>
                        </p>

                    </div>


                    <!-- CHANGE PASSWORD -->
                    <a
                        href="../controllers/PasswordController.php"
                        class="btn btn-primary"
                    >
                        Change Password
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>