<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "airport_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // E-posta ile kullanıcıyı sorgula
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Şifreyi kontrol et
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['id']; // Kullanıcı id'sini session'a kaydet
            $_SESSION['username'] = $row['username']; // Kullanıcı adını session'a kaydet

            header("Location: index.php"); // Giriş başarılı, anasayfaya yönlendir
        } else {
            echo "Yanlış şifre!";
        }
    } else {
        echo "Kullanıcı bulunamadı!";
    }
}

$conn->close();
?>

<!-- HTML Kısmı -->
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="üye.css">
</head>
<body>

    <div class="form-container">
        <h2>Giriş Yap</h2>

        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="email">E-posta</label>
                <input type="email" id="email" name="email" placeholder="E-posta adresinizi girin" required>
            </div>

            <div class="input-group">
                <label for="password">Şifre</label>
                <input type="password" id="password" name="password" placeholder="Şifrenizi girin" required>
            </div>

            <button type="submit" name="login" class="submit-btn">Giriş Yap</button>
        </form>

        <p>Hesabınız yok mu? <a href="register.php">Üye Olun</a></p>
    </div>

</body>
</html>
