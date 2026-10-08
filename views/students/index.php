<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Grade Management</title>

    <!-- Bootstrap CSS -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >

</head>

<body class="bg-light">

<div class="container mt-5">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Student Grade Management</h2>

        <!-- Add Student Button -->
        <a 
            href="/PSPStudentPortal/controllers/StudentController.php?action=create" 
            class="btn btn-primary"
        >
            Add Student
        </a>

    </div>


    <!-- Student Table -->
    <div class="card shadow">

        <div class="card-body">

            <h5 class="card-title mb-3">
                Student List
            </h5>

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover">

                    <thead class="table-dark">

                        <tr>

                            <th>No.</th>

                            <th>Name</th>

                            <th>NRIC</th>

                            <th>Program</th>

                            <th>Marks</th>

                            <th>Action</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php if (!empty($students)): ?>

                            <?php $no = 1; ?>

                            <?php foreach ($students as $student): ?>

                                <tr>

                                    <!-- Number -->
                                    <td>
                                        <?= $no++ ?>
                                    </td>


                                    <!-- Name -->
                                    <td>
                                        <?= htmlspecialchars($student["name"]) ?>
                                    </td>


                                    <!-- NRIC -->
                                    <td>
                                        <?= htmlspecialchars($student["nric"]) ?>
                                    </td>


                                    <!-- Program -->
                                    <td>
                                        <?= htmlspecialchars($student["program"]) ?>
                                    </td>


                                    <!-- Marks -->
                                    <td>
                                        <?= htmlspecialchars($student["marks"]) ?>
                                    </td>


                                    <!-- Action -->
                                    <td>

                                        <!-- Edit Button -->
                                        <a 
                                        href="/PSPStudentPortal/controllers/StudentController.php?action=edit&id=<?= $student["id"] ?>" 
                                        class="btn btn-warning btn-sm"
>
                                        Edit
                                        </a>


                                        <!-- Delete Button -->
                                        <form 
                                        action="/PSPStudentPortal/controllers/StudentController.php?action=delete" 
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this student?');"
>

                                        <input 
                                        type="hidden" 
                                        name="id" 
                                        value="<?= $student["id"] ?>"
    >

                                        <button 
                                        type="submit" 
                                        class="btn btn-danger btn-sm"
    >
                                        Delete
                                        </button>

                                        </form>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <!-- No students -->
                            <tr>

                                <td 
                                    colspan="6" 
                                    class="text-center"
                                >
                                    No students found.
                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


<!-- Bootstrap JavaScript -->
<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>