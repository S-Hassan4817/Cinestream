<?php
session_start();

include('includes/connection.php');
$error = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: admin/index.php");
        } else {
            header("Location: frontend/website.php");
        }

        exit();
    } else {
        $error = "Invalid Email or Password!";
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | CineStream</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Bebas+Neue&display=swap" rel="stylesheet">

    <style>
        :root {
            --netflix-red: #E50914;
            --apple-dark: #121212;
            --glass: rgba(255, 255, 255, 0.1);
        }

        body.login-page {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url('https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
            margin: 0;
        }

        .login-box {
            width: 420px;
        }

        .login-logo a {
            font-family: 'Bebas Neue', cursive;
            font-size: 3rem;
            color: var(--netflix-red) !important;
            text-decoration: none;
            letter-spacing: 2px;
            display: block;
            text-align: center;
            margin-bottom: 20px;
        }

        .card {
            background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            color: white;
            padding: 20px;
        }

        .login-box-msg {
            color: #a1a1a6;
            font-size: 0.9rem;
            text-align: center;
        }

        .input-group-text {
            background: var(--glass);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #a1a1a6;
        }

        .form-control {
            background: #ffffff !important;
            border: 1px solid transparent;
            color: white !important;
            padding: 12px;
        }

        .form-control:focus {
            background: #939393 !important;
            border-color: var(--netflix-red);
            box-shadow: none;
        }

        .btn-primary {
            background-color: var(--netflix-red);
            border: none;
            padding: 12px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: #b20710;
            transform: translateY(-2px);
        }

        .error-msg {
            background: rgba(220, 53, 69, 0.2);
            color: #ff4d4d;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        .form-check-label {
            color: #a1a1a6;
            font-size: 0.9rem;
        }

        a {
            color: var(--netflix-red);
            text-decoration: none;
        }

    </style>
</head>

<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#">CINESTREAM</a>
        </div>

        <div class="card shadow-lg">
            <div class="card-body">
                <p class="login-box-msg">Sign in to manage your cinema portal</p>

                <?php if ($error != "") { ?>
                    <div class="error-msg"><?php echo $error; ?></div>
                <?php } ?>

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required />
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    </div>

                    <div class="input-group mb-4">
                        <input type="password" name="password" class="form-control" placeholder="Password" required />
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    </div>

                    <div class="row align-items-center mb-4">
                        <div class="col-7">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" />
                                <label class="form-check-label" for="remember"> Remember Me </label>
                            </div>
                        </div>
                        <div class="col-5">
                            <button type="submit" name="login" class="btn btn-primary w-100">Sign In</button>
                        </div>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p class="mb-0 text-secondary small">
                        New here? <a href="register.php">Create an account</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>