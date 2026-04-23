<?php 
include('../includes/connection.php'); 

// To Fetch Movies
$sql = "SELECT * FROM movies ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Movies | CineStream Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/adminlte.css" />

    <style>
        :root {
            --cine-red: #E50914;
            --bg-light: #f8f9fa;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Inter', sans-serif;
        }

        /* FIX: This ensures the content pushes to the right of the sidebar */
        .app-main {
            padding: 40px;
            min-height: 100vh;
        }

        /* Removed your manual 20px margins to prevent double-spacing */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .table-container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .movie-thumb {
            width: 70px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .btn-add {
            background-color: var(--cine-red) !important;
            color: white !important;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
        }
         .btn-add:hover { background-color: #ff0612 !important; color: white; }

        .price-label { color: var(--cine-red); font-weight: 600; }
        
        /* Mobile adjustment: if screen is small, remove the margin */
        @media (max-width: 992px) {
            .app-main { margin-left: 0; }
        }
    </style>
</head>

<body cclass="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        
        <?php include('../includes/sidebar.php'); ?>

        <main class="app-main">
            <div class="page-header">
                <div>
                    <h1 class="fw-bold">Movie Library</h1>
                    <small class="text-muted">Manage your cinema listings and ticket pricing</small>
                </div>
                <a href="add-movie.php" class="btn btn-add">
                    <i class="bi bi-plus-lg me-2"></i> Add New Movie
                </a>
            </div>

            <div class="table-container">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Movie</th>
                            <th>Location</th>
                            <th>Pricing (PKR)</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td class="text-muted">#<?php echo $row['id']; ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="../<?php echo $row['poster_path']; ?>" class="movie-thumb me-3" alt="Poster">
                                    <div>
                                        <div class="fw-bold"><?php echo $row['title']; ?></div>
                                        <div class="text-muted small">CineStream Original</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <i class="bi bi-geo-alt-fill me-1 text-danger"></i>
                                    <?php echo ($row['theater_id'] == 1) ? "Askari IV" : "DHA Phase 8"; ?>
                                </span>
                            </td>
                            <td>
                                <div class="small">
                                    <span class="price-label">Gold:</span> <?php echo $row['rate_gold']; ?><br>
                                    <span class="price-label">Plat:</span> <?php echo $row['rate_platinum']; ?><br>
                                    <span class="price-label">Box:</span> <?php echo $row['rate_box']; ?>
                                </div>
                            </td>
                            <td class="text-end">
                                <a href="edit-movie.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-light border me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="delete-movie.php?id=<?php echo $row['id']; ?>" 
                                   class="btn btn-sm btn-outline-danger" 
                                   onclick="return confirm('Delete movie?')">
                                    <i class="bi bi-trash3"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php mysqli_close($conn); ?>