<?php 
session_start();
include('../includes/connection.php'); 

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : "";
$query = "SELECT * FROM movies";
if ($search != "") {
    $query .= " WHERE title LIKE '%$search%'";
}
$query .= " ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies | CineStream</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> 
    <style>
        :root {
            --accent: #E50914;
            --card-bg: #1a1a1a;  
            --netflix-red: #e50914;
        }

        body { 
            background-color: #000; 
            color: #fff; 
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .search-container {
            background: #fff;
            border-radius: 50px;
            padding: 6px;
            display: flex;
            align-items: center;
            box-shadow: 0 10px 25px rgba(229, 9, 20, 0.2);
        }
        .search-container input {
            border: none;
            outline: none;
            padding: 8px 20px;
            width: 100%;
            font-weight: 500;
            color: #333;
            border-radius: 50px;
        }
        .search-btn {
            background: var(--accent);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 700;
            transition: 0.3s;
        }
        .search-btn:hover { background: #b20710; }

        .movie-card {
            background: var(--card-bg);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #2a2a2a;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .movie-card:hover {
            transform: translateY(-8px);
            border-color: var(--accent);
            box-shadow: 0 15px 30px rgba(0,0,0,0.5);
        }

        .poster-box {
            position: relative;
            overflow: hidden;
            aspect-ratio: 2/3;
        }
        .poster-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s;
        }
        .movie-card:hover .poster-box img {
            transform: scale(1.05);
        }

        .card-details {
            padding: 18px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .movie-title {
            font-weight: 800;
            font-size: 1.15rem;
            color: #fff;
            margin-bottom: 8px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .show-time {
            font-size: 0.75rem;
            color: #888;
            margin-bottom: 15px;
        }
        .review-link {
        display: block;
        text-align: center;
        font-size: 0.75rem;
        color: #888;
        text-decoration: none;
        margin-top: 10px;
        transition: 0.3s;
    }

    .review-link:hover {
        color: var(--accent); /* Changes to red on hover */
        text-decoration: underline;
    }
        /* BUTTONS CSS  */

        .btn-book {
            background: #fff;
            color: #000;
            border: none;
            font-weight: 700;
            font-size: 0.85rem;
            padding: 10px;
            border-radius: 10px;
            text-decoration: none;
            text-align: center;
            transition: 0.3s;
        }
        .btn-book:hover {
            background: var(--accent);
            color: #fff;
        }
        .btn-main {
            background-color: var(--netflix-red);
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
    </style>
</head>
<body>

    <?php include('./include/navbar.php') ?>

    <div class="container py-5 text-center">
        <h1 style="font-family: 'Bebas Neue'; font-size: 4.5rem; letter-spacing: 2px;">CINEMATIC HUB</h1>
        
        <div class="row justify-content-center mt-3">
            <div class="col-md-5">
                <form action="" method="GET" class="search-container">
                    <input type="text" name="search" placeholder="Search by movie name..." value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit" class="search-btn">SEARCH</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row g-4">
            <?php if(mysqli_num_rows($result) > 0): ?>
                <?php while($movie = mysqli_fetch_assoc($result)): ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="movie-card">
                            <div class="poster-box">
                                <img src="../<?php echo $movie['poster_path']; ?>">
                            </div>

                            <div class="card-details">
                                <div>
                                    <h5 class="movie-title"><?php echo $movie['title']; ?></h5>
                                    <p class="show-time">
                                        <i class="bi bi-clock me-1"></i> 
                                        Next Show: <?php echo explode(',', $movie['show_timings'])[0]; ?>
                                    </p>
                                </div>
                                <a href="tickets.php?movie_id=<?php echo $movie['id']; ?>" class="btn-book">
                                    BOOK NOW
                                </a>
                                <a href="reviews.php?movie_id=<?php echo $movie['id']; ?>" class="review-link">
                                <i class="bi bi-star-fill me-1" style="font-size: 10px;"></i> View Reviews
                            </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <h4 class="text-white-50 fw-light">We couldn't find any results for this.</h4>
                </div>
            <?php endif; ?>
        </div>
    </div>

    
<?php include('include/footer.php') ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>