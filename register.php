<?php
include 'includes/connection.php';

if(isset($_POST['register'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); 
    $role = 'user';

    $query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
    
    if(mysqli_query($conn, $query)){
        echo "<script>alert('Account Created Successfully!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Registration Failed: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | CineStream</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Bebas+Neue&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --netflix-red: #E50914;
            --apple-dark: #121212;
            --glass: rgba(255, 255, 255, 0.1);
        }

        body {
            background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), 
                        url('https://images.unsplash.com/photo-1517604401157-538e99b44c27?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
            margin: 0;
            color: white;
        }

        .register-container {
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(15px);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.5);
            width: 420px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        h2 {
            font-family: 'Bebas Neue', cursive;
            text-align: center;
            color: var(--netflix-red);
            font-size: 2.5rem;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        label {
            font-weight: 600;
            color: #a1a1a6;
            display: block;
            margin-bottom: 8px;
            font-size: 0.85rem;
            text-transform: uppercase;
        }

        input[type="text"], 
        input[type="email"], 
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            background: #333 !important;
            border: 1px solid transparent;
            border-radius: 8px;
            color: white !important;
            transition: 0.3s;
        }

        input:focus {
            outline: none;
            border-color: var(--netflix-red);
            background: #444 !important;
        }

        input[type="submit"] {
            width: 100%;
            padding: 14px;
            background-color: var(--netflix-red);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            margin-top: 10px;
            transition: all 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #b20710;
            transform: translateY(-2px);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #a1a1a6;
        }

        .login-link a {
            color: var(--netflix-red);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>CINESTREAM</h2>
    <p class="text-center text-secondary small mb-4">Create your account to start booking</p>
    
    <form method="POST">
        <label>Full Name</label>
        <input type="text" name="name" placeholder="Name" required>

        <label>Email Address</label>
        <input type="email" name="email" placeholder="email@example.com" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="••••••••" required>

        <input type="submit" name="register" value="Register Now">
        
        <div class="login-link">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </form>
</div>

</body>
</html>