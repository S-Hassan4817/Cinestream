<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php?error=unauthorized");
    exit();
}

include('../includes/connection.php');

$query = "SELECT * FROM cinemas ORDER BY id DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Cinema Halls | CineStream Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/adminlte.css" />

    <style>
        :root {
            --cine-red: #E50914;
            --bg-light: #f4f7f6;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Inter', sans-serif;
        }

        /* Fixed AdminLTE layout padding */
        .app-main {
            padding: 30px 15px;
        }

        .content-card {
            background: white;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin: 0 auto;
        }

        .card-header {
            background: white !important;
            padding: 20px 25px !important;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .hall-name {
            font-weight: 600;
            color: #1d1d1f;
        }

        .badge-capacity {
            background: #f0f0f0;
            color: #555;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .btn-add-new {
            background-color: var(--cine-red) !important;
            color: white !important;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-add-new:hover {
            background-color: #b20710;
            color: white;
        }

        /* Action Buttons Styling */
        .btn-action {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: 0.2s;
            text-decoration: none;
        }

        .btn-edit {
            color: #0d6efd;
            border: 1px solid #e0e0e0;
        }

        .btn-edit:hover {
            background: #0d6efd;
            color: white;
        }

        .btn-delete {
            color: #dc3545;
            border: 1px solid #e0e0e0;
        }

        .btn-delete:hover {
            background: #dc3545;
            color: white;
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">

        <?php include('../includes/sidebar.php'); ?>

        <main class="app-main">
            <div class="container-fluid">

                <div class="content-card">
                    <div class="card-header">
                        <h3 class="card-title fw-bold m-0">Cinema Management</h3>
                        <a href="add-cinema.php" class="btn btn-add-new">
                            <i class="bi bi-plus-lg me-1"></i> Add New Hall
                        </a>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">ID</th>
                                        <th>Cinema Hall Name</th>
                                        <th>Location Details</th>
                                        <th>Capacity</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (mysqli_num_rows($result) > 0): ?>
                                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                            <tr>
                                                <td class="ps-4"><span class="text-muted">#<?php echo $row['id']; ?></span></td>
                                                <td>
                                                    <div class="hall-name"><?php echo htmlspecialchars($row['hall_name']); ?></div>
                                                </td>
                                                <td><i class="bi bi-geo-alt me-1 text-muted"></i> <?php echo htmlspecialchars($row['location']); ?></td>
                                                <td><span class="badge-capacity"><?php echo $row['total_capacity']; ?> Seats</span></td>
                                                <td class="text-end pe-4">
                                                    <a href="edit-cinema.php?id=<?php echo $row['id']; ?>" class="btn-action btn-edit" title="Edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="delete-cinema.php?id=<?php echo $row['id']; ?>"
                                                        class="btn-action btn-delete"
                                                        onclick="return confirm('Delete this cinema hall?');" title="Delete">
                                                        <i class="bi bi-trash3"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">No cinema halls found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>