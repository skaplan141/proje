<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı şifresi
$dbname = "airport_db"; // Veritabanı adı

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}

if (isset($_POST['register'])) {
    $username = $_POST['username']; // Kullanıcı adı
    $email = $_POST['email']; // E-posta
    $password = $_POST['password']; // Şifre

    // E-posta adresinin zaten kaydedilip edilmediğini kontrol et
    $email_check = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($email_check);

    if ($result->num_rows > 0) {
        // Eğer e-posta zaten varsa, hata mesajı göster
        header("Location: register.php?error=Bu e-posta adresi zaten kullanılıyor!");
    } else {
        // Şifreyi güvenli bir şekilde hashle
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Kullanıcıyı veritabanına ekle
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            header("Location: login.php?message=Başarıyla üye oldunuz, giriş yapabilirsiniz.");
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();
?>
