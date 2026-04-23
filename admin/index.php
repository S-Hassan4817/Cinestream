<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

include('../includes/connection.php');

// 1. FETCH TOTAL USERS 
$user_query = "SELECT COUNT(id) as total_users FROM users WHERE role = 'user'";
$user_result = mysqli_query($conn, $user_query);
$user_data = mysqli_fetch_assoc($user_result);
$total_users = $user_data['total_users'] ?? 0;

// 2. FETCH MOVIES ON AIR 
$movie_query = "SELECT COUNT(id) as total_movies FROM movies";
$movie_result = mysqli_query($conn, $movie_query);
$movie_data = mysqli_fetch_assoc($movie_result);
$total_movies = $movie_data['total_movies'] ?? 0;

// 3. FETCH TOTAL REVENUE & TICKETS 
$booking_query = "SELECT SUM(total_price) as revenue, SUM(total_seats) as tickets FROM bookings";
$booking_result = mysqli_query($conn, $booking_query);
$booking_data = mysqli_fetch_assoc($booking_result);
$total_revenue = $booking_data['revenue'] ?? 0;
$total_tickets = $booking_data['tickets'] ?? 0;

// 4. FETCH RECENT BOOKINGS
$recent_bookings = mysqli_query($conn, "SELECT b.*, m.title FROM bookings b JOIN movies m ON b.movie_id = m.id ORDER BY b.id DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Admin Dashboard | CineStream</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/adminlte.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 250px;
        }

        body {
            overflow-x: hidden;
            background-color: #f4f6f9;
        }

        .app-wrapper {
            display: flex;
            width: 100%;
            transition: all 0.3s;
        }

        .app-main {
            flex-grow: 1;
            min-height: 100vh;
            padding: 20px;
            width: 100%;
        }

        .info-box {
            background: white;
            display: flex;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: transform 0.2s;
        }

        .info-box:hover {
            transform: translateY(-3px);
        }

        .info-box-icon {
            width: 50px;
            height: 50px;
            min-width: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-size: 1.25rem;
        }

        @media (max-width: 576px) {
            .info-box {
                padding: 0.75rem;
            }
            .info-box-number {
                font-size: 16px;
            }
        }

        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }
        
        .card {
            border-radius: 12px;
        }
    </style>
</head>

<body class="layout-fixed">
    <div class="app-wrapper">
        <?php include('../includes/sidebar.php'); ?>

        <main class="app-main">
            

            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-12 text-center text-md-start">
                        <h3 class="fw-bold">Dashboard Overview</h3>
                        <p class="text-muted">Welcome back, Admin.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary text-white"><i class="bi bi-cash-stack"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Revenue</span>
                                <span class="info-box-number">Rs. <?php echo number_format($total_revenue); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-success text-white"><i class="bi bi-ticket-perforated"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tickets Sold</span>
                                <span class="info-box-number"><?php echo number_format($total_tickets); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning text-white"><i class="bi bi-people"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Users</span>
                                <span class="info-box-number"><?php echo number_format($total_users); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger text-white"><i class="bi bi-film"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Movies On Air</span>
                                <span class="info-box-number"><?php echo $total_movies; ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0 fw-bold">Recent Transactions</h5>
                                <span class="badge bg-light text-dark">Latest 5</span>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="ps-3">ID</th>
                                                <th>Customer</th>
                                                <th>Movie</th>
                                                <th>Class</th>
                                                <th class="pe-3 text-end">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(mysqli_num_rows($recent_bookings) > 0): ?>
                                                <?php while ($row = mysqli_fetch_assoc($recent_bookings)): ?>
                                                <tr>
                                                    <td class="ps-3"><span class="text-muted small">#<?php echo $row['id']; ?></span></td>
                                                    <td class="fw-semibold"><?php echo htmlspecialchars($row['customer_name']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                                                    <td>
                                                        <span class="badge <?php echo $row['seat_class'] == 'Gold' ? 'bg-warning text-dark' : 'bg-info text-white'; ?>">
                                                            <?php echo $row['seat_class']; ?>
                                                        </span>
                                                    </td>
                                                    <td class="pe-3 text-end fw-bold">Rs. <?php echo number_format($row['total_price']); ?></td>
                                                </tr>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <tr><td colspan="5" class="text-center py-4">No recent bookings found.</td></tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer bg-white text-center py-3">
                                <a href="view-tickets.php" class="text-decoration-none small fw-bold text-uppercase">View All Bookings <i class="bi bi-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div> 
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/adminlte.js"></script>
</body>
</html>