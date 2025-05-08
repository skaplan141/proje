document.getElementById("registerForm").addEventListener("submit", function(event) {
    event.preventDefault(); 

    const username = document.getElementById("username").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    const message = document.getElementById("message");

  
    if (password !== confirmPassword) {
        message.textContent = "Şifreler eşleşmiyor!";
        message.style.color = "red";
        return;
    }

   
    if (username && email && password) {
       
        localStorage.setItem("username", username);
        localStorage.setItem("email", email);
        message.textContent = "Kayıt başarılı!";
        message.style.color = "green";

       
        document.getElementById("registerForm").reset();
    } else {
        message.textContent = "Tüm alanları doldurun!";
        message.style.color = "red";
    }
});
