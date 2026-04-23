<?php
include('../includes/connection.php');

$query = "SELECT id, name, email, role FROM users ORDER BY id ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Management | CineStream Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="assets/css/adminlte.css" />

    <style>
        /* BASIC FLEX LAYOUT */
        .app-wrapper {
            display: flex;
            width: 100%;
        }

        .app-main {
            flex-grow: 1;
            padding: 30px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        /* SIMPLE CARD STYLING */
        .user-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid #eee;
            overflow: hidden;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            background: #e9ecef;
            color: #495057;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: bold;
            margin-right: 10px;
        }

        .badge-role {
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .role-admin {
            background: #fff3cd;
            color: #856404;
        }

        .role-user {
            background: #cfe2ff;
            color: #084298;
        }
    </style>
</head>

<body class="layout-fixed">
    <div class="app-wrapper">

        <?php include('../includes/sidebar.php'); ?>

        <main class="app-main">
            <div class="container-fluid">

                <div class="mb-4">
                    <h2 class="fw-bold">User Management</h2>
                    <p class="text-muted">Registered administrative and customer accounts</p>
                </div>

                <div class="user-card">
                    <div class="table-responsive">
                        <table class="table align-middle m-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($result) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td>#<?php echo $row['id']; ?></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="user-avatar"><?php echo strtoupper(substr($row['name'], 0, 1)); ?></div>
                                                    <span class="fw-semibold"><?php echo htmlspecialchars($row['name']); ?></span>
                                                </div>
                                            </td>
                                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                                            <td>
                                                <span class="badge-role <?php echo ($row['role'] == 'admin') ? 'role-admin' : 'role-user'; ?>">
                                                    <?php echo $row['role']; ?>
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <a href="edit-users.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary me-1">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <a href="delete-users.php?id=<?php echo $row['id']; ?>"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Delete this user?');">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">No users registered.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/adminlte.js"></script>
</body>

</html>