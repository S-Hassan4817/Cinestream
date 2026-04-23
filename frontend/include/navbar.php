<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    :root { --netflix-red: #E50914; }

    /* --- NAVBAR CSS  */
    .navbar {
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0) 100%);
        padding: 15px 0;
        z-index: 1000;
        transition: 0.3s;
    }

    .navbar-brand {
        font-family: 'Bebas Neue', cursive;
        font-size: 2.2rem;
        color: var(--netflix-red) !important;
        letter-spacing: 2px;
    }

    .avatar-circle {
        width: 35px;
        height: 35px;
        background-color: var(--netflix-red);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        text-transform: uppercase;
        border: 2px solid rgba(255,255,255,0.2);
    }

    .dropdown-dark {
        background-color: #141414;
        border: 1px solid #333;
        border-radius: 12px;
        margin-top: 15px !important;
    }

    .dropdown-item {
        color: #ddd !important;
        font-size: 0.9rem;
        padding: 10px 20px;
        transition: 0.2s;
    }

    .dropdown-item:hover {
        background-color: rgba(255,255,255,0.1);
        color: #fff !important;
    }

    .dropdown-toggle::after {
        vertical-align: middle;
        margin-left: 10px;
        color: #888;
    }
</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="website.php">CINESTREAM</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="trailers.php">Trailers</a></li>
                <li class="nav-item"><a class="nav-link active" href="movies.php">Movies</a></li>

                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar-circle me-2">
                            <?php echo substr($_SESSION['user_name'], 0, 1); ?> 
                        </div>
                        <span class="fw-bold"><?php echo $_SESSION['user_name']; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-dark shadow-lg" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item text-danger" href="../logout.php"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

</body>
</html>