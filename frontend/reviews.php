<?php
session_start();
include('../includes/connection.php');

if (!isset($_GET['movie_id']) || empty($_GET['movie_id'])) {
    header("Location: reviews.php");
    exit();
}

$movie_id = mysqli_real_escape_string($conn, $_GET['movie_id']);
$movie_res = mysqli_query($conn, "SELECT * FROM movies WHERE id = '$movie_id'");


if (mysqli_num_rows($movie_res) > 0) {
    $movie_data = mysqli_fetch_assoc($movie_res);
} else {
    die("Movie not found in database. <a href='website.php'>Go Back</a>");
}


$msg = "";
if (isset($_POST['submit_review'])) {
    $u_name = mysqli_real_escape_string($conn, $_POST['u_name']);
    $u_rating = mysqli_real_escape_string($conn, $_POST['u_rating']);
    $u_text = mysqli_real_escape_string($conn, $_POST['u_text']);

    $ins_query = "INSERT INTO reviews (movie_id, user_name, rating, review_text) 
                  VALUES ('$movie_id', '$u_name', '$u_rating', '$u_text')";

    if (mysqli_query($conn, $ins_query)) {
        $msg = "<div class='alert alert-success border-0 bg-success text-white small mb-4'>Review posted successfully!</div>";
    }
}

$reviews_query = "SELECT * FROM reviews WHERE movie_id = '$movie_id' ORDER BY id DESC";
$reviews_result = mysqli_query($conn, $reviews_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews | CineStream Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Bebas+Neue&display=swap" rel="stylesheet">

    <style>
        :root {
            --apple-black: #000000;
            --apple-dark: #1d1d1f;
            --netflix-red: #E50914;
            --glass: rgba(255, 255, 255, 0.08);
            --star-gold: #FFD700;
        }

        body {
            background-color: var(--apple-black);
            color: #f5f5f7;
            font-family: 'Inter', sans-serif;
            padding-top: 100px;
        }


        .movie-bg-blur {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: url('../<?php echo $movie_data['poster_path']; ?>');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            filter: blur(5px) brightness(0.5);
            z-index: -2;
            transform: scale(1.1);
        }

        .movie-detail-header {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            padding: 60px;
            margin-bottom: 50px;
        }

        .review-card {
            background: var(--apple-dark);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--netflix-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            text-transform: uppercase;
        }

        .glass-input {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            border-radius: 12px !important;
        }

        .btn-netflix {
            background: var(--netflix-red);
            color: white;
            border-radius: 100px;
            font-weight: 600;
            border: none;
        }
    </style>
</head>

<body>
    <div class="movie-bg-blur"></div>
    <div class="overlay-dark"></div>

    <?php include('./include/navbar.php') ?>

    <main class="container mb-5">
        <div class="movie-detail-header">
            <h1 class="display-4 fw-bold"><?php echo $movie_data['title']; ?></h1>
            <p class="opacity-75">Showing in Karachi Cinemas | Premium Experience</p>
            <div class="mt-3">
                <span class="text-warning h4">★★★★★</span>
                <span class="ms-2 small">Top Rated in 2026</span>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <h3 class="fw-bold mb-4">What Viewers Say</h3>

                <?php
                if (mysqli_num_rows($reviews_result) > 0) {
                    while ($row = mysqli_fetch_assoc($reviews_result)) {
                ?>
                        <div class="review-card">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="user-avatar me-3"><?php echo substr($row['user_name'], 0, 1); ?></div>
                                    <div>
                                        <h6 class="mb-0 fw-bold"><?php echo $row['user_name']; ?></h6>
                                        <small class="opacity-50"><?php echo date('d M Y', strtotime($row['created_at'])); ?></small>
                                    </div>
                                </div>
                                <div class="text-warning small">
                                    <?php for ($i = 1; $i <= 5; $i++) echo ($i <= $row['rating']) ? "★" : "☆"; ?>
                                </div>
                            </div>
                            <p class="opacity-75 mb-0"><?php echo $row['review_text']; ?></p>
                        </div>
                <?php
                    }
                } else {
                    echo "<div class='py-4 opacity-50 text-center'>No reviews yet for this movie.</div>";
                }
                ?>
            </div>

            <div class="col-lg-4">
                <div class="p-4 rounded-4" style="background: var(--glass); position: sticky; top: 120px;">
                    <h5 class="fw-bold mb-3">Write a Review</h5>
                    <?php echo $msg; ?>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <input type="text" name="u_name" class="form-control glass-input" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <select name="u_rating" class="form-select glass-input">
                                <option value="5">5 Stars - Must Watch</option>
                                <option value="4">4 Stars - Great</option>
                                <option value="3">3 Stars - Good</option>
                                <option value="2">2 Stars - Average</option>
                                <option value="1">1 Star - Poor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <textarea name="u_text" class="form-control glass-input" rows="4" placeholder="Your experience..." required></textarea>
                        </div>
                        <button type="submit" name="submit_review" class="btn btn-netflix w-100 py-2">POST REVIEW</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include('include/footer.php') ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>