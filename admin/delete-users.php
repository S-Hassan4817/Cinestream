<?php
include('../includes/connection.php');

$id = $_GET['id'];
$delete_query = "DELETE FROM users WHERE id = $id";

if (mysqli_query($conn, $delete_query)) {

    echo "<script>alert('User deleted successfully!'); window.location='view-users.php';</script>";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>