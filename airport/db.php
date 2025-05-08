<?php
$servername = "localhost";
$username = "root"; // XAMPP varsayılan kullanıcı adı
$password = "";     // XAMPP varsayılan şifre boş
$dbname = "airport_db"; // Veritabanı adını buraya yazın

// Veritabanı bağlantısını kur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı hatası kontrolü
if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}
?>
