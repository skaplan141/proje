<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Uçuşları Listele
$query = $conn->query("SELECT * FROM flights");
$flights = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uçuşları Yönet</title>
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
        <h1 class="mb-4">Uçuşları Yönet</h1>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Uçuş Numarası</th>
                    <th>Kalkış</th>
                    <th>Varış</th>
                    <th>Tarih</th>
                    <th>Saat</th>
                    <th>Fiyat</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flights as $flight): ?>
                    <tr>
                        <td><?= $flight['id'] ?></td>
                        <td><?= $flight['flight_number'] ?></td>
                        <td><?= $flight['departure'] ?></td>
                        <td><?= $flight['arrival'] ?></td>
                        <td><?= $flight['date'] ?></td>
                        <td><?= $flight['time'] ?></td>
                        <td><?= $flight['price'] ?> TL</td>
                        <td>
                            <a href="edit_flight.php?id=<?= $flight['id'] ?>" class="btn btn-warning btn-sm">Düzenle</a>
                            <a href="delete_flight.php?id=<?= $flight['id'] ?>" class="btn btn-danger btn-sm">Sil</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3 class="mt-5">Yeni Uçuş Ekle</h3>
        <form action="add_flight.php" method="POST" class="bg-light p-4 rounded">
            <div class="mb-3">
                <label class="form-label">Uçuş No:</label>
                <input type="text" name="flight_number" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kalkış:</label>
                <input type="text" name="departure" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Varış:</label>
                <input type="text" name="arrival" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tarih:</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Saat:</label>
                <input type="time" name="time" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Fiyat:</label>
                <input type="number" name="price" step="0.01" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Ekle</button>
        </form>
    </div>
</body>
</html>
