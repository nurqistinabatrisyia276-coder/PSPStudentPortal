<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Student</title>

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

                    <h3 class="mb-4">Add Student</h3>

                    <form action="/PSPStudentPortal/controllers/StudentController.php?action=create" method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Name
                            </label>

                            <input 
                                type="text"
                                name="name"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                NRIC
                            </label>

                            <input 
                                type="text"
                                name="nric"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Program
                            </label>

                            <input 
                                type="text"
                                name="program"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Marks
                            </label>

                            <input 
                                type="number"
                                name="marks"
                                class="form-control"
                                min="0"
                                max="100"
                                required
                            >

                        </div>


                        <button 
                            type="submit" 
                            class="btn btn-primary"
                        >
                            Add Student
                        </button>
                        

                        <a href="/PSPStudentPortal/controllers/StudentController.php?action=list" class="btn btn-secondary">
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