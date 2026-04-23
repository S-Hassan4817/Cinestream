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
    <title>About Us | CineStream Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --bg-black: #080808;
            --card-dark: #121212;
            --netflix-red: #e50914;
            --text-gray: #b3b3b3;
        }

        body {
            background-color: var(--bg-black);
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
        }

        /* --- HERO SECTION --- */
        .about-hero {
            height: 60vh;
            background: linear-gradient(to bottom, rgba(8,8,8,0.5), rgba(8,8,8,1)), 
                        url('https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?q=80&w=2070');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .hero-title {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(3rem, 10vw, 5rem);
            letter-spacing: 3px;
        }

        /* --- CONTENT CARDS --- */
        .about-card {
            background: var(--card-dark);
            border: 1px solid #222;
            border-radius: 15px;
            padding: 40px;
            transition: 0.3s;
        }

        .about-card:hover {
            border-color: var(--netflix-red);
        }

        .section-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 2.5rem;
            color: var(--netflix-red);
            margin-bottom: 20px;
        }

        /* --- STATS BOX (MATCHING YOUR HOME PAGE) --- */
        .stats-bar {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(15px);
            border-radius: 15px;
            padding: 30px;
            margin-top: -50px;
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

        .feature-icon {
            font-size: 2rem;
            color: var(--netflix-red);
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <?php include('./include/navbar.php') ?>

    <header class="about-hero">
        <div class="container">
            <h1 class="hero-title">REDEFINING <span class="text-danger">CINEMA</span></h1>
            <p class="lead opacity-75">The most immersive movie experience in Karachi.</p>
        </div>
    </header>

    <div class="container mb-5">
        <div class="stats-bar shadow-lg">
            <div class="row text-center g-4">
                <div class="col-6 col-md-3 border-end border-dark">
                    <div class="stat-item">
                        <h3>ESTB</h3>
                        <p>2026</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 border-end border-dark">
                    <div class="stat-item">
                        <h3>100%</h3>
                        <p>Digital</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 border-end border-dark">
                    <div class="stat-item">
                        <h3>4K</h3>
                        <p>Laser Tech</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <h3>VVIP</h3>
                        <p>Lounges</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h2 class="section-title">Our Vision</h2>
                <p class="text-gray lead">At CineStream, we don't just show movies; we create memories.</p>
                <p class="text-secondary">
                    Launched in early 2026, CineStream was built to provide movie enthusiasts with a premium alternative to traditional theaters. 
                    We combine cutting-edge projection technology with the comfort of luxury lounges to bring you closer to the action than ever before.
                </p>
                <ul class="list-unstyled mt-4">
                    <li class="mb-2"><i class="bi bi-check2-circle text-danger me-2"></i> Best-in-class Dolby Atmos Sound</li>
                    <li class="mb-2"><i class="bi bi-check2-circle text-danger me-2"></i> Easy Online Ticket Reservation</li>
                    <li class="mb-2"><i class="bi bi-check2-circle text-danger me-2"></i> Gourmet Concession Stands</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="about-card">
                    <h3 class="font-bebas text-white mb-4">Why Choose Us?</h3>
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <i class="bi bi-lightning-charge feature-icon"></i>
                            <h6 class="fw-bold">Instant Booking</h6>
                            <p class="small text-secondary">Book your favorite seats in less than 60 seconds.</p>
                        </div>
                        <div class="col-sm-6">
                            <i class="bi bi-gem feature-icon"></i>
                            <h6 class="fw-bold">Premium Class</h6>
                            <p class="small text-secondary">Experience our Gold and Platinum luxury seating.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include('./include/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>