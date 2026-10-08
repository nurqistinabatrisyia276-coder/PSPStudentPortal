<?php
session_start();

$error = $_SESSION["login_error"] ?? "";
unset($_SESSION["login_error"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PSP Student Portal - Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container">
    <div class="row justify-content-center mt-5">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h2 class="text-center mb-4">
                        PSP Student Portal
                    </h2>

                    <h5 class="text-center mb-4">
                        Student Login
                    </h5>

                    <?php if (!empty($error)): ?>

                        <div class="alert alert-danger">
                            <?= htmlspecialchars($error) ?>
                        </div>

                    <?php endif; ?>

                    <form action="../controllers/AuthController.php" method="POST">

                        <div class="mb-3">
                            <label for="nric" class="form-label">
                                NRIC
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="nric"
                                name="nric"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Login
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>
</div>

</body>
</html>