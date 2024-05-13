$(document).ready(function() {
    // Add event listener to the login form
    var loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Validate email and password
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            console.log("Email:", email);
            console.log("Password:", password);

            if (!email || !password) {
                console.error("Email and password are required.");
                return;
            }

            // Construct the form data array
            var formData = {
                email: email,
                password: password
            };

            // Call the submitForm function to handle form submission
            submitForm(formData);
        });
    } else {
        console.error("Login form element not found.");
    }

    // Function to handle form submission
    function submitForm(formData) {
        // AJAX request to handle login
        $.ajax({
            type: "POST",
            url: "http://localhost/gymlife-master/login.php", // Correct URL for login processing
            data: JSON.stringify(formData), // Convert data to JSON string
            contentType: "application/json", // Set content type to JSON
            dataType: 'json', // Specify JSON dataType to expect JSON response
            success: function(response) {
                // Handle the success response here
                console.log("Login successful!");
                console.log("Response from server: ", response);
                
                //Check if the JWT token and user data are available in the response
                if (response.jwtToken && response.userData) {
                    // Save the JWT token and user data in the localStorage
                    localStorage.setItem('jwtToken', response.jwtToken);
                    localStorage.setItem('userData', JSON.stringify(response.userData));
            
                    // Redirect the user to the destination page
                    window.location.href = response.redirectUrl || 'account.html'; 
                } else {
                    console.error("JWT token or user data not provided in the response.");
                    // Handle the case when JWT token or user data is not provided
                }
            }
        });
    }
});
