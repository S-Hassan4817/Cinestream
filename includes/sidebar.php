<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineStream | Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Bebas+Neue&display=swap" rel="stylesheet">
   
    <style>
        :root {
            --netflix-red: #E50914;
            --apple-dark: #121212;
            --nav-text: #a1a1a6;
            --sidebar-width: 290px;
        }

        body {
            display: flex; 
            margin: 0;
            min-height: 100vh;
            background-color: #f5f5f7;
            font-family: 'Inter', sans-serif;
        }
        .app-sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background-color: #000 !important;
            color: white;
            display: flex;
            flex-direction: column;
            flex-shrink: 0; 
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            padding: 25px 0;
        }

        .sidebar-brand {
            padding: 30px 20px;
            font-family: 'Bebas Neue', cursive;
            font-size: 2.2rem;
            color: var(--netflix-red);
            text-decoration: none;
            letter-spacing: 1.5px;
        }

        .nav-link {
            color: var(--nav-text) !important;
            padding: 12px 25px !important;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .nav-link i { margin-right: 12px; font-size: 1.1rem; }

        .nav-link:hover, .nav-link.active {
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff !important;
        }

        .nav-treeview {
            list-style: none;
            padding-left: 20px;
            background: rgba(255, 255, 255, 0.02);
        }

          
    </style>
</head>
<body>

    <aside class="app-sidebar shadow">
        <a href="index.php" class="sidebar-brand">CINESTREAM</a>
        
        <div class="sidebar-wrapper">
            <nav class="nav flex-column">
                
                <a href="index.php" class="nav-link active">
                    <i class="bi bi-speedometer"></i> Dashboard
                </a>

                <div class="nav-item">
                    <a href="#movieMenu"  class="nav-link" data-bs-toggle="collapse">
                        <i class="bi bi-film"></i> Movie Management 
                        <i class="bi bi-chevron-down ms-auto small"></i>
                    </a>
                    <ul class="collapse nav-treeview" id="movieMenu">
                        <li><a href="add-movie.php" class="nav-link">Add Movie</a></li>
                        <li><a href="view-movie.php" class="nav-link">View All Movies</a></li>
                    </ul>
                </div>

                <div class="nav-item">
                    <a href="#cinemaMenu" class="nav-link" data-bs-toggle="collapse">
                        <i class="bi bi-house-door"></i> Cinema Management
                        <i class="bi bi-chevron-down ms-auto small"></i>
                    </a>
                    <ul class="collapse nav-treeview" id="cinemaMenu">
                        <li><a href="add-cinema.php" class="nav-link">Add Cinema</a></li>
                        <li><a href="view-cinema.php" class="nav-link">View Cinema</a></li>
                    </ul>
                </div>

                <a href="view-tickets.php" class="nav-link">
                    <i class="bi bi-ticket-perforated"></i> Booking Management
                </a>

                <a href="view-users.php" class="nav-link">
                    <i class="bi bi-people"></i> Registered Users
                </a>

                <a href="../login.php" class="nav-link text-danger mt-4">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </nav>
        </div>
    </aside>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>