<?php
// Veritabanı bağlantısı
$host = "localhost"; // Veritabanı host'u
$dbname = "airport_db"; // Veritabanı adı
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı şifresi

try {
    // PDO ile veritabanına bağlanıyoruz
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanı bağlantısı başarısız: " . $e->getMessage());
}

// Formdan gelen veriyi işleme
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form verilerini alıyoruz
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Veritabanına verileri ekliyoruz
    $sql = "INSERT INTO iletişim_formu (name, email, phone, message) VALUES (:name, :email, :phone, :message)";
    $stmt = $pdo->prepare($sql);

    // Parametreleri bağlıyoruz
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':message', $message);

    // Veriyi ekliyoruz
    if ($stmt->execute()) {
        echo "Mesajınız başarıyla gönderildi.";
    } else {
        echo "Mesaj gönderilemedi. Lütfen tekrar deneyin.";
    }
}
?>
