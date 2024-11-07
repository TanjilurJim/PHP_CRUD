// Toggle sidebar visibility
document.getElementById("toggleIcon").addEventListener("click", function() {
  const sidenav = document.getElementById("sidenav");
  const toggleIcon = document.getElementById("toggleIcon");

  sidenav.classList.toggle("hidden");
  toggleIcon.classList.toggle("hidden");
});

// Logout Alert
document.getElementById("logoutLink").addEventListener("click", function(event) {
  if (!confirm("Are you sure you want to logout?")) {
    event.preventDefault(); // Cancel the logout if the user does not confirm
  }
});

