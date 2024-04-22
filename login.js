document.querySelector('.form').addEventListener('submit', function(event) {
    event.preventDefault(); 

    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    
    var formData = {
        email: email,
        password: password
    };
    
    fetch('login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            localStorage.setItem('loggedInUser', JSON.stringify({
                membership: data.membership,
                name: data.name,
                accountNumber: data.accountNumber,
                status: data.status
            }));
            window.location.href = "account.html";
        } else {
            alert(data.error || "Login failed. Please check your credentials.");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("An error occurred. Please try again later.");
    });
});
