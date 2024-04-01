$(document).ready(function() {
    var usersData = {
        "users": [
            // Your users data from the JSON file
        ]
    };

    function addUser(formData) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                var userExists = usersData.users.some(user => user.email === formData.email);
                if (userExists) {
                    reject("User already exists.");
                } else {
                    var newUser = {
                        id: usersData.users.length + 1,
                        name: formData['full-name'],
                        email: formData.email,
                        address: formData.address,
                        password: formData.password, // Note: Storing passwords in plain text is insecure
                        active: true
                    };
                    usersData.users.push(newUser);
                    resolve(newUser);
                }
            }, 1000); // Simulate a delay as if it were a real AJAX request
        });
    }

    $('#register-form').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var formDataArray = $(this).serializeArray();
        var formData = {};
        formDataArray.forEach(function(item) {
            formData[item.name] = item.value;
        });

        addUser(formData).then(function(newUser) {
            console.log('Registration successful:', newUser);
            $('#success-message').show(); // Show success message
            $('#register-form').trigger('reset'); // Reset form fields
        }).catch(function(error) {
            console.error('Registration error:', error);
            // Optionally, display an error message to the user
        });
    });
});
