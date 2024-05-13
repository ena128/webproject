$(document).ready(function(){
    $('#register-form').submit(function(event){
        event.preventDefault(); // Prevent the form from submitting normally

        // Get form data
        var formData = {
            'name' : $('#name').val(),
            'email' : $('#email').val(),
            'password' : $('#password').val()
        };

        // Send the form data to the server using AJAX
        $.ajax({
            type: 'POST',
            url: 'http://localhost/gymlife-master/register.php',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    console.log("Successful registration.");
                    window.location.href ='#login';
                } else {
                    alert('Registration failed. ' + response.error);
                }

            },
            error: function(xhr, status, error) {
                
               
            }
        });
    });
});
