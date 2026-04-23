<?php 
include('../includes/connection.php');

if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, $_POST['movie_title']);
    $theater_id = mysqli_real_escape_string($conn, $_POST['theater_id']);
    $trailer = mysqli_real_escape_string($conn, $_POST['trailer_url']);
    $rate_gold = $_POST['rate_gold'];
    $rate_platinum = $_POST['rate_platinum'];
    $rate_box = $_POST['rate_box'];
    $show_timings = mysqli_real_escape_string($conn, $_POST['show_timings']);

    $target_dir = "../uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $poster_name = basename($_FILES["poster"]["name"]);
    $file_new_name = time() . "_" . $poster_name;
    $target_file = $target_dir . $file_new_name;
    
    $db_path = "uploads/" . $file_new_name; 

    if (move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file)) {
        $query = "INSERT INTO movies (theater_id, title, trailer_url, rate_gold, rate_platinum, rate_box, show_timings, poster_path) 
                  VALUES ('$theater_id', '$title','$trailer', '$rate_gold', '$rate_platinum', '$rate_box', '$show_timings', '$db_path')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Movie Added Successfully!'); window.location='view-movie.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Error uploading poster.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Movie | CineStream Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/adminlte.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --cine-red: #E50914;
            --bg-light: #f8f9fa;
            --card-white: #ffffff;
            --text-main: #1d1d1f;
            --text-muted: #86868b;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            margin: 0;
        }

        .app-wrapper { display: flex; min-height: 100vh; }
        .main-content { flex-grow: 1; padding: 40px; }

        .form-container {
            background: var(--card-white);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
    
        h2 { font-weight: 700; color: var(--text-main); margin-bottom: 5px; }
        .subtitle { color: var(--text-muted); margin-bottom: 30px; font-size: 0.95rem; }

        label { font-weight: 600; font-size: 0.85rem; color: #4b4b4b; margin-bottom: 8px; display: block; }

        .form-control, .form-select {
            border: 1.5px solid #e5e5e7;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 0.95rem;
            background-color: #fafafa;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--cine-red);
            box-shadow: 0 0 0 4px rgba(229, 9, 20, 0.1);
            outline: none;
        }

        .rates-card {
            background: #fdfdfd;
            border: 1px solid #efefef;
            border-radius: 12px;
            padding: 20px;
        }

        .rate-label { font-size: 0.7rem; font-weight: 800; color: var(--cine-red); text-transform: uppercase; margin-bottom: 5px; display: block; }

        .file-upload-wrapper {
            border: 2px dashed #d2d2d7;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            background: #fcfcfc;
            transition: 0.3s;
        }
        .file-upload-wrapper:hover { border-color: var(--cine-red); background: #fffafa; }

        .btn-submit {
            background-color: var(--cine-red);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            width: 100%;
            margin-top: 20px;
            transition: 0.3s;
        }
        .btn-submit:hover { background-color: #b20710; transform: translateY(-2px); }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">

        <?php include('../includes/sidebar.php') ?>

        <div class="main-content">
            <div class="form-container">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h2>Add New Movie</h2>
                        <p class="subtitle">Enter the movie details to update the theater listings.</p>
                    </div>
                    <span class="badge rounded-pill bg-light text-dark p-2 px-3 border">Admin Portal</span>
                </div>

                <form action="add-movie.php" method="POST" enctype="multipart/form-data">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label>Movie Title</label>
                            <input type="text" name="movie_title" class="form-control" placeholder="e.g. Interstellar" required>
                        </div>

                        <div class="col-md-6">
                            <label>Cinema Venue</label>
                            <select name="theater_id" class="form-select" required>
                                <option value="">Select Location</option>
                                <option value="1">Cinema 1 (Askari IV)</option>
                                <option value="2">Cinema 2 (DHA Phase 8)</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Show Timings</label>
                            <input type="text" name="show_timings" class="form-control" placeholder="04:00 PM, 08:00 PM" required>
                        </div>

                        <div class="col-12">
                            <label>Trailer URL (YouTube)</label>
                            <input type="url" name="trailer_url" class="form-control" placeholder="https://www.youtube.com/watch?v=...">
                        </div>

                        <div class="col-12">
                            <label>Ticket Rates (PKR)</label>
                            <div class="rates-card">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <span class="rate-label">Gold</span>
                                        <input type="number" name="rate_gold" class="form-control" placeholder="1000" required>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="rate-label">Platinum</span>
                                        <input type="number" name="rate_platinum" class="form-control" placeholder="1500" required>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="rate-label">VIP Box</span>
                                        <input type="number" name="rate_box" class="form-control" placeholder="3000" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label>Vertical Movie Poster</label>
                            <div class="file-upload-wrapper">
                                <i class="bi bi-cloud-arrow-up text-danger fs-2"></i>
                                <input type="file" name="poster" class="form-control mt-2" accept="image/*" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn-submit">
                        PUBLISH MOVIE
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>