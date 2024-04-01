$(document).ready(function() {
    var usersData = {
        "users": [
            {
                "users": [
                  {
                    "id": 1,
                    "name": "John Doe",
                    "email": "john@example.com",
                    "age": 30,
                    "country": "USA",
                    "membership": "Gold",
                    "password": "john123",
                    "active": true
                  },
                  {
                    "id": 2,
                    "name": "Damir Slipičević",
                    "email": "damir@example.com",
                    "age": 25,
                    "country": "Canada",
                    "membership": "Silver",
                    "password": "damir123",
                    "active": false
                  },
                  {
                    "id": 3,
                    "name": "Bob Johnson",
                    "email": "bob@example.com",
                    "age": 40,
                    "country": "UK",
                    "membership": "Bronze",
                    "password": "bob123",
                    "active": true
                  }
                ]
              }
              
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
                        password: formData.password, 
                        active: true
                    };
                    usersData.users.push(newUser);
                    resolve(newUser);
                }
            }, 1000); 
        });
    }

    $('#register-form').submit(function(e) {
        e.preventDefault(); 

        var formDataArray = $(this).serializeArray();
        var formData = {};
        formDataArray.forEach(function(item) {
            formData[item.name] = item.value;
        });

        addUser(formData).then(function(newUser) {
            console.log('Registration successful:', newUser);
            $('#success-message').show(); 
            $('#register-form').trigger('reset'); 
        }).catch(function(error) {
            console.error('Registration error:', error);
            
        });
    });
});
