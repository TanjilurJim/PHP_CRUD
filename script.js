// Toggle sidebar visibility
document.getElementById("toggleIcon").addEventListener("click", function () {
  const sidenav = document.getElementById("sidenav");
  const toggleIcon = document.getElementById("toggleIcon");

  // Toggle the "hidden" class on the sidebar
  sidenav.classList.toggle("hidden");

  // Adjust the position of the toggle icon
  if (sidenav.classList.contains("hidden")) {
    toggleIcon.classList.add("hidden"); // Move the toggle icon to the left
  } else {
    toggleIcon.classList.remove("hidden"); // Move the toggle icon back to its original position
  }
});

// Logout Modal Trigger
document.getElementById("logoutLink").addEventListener("click", function (event) {
  event.preventDefault(); // Prevent default link behavior for logout
  const logoutModal = new bootstrap.Modal(document.getElementById("logoutModal")); // Initialize Bootstrap modal
  logoutModal.show(); // Show the modal
});
// Confirm logout button in the modal
document.getElementById("confirmLogoutButton").addEventListener("click", function () {
  window.location.href = "logout.php"; // Redirect to logout page
});

// Set data for Edit Modal
function setEditModalData(userId, userName) {
  document.getElementById("editUserName").textContent = userName; // Update username in modal
  document.getElementById("confirmEditButton").onclick = function () {
    window.location.href = `edit_user.php?id=${userId}`; // Redirect to Edit URL
  };
}

// Set data for Delete Modal
function setDeleteModalData(userId, userName) {
  document.getElementById("deleteUserName").textContent = userName; // Update username in modal
  document.getElementById("confirmDeleteButton").onclick = function () {
    window.location.href = `delete_user.php?id=${userId}`; // Redirect to Delete URL
  };
}

// Ensure proper dismissal of modals and cleanup of backdrops
document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
  button.addEventListener("click", function () {
    const modalBackdrop = document.querySelector(".modal-backdrop");
    if (modalBackdrop) {
      modalBackdrop.parentNode.removeChild(modalBackdrop); // Remove leftover backdrop
    }
  });
});
