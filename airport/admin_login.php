<?php
session_start();
include 'db.php'; // Veritabanı bağlantısını içeri al

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']);

    $query = $conn->prepare("SELECT * FROM admin_users WHERE username = ? AND password = ?");
    $query->execute([$username, $password]);
    $user = $query->fetch();

    if ($user) {
        $_SESSION['admin'] = $user['username'];
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Geçersiz kullanıcı adı veya şifre!";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Giriş</title>
</head>
<body>
    <h2>Admin Panel Girişi</h2>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <label>Kullanıcı Adı:</label>
        <input type="text" name="username" required><br>
        <label>Şifre:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Giriş Yap</button>
    </form>
</body>
</html>
