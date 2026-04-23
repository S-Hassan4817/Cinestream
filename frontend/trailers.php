<?php
session_start();
include('../includes/connection.php');


$movie_id = isset($_GET['movie_id']) ? mysqli_real_escape_string($conn, $_GET['movie_id']) : 0;

if ($movie_id > 0) {
    $query = "SELECT * FROM movies WHERE id = '$movie_id'";
} else {
    $query = "SELECT * FROM movies ORDER BY id DESC LIMIT 1";
}

$result = mysqli_query($conn, $query);
$current_movie = mysqli_fetch_assoc($result);


function getYouTubeEmbed($url)
{
    $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
    $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v=)|(?:\/))([a-zA-Z0-9_-]+)/i';

    if (preg_match($longUrlRegex, $url, $matches)) {
        $youtube_id = $matches[3];
    } elseif (preg_match($shortUrlRegex, $url, $matches)) {
        $youtube_id = $matches[1];
    } else {
        $youtube_id = $url; 
    }
    return "https://www.youtube.com/embed/" . $youtube_id;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CineStream | Trailers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --bg-black: #080808;
        }

        body {
            background-color: var(--bg-black);
            color: white;
            font-family: 'Poppins', sans-serif;
            padding-top: 80px;
            min-height: 100vh;
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .movie-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 3rem;
            color: var(--netflix-red);
        }

        .sidebar-card {
            background: #141414;
            border-radius: 8px;
            transition: 0.3s;
            cursor: pointer;
            border: 1px solid transparent;
        }

        .sidebar-card:hover {
            border-color: var(--netflix-red);
            transform: translateX(5px);
        }

        .sidebar-img {
            width: 100px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }

        /* --- BUTTONS --- */
        .btn-main {
            background-color: #e50914;
            color: white;
            padding: 12px 35px;
            font-weight: 600;
            border-radius: 5px;
            border: none;
            text-transform: uppercase;
        }

        .btn-main:hover {
            background-color: #f40612;
            color: white;
            box-shadow: 0 0 15px #e50914;
        }
    </style>
</head>

<body>

    <?php include('./include/navbar.php') ?>

    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col-lg-8">
                <?php if ($current_movie): ?>
                    <div class="video-container">
                        <iframe src="<?php echo getYouTubeEmbed($current_movie['trailer_url']); ?>?autoplay=1" allowfullscreen></iframe>
                    </div>
                    <h1 class="movie-title mt-3"><?php echo $current_movie['title']; ?> - Official Trailer</h1>
                    <p class="text-secondary">Now Showing in Cinestream Theaters</p>
                    <hr class="border-secondary">
                    <div class="d-flex gap-3">
                        <a href="tickets.php?movie_id=<?php echo $current_movie['id']; ?>" class="btn btn-main ">Book This Movie</a>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger">Trailer not found.</div>
                <?php endif; ?>
            </div>

            <div class="col-lg-4">
                <h5 class="text-uppercase fw-bold mb-3 text-secondary">Up Next</h5>
                <?php
                $other_movies = mysqli_query($conn, "SELECT * FROM movies WHERE id != '$movie_id' LIMIT 6");
                while ($row = mysqli_fetch_assoc($other_movies)):
                ?>
                    <a href="trailers.php?movie_id=<?php echo $row['id']; ?>" class="text-decoration-none text-white">
                        <div class="sidebar-card p-2 mb-2 d-flex gap-3">
                            <img src="../<?php echo $row['poster_path']; ?>" class="sidebar-img">
                            <div>
                                <h6 class="mb-0 small fw-bold"><?php echo $row['title']; ?></h6>
                            </div>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

 <?php include('./include/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>