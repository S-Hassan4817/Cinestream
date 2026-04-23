<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

include('../includes/connection.php');

if (isset($_POST['save_theater'])) {
    $name = mysqli_real_escape_string($conn, $_POST['hall_name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $capacity = mysqli_real_escape_string($conn, $_POST['capacity']);

    $query = "INSERT INTO cinemas (hall_name, location, total_capacity) 
              VALUES ('$name', '$location', '$capacity')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Cinema Hall Added Successfully!'); window.location='view-cinema.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Cinema | CineStream Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/adminlte.css" />
    
    <style>
        :root { --cine-red: #E50914; --bg-light: #f8f9fa; }
        body { background-color: var(--bg-light); font-family: 'Inter', sans-serif; }
        
        .app-main {
            padding: 40px 20px;
            transition: margin-left .3s ease-in-out;
        }

        .form-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
        }

        .btn-save {
            background-color: var(--cine-red) !important;
            color: white !important;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            border: none;
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">

        <?php include('../includes/sidebar.php'); ?>

        <main class="app-main"> 
            <div class="container-fluid">
                <div class="text-center mb-5">
                    <h1 class="fw-bold">Add New Cinema Hall</h1>
                    <p class="text-muted">Register a new screen or location for movie screenings</p>
                </div>

                <div class="form-card">
                    <form action="add-cinema.php" method="POST">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Cinema Hall Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-display"></i></span>
                                <input type="text" name="hall_name" class="form-control" placeholder="e.g. Askari IV - Screen 1" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Location/Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-geo-alt"></i></span>
                                <input type="text" name="location" class="form-control" placeholder="e.g. Rashid Minhas Road, Karachi" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Total Seating Capacity</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-people"></i></span>
                                <input type="number" name="capacity" class="form-control" placeholder="Enter total seats (e.g. 200)" required>
                            </div>
                        </div>

                        <button type="submit" name="save_theater" class="btn btn-save">
                            <i class="bi bi-check-circle me-2"></i> Confirm and Save Hall
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>