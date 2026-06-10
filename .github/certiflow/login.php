<?php
session_start();
require_once 'db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {

        $error = "Please fill all fields.";

    } else {

        $stmt = $conn->prepare(
            "SELECT id,name,email,password FROM users WHERE email = ?"
        );

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {

            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {

                session_regenerate_id(true);

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];

                header("Location: dashboard.php");
                exit();

            } else {

                $error = "Invalid email or password.";
            }

        } else {

            $error = "Invalid email or password.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Login - CertiFlow</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f5f7fb;
}

.card{
    border:none;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}
</style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center align-items-center vh-100">

        <div class="col-md-5">

            <div class="card p-4">

                <h2 class="text-center mb-4">
                    CertiFlow Login
                </h2>

                <?php if(!empty($error)): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form method="POST">

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

                    <button
                        type="submit"
                        class="btn btn-primary w-100">
                        Login
                    </button>

                </form>

                <div class="text-center mt-3">
                    <a href="register.php">
                        Create New Account
                    </a>
                </div>

            </div>

        </div>

    </div>
</div>

</body>
</html>