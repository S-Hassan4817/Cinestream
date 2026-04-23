<?php
session_start();

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_role'] === 'admin') {
        header("Location: admin/index.php");
    } else {
        header("Location: frontend/website.php");
    }
} else {
    // If not logged in, send them to the login page
    header("Location: login.php");
}   
exit();
?>