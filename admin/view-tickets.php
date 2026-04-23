<?php
include('../includes/connection.php');

$query = "SELECT bookings.*, movies.title FROM bookings 
          JOIN movies ON bookings.movie_id = movies.id 
          ORDER BY bookings.id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/adminlte.css">
    <style>
        .wrapper {
            display: flex;
        }

        .content-area {
            flex-grow: 1;
            padding: 20px;
            background-color: #f4f6f9;
            min-height: 100vh;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <?php include('../includes/sidebar.php'); ?>

        <div class="content-area">
            <div class="container-fluid">

                <div class="row mb-4 align-items-center">

                    <div class="col-6">
                        <h2 class="fw-bold m-0">Live Ticket Bookings</h2>
                    </div>
                    <div class="col-6 text-end">
                        <button onclick="window.print()" class="btn btn-outline-dark btn-sm">
                            <i class="bi bi-printer me-1"></i> Print Report
                        </button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-0">
                        <table class="table table-striped table-bordered mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Movie</th>
                                    <th>Class</th>
                                    <th>Seats</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['customer_name']; ?></td>
                                        <td><?php echo $row['title']; ?></td>
                                        <td><?php echo $row['seat_class']; ?></td>
                                        <td><?php echo $row['total_seats']; ?></td>
                                        <td>Rs. <?php echo number_format($row['total_price']); ?></td>
                                        <td><?php echo $row['booking_date']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>