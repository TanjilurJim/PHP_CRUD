<?php
session_start();
require 'database.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'superuser') {
    header("Location: login.php"); // Redirect to login page if not logged in or not an admin
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user details
    $query = "SELECT * FROM admin_login WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $role = $_POST['role'];
    
    // Update user details in the database
    $updateQuery = "UPDATE admin_login SET Admin_name = '$username', role = '$role' WHERE id = $id";
    mysqli_query($conn, $updateQuery);

    // Redirect back to the admin dashboard
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form action="edit_user.php?id=<?php echo $id; ?>" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $user['Admin_name']; ?>" required>

        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="normal" <?php if ($user['role'] == 'normal') echo 'selected'; ?>>Normal</option>
            <!-- Only "normal" role can be set here -->
        </select>

        <button type="submit">Update</button>
    </form>
</body>
</html>
