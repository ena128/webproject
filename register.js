$(document).ready(function(){
    $('#register-form').submit(function(event){
        event.preventDefault(); // Prevent the form from submitting normally

        // Get form data
        var formData = {
            'full-name' : $('#full-name').val(),
            'email' : $('#email').val(),
            'address' : $('#address').val(),
            'password' : $('#password').val()
        };

        // Send the form data to the server using AJAX
        $.ajax({
            type: 'POST',
            url: 'register.php',
            data: formData,
            dataType: 'text',
            encode: true,
            success: function(response) {
                if (response.success) {
                    $('#success-message').show();
                } else {
                    alert('Registration failed. ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                // Handle specific error codes
                if (xhr.status === 405) {
                    alert('Method Not Allowed. Please try again later.');
                } else {
                    // Handle other errors
                    console.error(xhr.responseText);
                    alert('An error occurred. Please try again later.');
                }
            }
        });
    });
});
