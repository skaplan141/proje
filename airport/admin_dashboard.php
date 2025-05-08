<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
            position: fixed;
            width: 250px;
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
    </style>
</head>
<body>
    <div class="sidebar">
        <h3 class="text-center">Admin Paneli</h3>
        <a href="#">🏠 Dashboard</a>
        <a href="manage_flights.php">🛫 Uçuşları Yönet</a>
        <a href="manage_users.php">👤 Kullanıcıları Yönet</a>
        <a href="manage_reservations.php">📅 Rezervasyonları Yönet</a>
        <a href="logout.php" class="text-danger">🚪 Çıkış Yap</a>
    </div>
    <div class="content">
        <h1 class="mb-4">Hoşgeldin, Admin!</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Toplam Uçuşlar</h5>
                        <p class="card-text">120</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Toplam Kullanıcılar</h5>
                        <p class="card-text">450</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-dark">
                    <div class="card-body">
                        <h5 class="card-title">Bekleyen Rezervasyonlar</h5>
                        <p class="card-text">30</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
