<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

include('../includes/connection.php');

// Fetch User Data
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $user_query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
    $user = mysqli_fetch_assoc($user_query);

    if (!$user) {
        echo "<script>alert('User not found!'); window.location.href='view-users.php';</script>";
        exit();
    }
}

// Update Logic
if (isset($_POST['update_user'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $update_query = "UPDATE users SET name='$name', email='$email', role='$role' WHERE id='$id'";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('User Updated!'); window.location.href='view-users.php';</script>";
    } else {
        echo "<script>alert('Error updating user');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Edit User Info</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/adminlte.css" />
    
    <style>
        .app-main {
            background-color: #f4f6f9;
            padding: 20px;
        }
        
        .my-custom-card {
            background: white;
            border: 1px solid #cccccc;
            padding: 25px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .form-label {
            font-weight: bold;
            color: #333;
        }

        .page-title {
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .btn-save {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
        }

        .btn-save:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body class="layout-fixed">
    <div class="app-wrapper">
        <?php include('../includes/sidebar.php'); ?>
        
        <main class="app-main">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 ms-5">
                        
                        <div class="my-custom-card">
                            <h3 class="page-title text-primary">Edit User Details</h3>
                            
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Full Name:</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $user['name']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email Address:</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">User Role:</label>
                                    <select name="role" class="form-control">
                                        <option value="user" <?php if($user['role'] == 'user') echo 'selected'; ?>>user</option>
                                        <option value="admin" <?php if($user['role'] == 'admin') echo 'selected'; ?>>admin</option>
                                    </select>
                                    <small class="text-muted text-danger">Warning: Admins can change everything!</small>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="manage-users.php" class="text-secondary text-decoration-none">← Back to List</a>
                                    <button type="submit" name="update_user" class="btn-save">Update User Info</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="assets/js/adminlte.js"></script>
</body>
</html>