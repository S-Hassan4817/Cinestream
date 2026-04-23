<?php
session_start();

include('../includes/connection.php');

if (!isset($_SESSION['user_id'])) {

    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineStream | Premium Booking Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --bg-black: #080808;
            --card-dark: #121212;
            --text-gray: #b3b3b3;
            --gold: #d4af37;
            --platinum: #e5e4e2;
            --box: #a80008;
        }

        body {
            background-color: var(--bg-black);
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* --- CAROUSEL--- */
        .carousel-item {
            margin-top: 12px;
            height: 90vh;
            background-size: cover;
            background-position: center;
            transition: transform 1.2s ease-in-out, opacity 1.2s ease-in-out;
        }

        .hero-overlay {
            height: 100%;
            width: 100%;
            background: linear-gradient(75deg, rgba(8, 8, 8, 1) 0%, rgba(8, 8, 8, 0.6) 40%, rgba(8, 8, 8, 0) 100%);
            display: flex;
            align-items: center;
        }

        .hero-title {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(3rem, 8vw, 6rem);
            line-height: 0.9;
            margin-bottom: 20px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        }

        .stats-bar {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(15px);
            border-radius: 15px;
            padding: 30px;
            margin-top: -60px;
            position: relative;
            z-index: 20;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .stat-item h3 {
            font-family: 'Bebas Neue';
            color: var(--netflix-red);
            font-size: 2.2rem;
            margin-bottom: 0;
        }

        .stat-item p {
            font-size: 0.75rem;
            color: var(--text-gray);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 0;
        }

        /* --- MOVIE CARDS --- */
        .section-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 2.5rem;
            letter-spacing: 1px;
            margin: 60px 0 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .section-title::after {
            content: "";
            height: 2px;
            background: var(--netflix-red);
            flex-grow: 1;
        }

        .movie-card {
            background: var(--card-dark);
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid #222;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            padding-bottom: 10px;
        }

        .movie-card:hover {
            transform: translateY(-10px);
            border-color: var(--netflix-red);
            box-shadow: 0 15px 30px rgba(229, 9, 20, 0.2);
        }

        .movie-card img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        /* --- BUTTONS --- */
        .btn-main {
            background-color: #e50914;
            color: white;
            padding: 12px 35px;
            font-weight: 600;
            border-radius: 4px;
            border: none;
            text-transform: uppercase;
            transition: 0.3s;
            margin: 15px;
        }

        .btn-main:hover {
            background-color: #f40612;
            transform: scale(1.05);
            color: white;
        }

        .badge-seat {
            font-size: 0.6rem;
            padding: 4px 8px;
            border-radius: 4px;
            text-transform: uppercase;
            font-weight: bold;
            margin-right: 5px;
        }

        .badge-gold {
            background: var(--gold);
            color: black;
        }

        .badge-platinum {
            background: var(--platinum);
            color: black;
        }

        .badge-box {
            background: var(--box);
            color: white;
        }


        .font-bebas {
            font-family: 'Bebas Neue', cursive;
            letter-spacing: 1px;
        }

        .max-width-500 {
            max-width: 500px;
        }
    </style>
</head>

<body>

    <?php include('./include/navbar.php') ?>

    <div id="heroCarousel" class="carousel slide carousel" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url('./assets/images/carousel1.jpg');">
                <div class="hero-overlay">
                    <div class="container"> 
                        <div class="col-lg-7">
                            <span class="text-danger fw-bold mb-3 d-block" style="letter-spacing: 5px;">NOW PREMIERING</span>
                            <h1 class="hero-title">BEYOND THE<br>BIG SCREEN</h1>
                            <p class="lead text-light opacity-75 mb-4">Experience crystal clear 4K laser projection and bone-shaking Dolby Atmos sound.</p>
                            <a href="movies.php" class="btn btn-main btn-lg">View Movies</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('./assets/images/carousel2.jpg');">
                <div class="hero-overlay">
                    <div class="container">
                        <div class="col-lg-7">
                            <span class="text-warning fw-bold mb-3 d-block" style="letter-spacing: 5px;">EXCLUSIVE ACCESS</span>
                            <h1 class="hero-title">PLATINUM BOX<br>EXPERIENCE</h1>
                            <p class="lead text-light opacity-75 mb-4">Reclining leather seats, private butler service, and unlimited gourmet snacks.</p>
                            <a href="#" class="btn btn-outline-light btn-lg">Explore Luxury</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <div class="container">
        <div class="stats-bar shadow-lg">
            <div class="row text-center g-4">
                <div class="col-6 col-md-3 border-end border-dark">
                    <div class="stat-item">
                        <h3>24/7</h3>
                        <p>Self Service</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 border-end border-dark">
                    <div class="stat-item">
                        <h3>12+</h3>
                        <p>Screens</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 border-end border-dark">
                    <div class="stat-item">
                        <h3>4K</h3>
                        <p>Ultra HD</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <h3>Dolby</h3>
                        <p>Atmos Sound</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="container mb-5">
        <h2 class="section-title">Trending in Theaters</h2>

        <div class="row g-4">
            <?php
            $fetch_query = "SELECT * FROM movies ORDER BY id DESC LIMIT 8";
            $fetch_result = mysqli_query($conn, $fetch_query);

            if (mysqli_num_rows($fetch_result) > 0) {
                while ($row = mysqli_fetch_assoc($fetch_result)) {
                    $poster = $row['poster_path'];
            ?>
                    <div class="col-md-4 col-lg-3">
                        <div class="movie-card h-100">
                            <div class="position-relative">
                                <img src="../<?php echo $poster; ?>" alt="<?php echo $row['title']; ?>">
                            </div>

                            <div class="card-body">
                                <div class="mb-2 mt-2 p-2">
                                    <?php if ($row['rate_gold'] > 0) echo '<span class="badge-seat badge-gold">Gold</span>'; ?>
                                    <?php if ($row['rate_platinum'] > 0) echo '<span class="badge-seat badge-platinum">Platinum</span>'; ?>
                                    <?php if ($row['rate_box'] > 0) echo '<span class="badge-seat badge-box">Box</span>'; ?>
                                </div>
                                <h5 class="fw-bold text-white mb-3 ms-3 p-2 text-truncate"><?php echo $row['title']; ?></h5>
                                <?php

                                $booking_url = isset($_SESSION['user_id'])
                                    ? "tickets.php?movie_id=" . $row['id']
                                    : "../login.php?msg=login_required";
                                ?>

                                <a href="<?php echo $booking_url; ?>" class="btn-main btn-sm d-block text-center text-decoration-none">
                                    Book Now
                                </a>

                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<div class='col-12 text-center'><p class='text-muted'>New blockbusters arriving soon!</p></div>";
            }
            ?>
        </div>
    </main>

    <?php include('./include/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>