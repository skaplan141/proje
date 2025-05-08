<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Kullanıcıları Listele
$query = $conn->query("SELECT * FROM users");
$users = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcıları Yönet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding: 20px;
            position: fixed;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3 class="text-center">Admin Paneli</h3>
        <a href="admin_dashboard.php">🏠 Dashboard</a>
        <a href="manage_flights.php">🛫 Uçuşları Yönet</a>
        <a href="manage_users.php">👤 Kullanıcıları Yönet</a>
        <a href="manage_reservations.php">📅 Rezervasyonları Yönet</a>
        <a href="logout.php" class="text-danger">🚪 Çıkış Yap</a>
    </div>
    <div class="content">
        <h1 class="mb-4">Kullanıcıları Yönet</h1>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ad</th>
                    <th>Email</th>
                    <th>Oluşturulma Tarihi</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['created_at'] ?></td>
                        <td>
                            <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Düzenle</a>
                            <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-sm">Sil</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
