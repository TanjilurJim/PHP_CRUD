<?php
session_start();
require 'database.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'superuser') {
    header("Location: login.php"); // Redirect to login page if not logged in or not an admin
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the user from the database
    $query = "DELETE FROM admin_login WHERE id = $id";
    mysqli_query($conn, $query);

    // Redirect back to the admin dashboard
    header("Location: index.php");
    exit();
}
?>
