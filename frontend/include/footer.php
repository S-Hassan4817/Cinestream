<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

        /* FOOTER SECTION  */

        .footer-section {
            background-color: #000000;
            padding: 80px 0 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            color: #f5f5f7;
        }

        .footer-brand {
            font-family: 'Bebas Neue', cursive;
            font-size: 2rem;
            color: #E50914 !important;
            text-decoration: none;
            letter-spacing: 2px;
        }

        .footer-heading {
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 25px;
            color: #ffffff;
        }

        .footer-text {
            font-size: 0.85rem;
            color: #86868b;
            line-height: 1.6;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: #86868b;
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #E50914;
        }

        .social-links a {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.05);
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: 0.3s;
            text-decoration: none;
        }

        .social-links a:hover {
            background: #E50914;
            transform: translateY(-3px);
        }

        .footer-bottom {
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>

<body>

    <!-- FOOTER CODE  -->

    <footer class="footer-section">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                    <a class="footer-brand" href="#">CINESTREAM</a>
                    <p class="footer-text mt-3">
                        Redefining the cinematic experience in Karachi. Book your premium seats for the latest blockbusters with ease and style.
                    </p>
                </div>

                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="footer-heading">Navigate</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="website.php">Home</a></li>
                        <li><a href="movies.php">All Movies</a></li>
                        <li><a href="trailers.php">Trailers</a></li>
                        <li><a href="about.php">About</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h6 class="footer-heading">Visit Us</h6>
                    <p class="footer-text mb-2">
                        <i class="bi bi-geo-alt-fill me-2 text-danger"></i> Tariq Road, Karachi, Pakistan
                    </p>
                    <p class="footer-text">
                        <i class="bi bi-envelope-fill me-2 text-danger"></i> support@cinestream.com
                    </p>
                    <div class="mt-4">
                        <span class="badge rounded-pill bg-dark border border-secondary p-2 px-3">
                            <i class="bi bi-clock me-1"></i> Open: 10:00 AM - 12:00 AM
                        </span>
                    </div>
                </div>
            </div>

            <div class="footer-bottom mt-5">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0 small opacity-50"> CineStream Premium. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>