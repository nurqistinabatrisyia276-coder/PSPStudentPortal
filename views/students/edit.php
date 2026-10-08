<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Student</title>

    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-body">

                    <h3 class="mb-4">Edit Student</h3>


                    <form 
                        action="/PSPStudentPortal/controllers/StudentController.php?action=update" 
                        method="POST"
                    >

                        <!-- Student ID -->
                        <input 
                            type="hidden" 
                            name="id" 
                            value="<?= htmlspecialchars($student["id"]) ?>"
                        >


                        <!-- Name -->
                        <div class="mb-3">

                            <label for="name" class="form-label">
                                Name
                            </label>

                            <input 
                                type="text" 
                                class="form-control"
                                id="name"
                                name="name"
                                value="<?= htmlspecialchars($student["name"]) ?>"
                                required
                            >

                        </div>


                        <!-- NRIC -->
                        <div class="mb-3">

                            <label for="nric" class="form-label">
                                NRIC
                            </label>

                            <input 
                                type="text" 
                                class="form-control"
                                id="nric"
                                name="nric"
                                value="<?= htmlspecialchars($student["nric"]) ?>"
                                required
                            >

                        </div>


                        <!-- Program -->
                        <div class="mb-3">

                            <label for="program" class="form-label">
                                Program
                            </label>

                            <input 
                                type="text" 
                                class="form-control"
                                id="program"
                                name="program"
                                value="<?= htmlspecialchars($student["program"]) ?>"
                                required
                            >

                        </div>


                        <!-- Marks -->
                        <div class="mb-3">

                            <label for="marks" class="form-label">
                                Marks
                            </label>

                            <input 
                                type="number" 
                                class="form-control"
                                id="marks"
                                name="marks"
                                min="0"
                                max="100"
                                value="<?= htmlspecialchars($student["marks"]) ?>"
                                required
                            >

                        </div>


                        <!-- Buttons -->

                        <button 
                            type="submit" 
                            class="btn btn-primary"
                        >
                            Update Student
                        </button>


                        <a 
                            href="/PSPStudentPortal/controllers/StudentController.php?action=list" 
                            class="btn btn-secondary"
                        >
                            Cancel
                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>