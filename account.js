document.addEventListener("DOMContentLoaded", function() {
    // Retrieve the logged-in user information from localStorage
    const loggedInUser = JSON.parse(localStorage.getItem('loggedInUser'));

    if (loggedInUser) {
        // Display user data on the account page
        document.getElementById('name').textContent = loggedInUser.name;
        document.getElementById('email').textContent = loggedInUser.email;
        document.getElementById('membership').textContent = loggedInUser.membership;
        document.getElementById('nameAndSurname').textContent = `Name and surname: ${loggedInUser.name}`;
        document.getElementById('accountNumber').textContent = `Account number: ${loggedInUser.id}`;
        document.getElementById('status').textContent = `Status: ${loggedInUser.active ? "Active" : "Inactive"}`;
    } else {
        console.error("User data not found.");
    }
});
