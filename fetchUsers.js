document.addEventListener('DOMContentLoaded', () => {
    // Make a request to the /api/users endpoint
    fetch('/api/users')
        .then(response => {
            // Check if the response is successful
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json(); // Parse the JSON in the response
        })
        .then(users => {
            // Select the div where the users will be displayed
            const usersContainer = document.getElementById('users');

            // Iterate over each user and create a paragraph element for each
            users.forEach(user => {
                const userElement = document.createElement('p');
                userElement.textContent = `Name: ${user.name}, Email: ${user.email}`;
                usersContainer.appendChild(userElement); // Append the paragraph to the div
            });
        })
        .catch(error => {
            // Log any errors to the console and display a failure message
            console.error('Error fetching users:', error);
            const usersContainer = document.getElementById('users');
            usersContainer.textContent = 'Failed to load user data.';
        });
});
