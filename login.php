<?php
require 'database.php';

$error_message = ''; // Initialize an error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //============== Query to check if the user exists in the `admin_login` table==================
    $query = "SELECT * FROM admin_login WHERE Admin_name='$username'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn)); // Debugging line for SQL query issues
    }

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Directly compare passwords as plain text for testing
        if ($password === $user['Admin_Password']) {
            // Start session and set session variables
            session_start();
            $_SESSION['username'] = $user['Admin_name'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] == 'superuser') {
                header("Location: index.php"); // Redirect superuser to admin dashboard (index.php)
            } else {
                header("Location: https://rafusoft.com/");
            }
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "Invalid username.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .rounded-t-5 {
      border-top-left-radius: 0.5rem;
      border-top-right-radius: 0.5rem;
    }

    @media (min-width: 992px) {
      .rounded-tr-lg-0 {
        border-top-right-radius: 0;
      }

      .rounded-bl-lg-5 {
        border-bottom-left-radius: 0.5rem;
      }
    }

    .image-full-height {
      height: 100%;
      object-fit: cover;
    }

    .checkbox-and-button {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    html, body {
  height: 100%;
  margin: 0; /* Remove any default margins */
  overflow-x: hidden; /* Prevent horizontal scrolling */
}

section {
  min-height: calc(100vh - 50px); /* Adjust height to fit the footer */
  box-sizing: border-box; /* Ensure padding doesn't break layout */
}

footer {
  text-align: center;
  position: relative;
  bottom: 0;
  width: 100%;
  height: 50px;
   /* Optional: Background color for clarity */
  display: flex; /* Use flexbox for centering */
  align-items: center; /* Center vertically */
  justify-content: center; /* Center horizontally */
  /* margin-top: 7px; */
}
  </style>
</head>
<body>

<!-- Section: Design Block -->
<section class="text-center text-lg-start">
  <div class="card mb-3">
    <div class="row g-0 d-flex align-items-stretch">
      <div class="col-lg-4 d-none d-lg-flex">
        <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" alt="Trendy Pants and Shoes"
          class="w-100 image-full-height rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
      </div>
      <div class="col-lg-8">
        <div class="card-body py-5 px-md-5">

          <form action="login.php" method="POST">
            <!-- Display error message if needed -->
            <?php if (!empty($error_message)): ?>
              <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error_message); ?>
              </div>
            <?php endif; ?>

            <!-- Username input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="text" id="username" name="username" class="form-control" required />
              <label class="form-label" for="username">Username</label>
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="password" id="password" name="password" class="form-control" required />
              <label class="form-label" for="password">Password</label>
            </div>

            <!-- Checkbox and Sign in button alignment -->
            <div class="checkbox-and-button mb-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                <label class="form-check-label" for="form2Example31"> Remember me </label>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </div>
          </form>

          <p>Don't have an account? <a href="registration.php">Register here</a></p>

        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->
<footer>
  <p>&copy; 2024 Jim. All rights reserved.</p>
</footer>

</body>
</html>