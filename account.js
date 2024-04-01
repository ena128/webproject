document.addEventListener("DOMContentLoaded", function() {
    // Retrieve the logged-in user ID from localStorage
    const loggedInUserId = localStorage.getItem('loggedInUserId');

    if (loggedInUserId) {
        // Fetch user data based on the logged-in user ID
        fetchUserData(loggedInUserId);
    } else {
        console.error("User ID not provided.");
    }
});

function fetchUserData(userId) {
    fetch('data.json')
        .then(response => response.json())
        .then(data => {
            let user = data.users.find(user => user.id == userId);

            if (user) {
                document.getElementById('name').textContent = user.name;
                document.getElementById('email').textContent = user.email;
                document.getElementById('membership').textContent = user.membership;
                document.getElementById('nameAndSurname').textContent = `Name and surname: ${user.name}`;
                document.getElementById('accountNumber').textContent = `Account number: ${user.id}`;
                
                // Display "Active" or "Inactive" based on the value of the "active" field
                const status = user.active ? "Active" : "Inactive";
                document.getElementById('status').textContent = `Status: ${status}`;
            } else {
                console.error("User not found.");
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
