<?php 
include('../includes/connection.php'); 

// To Fetch existing hall data
$data = null;
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $record = mysqli_query($conn, "SELECT * FROM cinemas WHERE id=$id");
    
    if($record && mysqli_num_rows($record) > 0) {
        $data = mysqli_fetch_array($record);
    } else {
        echo "<script>alert('Hall not found.'); window.location='view-cinema.php';</script>";
        exit;
    }
}
// Process 
if (isset($_POST['update_theater'])) {
    $id = mysqli_real_escape_string($conn, $_POST['hall_id']);
    $name = mysqli_real_escape_string($conn, $_POST['hall_name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $capacity = mysqli_real_escape_string($conn, $_POST['capacity']);

    $query = "UPDATE cinemas SET hall_name='$name', location='$location', total_capacity='$capacity' WHERE id=$id";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Cinema Updated Successfully!'); window.location='view-cinema.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Cinema | CineStream Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/adminlte.css" />

    <style>
        :root {
            --edit-amber: #f39c12;
            --bg-light: #f4f6f9;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Inter', sans-serif;
        }

        .app-wrapper {
            display: flex;
            width: 100%;
        }

        .app-main {
            flex-grow: 1;
            min-height: 100vh;
        }

        .main-content {
            padding: 40px 20px;
        }

        .form-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0,0,0,0.05);
            max-width: 700px; 
            width: 100%;
            margin: 0 auto; 
        }

        .form-label {
            font-weight: 600;
            font-size: 0.8rem;
            color: #555;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-update {
            background-color: var(--edit-amber) !important;
            color: white;
            border-radius: 10px;
            padding: 14px;
            font-weight: 700;
            border: none;
            width: 100%;
            margin-top: 10px;
            transition: 0.3s;
        }

        .btn-update:hover {
            background-color: #d68910;
            transform: translateY(-1px);
            color: white;
        }

        .id-badge {
            display: inline-block;
            background: #f8f9fa;
            padding: 5px 15px;
            border-radius: 6px;
            font-family: monospace;
            font-weight: bold;
            font-size: 0.85rem;
            border: 1px solid #ddd;
            margin-bottom: 25px;
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg">
    <div class="app-wrapper">
        
        <?php include('../includes/sidebar.php'); ?>

        <main class="app-main">
            <div class="main-content">
                
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Update Cinema Hall</h2>
                    <p class="text-muted">Modify the details for your screening locations</p>
                </div>

                <div class="container-fluid">
                    <div class="form-card">
                        <div class="text-center">
                            <div class="id-badge">CINEMA ID: #<?php echo $data['id']; ?></div>
                        </div>
                        
                        <form action="" method="POST">
                            <input type="hidden" name="hall_id" value="<?php echo $data['id']; ?>">

                            <div class="mb-4">
                                <label class="form-label">Cinema Name</label>
                                <input type="text" name="hall_name" class="form-control" 
                                       value="<?php echo htmlspecialchars($data['hall_name']); ?>" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Location Address</label>
                                <input type="text" name="location" class="form-control" 
                                       value="<?php echo htmlspecialchars($data['location']); ?>" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Seating Capacity</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-people"></i></span>
                                    <input type="number" name="capacity" class="form-control" 
                                           value="<?php echo htmlspecialchars($data['total_capacity']); ?>" required>
                                </div>
                            </div>

                            <button type="submit" name="update_theater" class="btn btn-update">
                                <i class="bi bi-check-circle-fill me-2"></i> UPDATE CINEMA
                            </button>
                            
                            <a href="view-cinema.php" class="btn btn-link w-100 text-muted mt-2 text-decoration-none small">
                                <i class="bi bi-arrow-left me-1"></i> Discard and Go Back
                            </a>
                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/adminlte.js"></script>
</body>
</html>