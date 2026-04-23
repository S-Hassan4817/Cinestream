<?php 
session_start();
include('../includes/connection.php'); 

if (isset($_POST['update'])) {
    $movie_id = $_POST['movie_id'];
    $title = mysqli_real_escape_string($conn, $_POST['movie_title']);
    $gold = $_POST['rate_gold'];
    $platinum = $_POST['rate_platinum'];
    $box = $_POST['rate_box'];
    $trailer = mysqli_real_escape_string($conn, $_POST['trailer_url']);
    $show_timings = mysqli_real_escape_string($conn, $_POST['show_timings']);

    if (!empty($_FILES['poster']['name'])) {
        $target_dir = "../uploads/"; 
        $file_name = time() . "_" . basename($_FILES['poster']['name']);
        $target_file = $target_dir . $file_name;
        $db_path = "uploads/" . $file_name; 
        
        if (move_uploaded_file($_FILES['poster']['tmp_name'], $target_file)) {
            $sql = "UPDATE movies SET title='$title', rate_gold='$gold', rate_platinum='$platinum', 
                    rate_box='$box', trailer_url='$trailer', show_timings='$show_timings', 
                    poster_path='$db_path' WHERE id='$movie_id'";
        }
    } else {

        $sql = "UPDATE movies SET title='$title', rate_gold='$gold', rate_platinum='$platinum', 
                rate_box='$box', show_timings='$show_timings', trailer_url='$trailer' 
                WHERE id='$movie_id'";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Movie Updated Successfully!'); window.location.href='view-movie.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $record = mysqli_query($conn, "SELECT * FROM movies WHERE id=$id");
    
    if(mysqli_num_rows($record) > 0) {
        $data = mysqli_fetch_array($record); 
    } else {
        die("Movie not found in database.");
    }
} else {
    header("Location: view-movie.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Movie | CineStream Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/adminlte.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --cine-red: #E50914;
        }

        /* The Main wrapper for AdminLTE */
        .app-wrapper {
            display: flex;
            width: 100%;
        }

        /* FIX: Ensures content stays to the right of the sidebar */
        .app-main {
            flex-grow: 1;
            background-color: #f4f6f9;
            min-height: 100vh;
            padding-bottom: 50px;
        }

        /* Form Styling */
        .form-card-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }

        .preview-img { 
            width: 100%;
            max-width: 160px; 
            height: auto; 
            aspect-ratio: 2/3;
            object-fit: cover; 
            border-radius: 12px; 
            box-shadow: 0 8px 15px rgba(0,0,0,0.1); 
            border: 3px solid #fff;
        }

        .form-label-custom { 
            font-weight: 600; 
            color: #333; 
            font-size: 0.85rem; 
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-update {
            background-color: var(--cine-red);
            color: white;
            font-weight: 700;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-update:hover {
            background-color: #b20710;
            transform: translateY(-2px);
            color: white;
        }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        
        <?php include('../includes/sidebar.php'); ?>

        <main class="app-main">
            <div class="app-content-header py-4">
                <div class="container-fluid px-4">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h2 class="fw-bold mb-0">Edit Movie</h2>
                            <p class="text-muted small">Updating: <span class="text-danger fw-bold"><?php echo $data['title']; ?></span></p>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a href="view-movie.php" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Back to Library
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid px-4">
                    <div class="form-card-container">
                        <form action="edit-movie.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="movie_id" value="<?php echo $data['id']; ?>">

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label-custom">Movie Title</label>
                                            <input type="text" name="movie_title" class="form-control form-control-lg" value="<?php echo $data['title']; ?>" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label-custom">Trailer URL</label>
                                            <input type="url" name="trailer_url" class="form-control" value="<?php echo $data['trailer_url']; ?>" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label-custom">Show Timings</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-clock"></i></span>
                                                <input type="text" name="show_timings" class="form-control" value="<?php echo $data['show_timings']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-4">
                                            <label class="form-label-custom mb-3">Ticket Rates (PKR)</label>
                                            <div class="row g-3 p-3 bg-light rounded-3 border">
                                                <div class="col-4 text-center">
                                                    <small class="text-muted d-block mb-1">GOLD</small>
                                                    <input type="number" name="rate_gold" class="form-control text-center fw-bold" value="<?php echo $data['rate_gold']; ?>">
                                                </div>
                                                <div class="col-4 text-center">
                                                    <small class="text-muted d-block mb-1">PLATINUM</small>
                                                    <input type="number" name="rate_platinum" class="form-control text-center fw-bold" value="<?php echo $data['rate_platinum']; ?>">
                                                </div>
                                                <div class="col-4 text-center">
                                                    <small class="text-muted d-block mb-1">VIP BOX</small>
                                                    <input type="number" name="rate_box" class="form-control text-center fw-bold" value="<?php echo $data['rate_box']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 text-center border-start">
                                    <label class="form-label-custom d-block mb-3">Current Poster</label>
                                    <div class="mb-3">
                                        <img src="../<?php echo $data['poster_path']; ?>" class="preview-img" id="posterPreview">
                                    </div>
                                    <div class="px-3">
                                        <input type="file" name="poster" class="form-control form-control-sm" onchange="previewImage(event)">
                                        <p class="text-muted mt-2" style="font-size: 0.75rem;">Leave empty to keep current poster</p>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 text-muted">

                            <div class="text-end">
                                <button type="submit" name="update" class="btn btn-update">
                                    SAVE CHANGES
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('posterPreview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/adminlte.js"></script>
</body>
</html>