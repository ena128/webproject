document.querySelector('.form').addEventListener('submit', function(event) {
    event.preventDefault(); 
    
    
    
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    
    var formData = {
        email: email,
        password: password
    };
    
    fetch(loginEndpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); 
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

function login() {
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

   
    let user = users.find(user => user.name === username && user.password === password);

    if (user) {
        
        localStorage.setItem('loggedInUserId', user.id);
        
        window.location.href = "account.html";
    } else {
        alert("Invalid username or password");
    }
}


function updateLoginButton() {
    let currentUser = JSON.parse(localStorage.getItem('currentUser'));
    let loginButton = document.getElementById("login-button");
    
    if (currentUser) {
        loginButton.innerHTML = "Logout";
        loginButton.href = "#home";
    } else {
        loginButton.innerHTML = "Login";
        loginButton.href = "#login";
    }
}

function loginHandle() {
    let currentUser = JSON.parse(localStorage.getItem('currentUser'));
    
    if (currentUser) {
        localStorage.removeItem('currentUser');
        updateLoginButton();
        window.location.href = "#login";
    } else {
        updateLoginButton();
        window.location.href = "#home";
    }
}
