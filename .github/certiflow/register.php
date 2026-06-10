<?php
require_once 'db.php';

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {

        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "Email already exists.";
        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare(
                "INSERT INTO users(name,email,password) VALUES(?,?,?)"
            );

            $stmt->bind_param(
                "sss",
                $name,
                $email,
                $hashedPassword
            );

            if ($stmt->execute()) {
                $success = "Registration successful. You can login now.";
            } else {
                $error = "Something went wrong.";
            }

            $stmt->close();
        }

        $check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Register - CertiFlow</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f5f7fb;
}
.card{
    border:none;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}
</style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center align-items-center vh-100">

        <div class="col-md-5">

            <div class="card p-4">

                <h2 class="text-center mb-4">
                    CertiFlow Register
                </h2>

                <?php if($success): ?>
                    <div class="alert alert-success">
                        <?= $success ?>
                    </div>
                <?php endif; ?>

                <?php if($error): ?>
                    <div class="alert alert-danger">
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Confirm Password
                        </label>
                        <input
                            type="password"
                            name="confirm_password"
                            class="form-control"
                            required>
                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary w-100">
                        Register
                    </button>

                </form>

                <div class="text-center mt-3">
                    Already have an account?
                    <a href="login.php">Login</a>
                </div>

            </div>

        </div>

    </div>
</div>

</body>
</html>