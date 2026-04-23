<?php
include('../includes/connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM cinemas WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Hall deleted successfully!'); window.location='view-cinema.php';</script>";
    } else {
        echo "Error: Could not delete hall. " . mysqli_error($conn);
    }
} else {
    header("Location: view-cinema.php");
}
?>