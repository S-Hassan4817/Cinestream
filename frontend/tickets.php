<?php
include('../includes/connection.php');

if (!isset($_GET['movie_id'])) {
    header("Location: website.php");
    exit();
}

$movie_id = mysqli_real_escape_string($conn, $_GET['movie_id']);
$movie = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM movies WHERE id = '$movie_id'"));

if (isset($_POST['confirm_booking'])) {
    $name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $class = $_POST['seat_class'];
    $total_seats = (int)$_POST['total_seats'];
    $kid_seats = (int)$_POST['kid_seats'];
    $price = ($class == 'Gold') ? $movie['rate_gold'] : (($class == 'Platinum') ? $movie['rate_platinum'] : $movie['rate_box']);

    $adult_count = $total_seats - $kid_seats;
    $total_price = ($adult_count * $price) + ($kid_seats * ($price * 0.75));

    $query = "INSERT INTO bookings (movie_id, customer_name, seat_class, total_seats, total_price) 
              VALUES ('$movie_id', '$name', '$class', '$total_seats', '$total_price')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Booking Successful! Total: Rs. $total_price'); window.location='website.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: white;
            padding-top: 50px;
        }

        .my-card {
            background-color: #1e1e1e;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #333;
        }

        .price-box {
            background-color: #262626;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin: 20px 0;
            border: 1px solid #444;
        }

        .btn-red {
            background-color: #E50914;
            color: white;
            font-weight: bold;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
        }

        .btn-red:hover {
            background-color: #b20710;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <div class="my-card">
                    <h2 class="text-center mb-4"><?php echo $movie['title']; ?></h2>
                    <hr>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Your Name</label>
                            <input type="text" name="customer_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ticket Class</label>
                            <select name="seat_class" id="seatClass" class="form-select" onchange="calcTotal()">
                                <option value="Gold" data-price="<?php echo $movie['rate_gold']; ?>">Gold (Rs. <?php echo $movie['rate_gold']; ?>)</option>
                                <option value="Platinum" data-price="<?php echo $movie['rate_platinum']; ?>">Platinum (Rs. <?php echo $movie['rate_platinum']; ?>)</option>
                                <option value="Box" data-price="<?php echo $movie['rate_box']; ?>">Box (Rs. <?php echo $movie['rate_box']; ?>)</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Total Seats</label>
                                <input type="number" name="total_seats" id="seats" class="form-control" value="1" min="1" oninput="calcTotal()" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Kids Seats</label>
                                <input type="number" name="kid_seats" id="kids" class="form-control" value="0" min="0" oninput="calcTotal()" required>
                            </div>
                        </div>

                        <p class="text-danger small fw-bold">* Kids get 25% discount!</p>

                        <div class="price-box">
                            <h4 class="m-0">Total: Rs. <span id="displayTotal"><?php echo $movie['rate_gold']; ?></span></h4>
                        </div>

                        <button type="submit" name="confirm_booking" class="btn btn-red">BOOK NOW</button>

                        <div class="text-center mt-3">
                            <a href="website.php" class="text-secondary text-decoration-none small">Go Back</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

        <script>
            // Basic Math for Price
            function calcTotal() {
                // 1. Get values from HTML
                var select = document.getElementById('seatClass');
                var price = select.options[select.selectedIndex].getAttribute('data-price');
                var total = document.getElementById('seats').value;
                var kids = document.getElementById('kids').value;

                // 2. Prevent kids from being more than total
                if (parseInt(kids) > parseInt(total)) {
                    alert("Kids can't be more than total seats");
                    document.getElementById('kids').value = total;
                    kids = total;
                }

                // 3. Simple Calculation
                var adults = total - kids;
                var finalPrice = (adults * price) + (kids * (price * 0.75));

                // 4. Update the text on screen
                document.getElementById('displayTotal').innerHTML = Math.round(finalPrice);
            }
        </script>
</body>

</html>