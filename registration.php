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
  <!-- MDB Bootstrap CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet">
  <style>
    @media (min-width: 1025px) {
      .h-custom {
        height: 100vh !important;
      }
    }
  </style>
</head>
<body>
<section class="h-100 h-custom" style="background-color:#D3E4D8;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
          <!-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img3.webp"
            class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
            alt="Sample photo"> -->
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Register</h3>

            <form action="registration.php" method="POST" class="px-md-2">
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="username" name="username" class="form-control" required />
                <label class="form-label" for="username">Username</label>
              </div>

              <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="password" name="password" class="form-control" required />
                <label class="form-label" for="password">Password</label>
              </div>

              <button type="submit" class="btn btn-success btn-lg mb-1">Register</button>
            </form>

            <p class="mt-3">Already have an account? <a href="login.php">Login here</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MDB Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
</body>
</html>
