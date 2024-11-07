<?php
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Check if the username already exists
    $query = "SELECT * FROM admin_login WHERE Admin_name='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username already exists. Please choose another.');</script>";
    } else {
        // Insert the new user into the database with 'normal' role
        $query = "INSERT INTO admin_login (Admin_name, Admin_Password, role) VALUES ('$username', '$password', 'normal')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Registration successful. You can now login.'); window.location.href='login.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
</head>
<body>
  <h2>Register</h2>
  <form action="registration.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Register</button>
  </form>

  <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
