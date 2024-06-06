document.addEventListener("DOMContentLoaded", function() {
    // Retrieve the logged-in user information from localStorage
    const loggedInUser = JSON.parse(localStorage.getItem('userData'));
    const jwtToken = localStorage.getItem('jwtToken'); 

    if (loggedInUser) {
        // Display user data on the account page
        document.getElementById('nameAndSurname').textContent = `Name and surname: ${loggedInUser.name || ''}`;
        document.getElementById('email').textContent = `Email: ${loggedInUser.email || ''}`;
        document.getElementById('status').textContent = `Status: ${loggedInUser.active ? "Active" : "Inactive"}`;
        
        console.log("JWT Token:", jwtToken);
    } else {
        console.error("User data not found.");
    }
});
