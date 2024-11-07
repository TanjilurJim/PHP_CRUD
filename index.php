<?php 
session_start();

   
    require 'database.php';
    if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'superuser') {
      header("Location: login.php"); // Redirect to login page if not logged in or not an admin
      exit();
  }

  // Fetch all members sorted by registration time (newest first)
  $query = "SELECT id, Admin_name, role, registration_time FROM admin_login WHERE role != 'superuser' ORDER BY registration_time DESC";
  $result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="sass.css">
    <link rel="stylesheet" href="layout.css">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

<div id="sidenav" class="sidenav">
    <div class="brand">
        <img src="rafusoft-logo.svg" alt="Brand Logo" class="brand-logo">
    </div>
    <a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Dashboard</a>
    <a href="registration.php" style="font-family:'Poppins','serif';">ADD Users</a>
    <a href="#" style="font-family:'Poppins','serif';">Projects</a>
    <a href="#">Reports</a>
    <a href="#">Settings</a>
</div>

  <!-- Toggle Icon -->
  <div id="toggleIcon" class="toggle-icon">
    &#9776; <!-- Hamburger icon -->
  </div>
       <!-- Logout Link -->
<div class="logout">
    <a href="logout.php" id="logoutLink">Logout</a>
</div>

  </div>

  <!-- Main Content Area with Centered and Responsive Table -->
  <div style="margin-left: 0px; padding: 100px; background-color: grey; min-height: 100vh;">
  <?php if (isset($_SESSION['username'])): ?>
    <div style="margin-left: 220px; padding: 0px;">
        <h3>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h3>
    </div>
<?php endif; ?>
    <h2 style="margin-left: 200px; padding:20px; font-family:'Poppins','serif';"><b>Registered Members</b></h2>
    <div style="width: ; margin-left:220px;">
        <div class="table-responsive">
            <table class="table table-light table-striped" style="width: 100%; text-align: center;">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Registration Time</th>
                        <th>Actions</th> <!-- New column for actions -->
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['Admin_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                            <td><?php echo htmlspecialchars($row['registration_time']); ?></td>
                            <td>
    <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-sm custom-btn" 
       onclick="return confirm('Are you sure you want to edit this user?');">Edit</a>
    <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn btn-sm custom-btn" 
       onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
</td>


                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>





    <script src="script.js"></script>
</body>
</html>