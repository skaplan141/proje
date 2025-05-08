<?php
session_start();
include('db.php');

// Sepete uçuş ekleme işlemi
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $flight_route = $_POST['route'];
    $price = $_POST['price'];
    $departure = $_POST['departure'];
    $arrival = $_POST['arrival'];
    
    // Kullanıcı ID'sini dinamik al (örneğin, oturumdan)
    $user_id = 1; // Şu anda sabit, ancak bunu session'dan alabilirsiniz.
    
    // Veritabanına ekleme sorgusu
    $sql = "INSERT INTO cart (user_id, flight_route, price, departure, arrival) 
            VALUES ('$user_id', '$flight_route', '$price', '$departure', '$arrival')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Uçuş başarıyla sepete eklendi!";
    } else {
        echo "Hata: " . $conn->error;
    }
}

// Sepete eklenen uçuşları çekme
$user_id = 1; // Bu kısmı kullanıcıya göre dinamik hale getirebilirsiniz
$sql_cart = "SELECT * FROM cart WHERE user_id = '$user_id'";
$result_cart = $conn->query($sql_cart);
$cart_items = [];

if ($result_cart->num_rows > 0) {
    while ($row = $result_cart->fetch_assoc()) {
        $cart_items[] = $row;
    }
}

// Daha fazla uçuş örneği
$flights = [
    ['route' => 'İstanbul - Paris', 'price' => 1000, 'departure' => '10:00', 'arrival' => '12:00'],
    ['route' => 'İstanbul - Londra', 'price' => 1200, 'departure' => '14:00', 'arrival' => '16:00'],
    ['route' => 'İstanbul - Berlin', 'price' => 900, 'departure' => '18:00', 'arrival' => '20:00'],
    ['route' => 'İstanbul - New York', 'price' => 2500, 'departure' => '08:00', 'arrival' => '11:00'],
    ['route' => 'İstanbul - Tokyo', 'price' => 3000, 'departure' => '21:00', 'arrival' => '15:00'],
    ['route' => 'İstanbul - Dubai', 'price' => 1500, 'departure' => '06:00', 'arrival' => '09:30'],
    ['route' => 'İstanbul - Roma', 'price' => 1100, 'departure' => '12:00', 'arrival' => '14:30'],
    ['route' => 'İstanbul - Madrid', 'price' => 1300, 'departure' => '16:00', 'arrival' => '18:30'],
    ['route' => 'İstanbul - Bangkok', 'price' => 2500, 'departure' => '20:00', 'arrival' => '23:30'],
    ['route' => 'İstanbul - Los Angeles', 'price' => 3500, 'departure' => '09:00', 'arrival' => '13:30'],
    ['route' => 'İstanbul - Sydney', 'price' => 4000, 'departure' => '15:00', 'arrival' => '19:30'],
    ['route' => 'İstanbul - Cape Town', 'price' => 2800, 'departure' => '07:00', 'arrival' => '12:00'],
    ['route' => 'İstanbul - Rio de Janeiro', 'price' => 2700, 'departure' => '13:00', 'arrival' => '18:00'],
    ['route' => 'İstanbul - Johannesburg', 'price' => 3000, 'departure' => '10:30', 'arrival' => '15:30'],
    ['route' => 'İstanbul - Cancun', 'price' => 2200, 'departure' => '14:30', 'arrival' => '19:00'],
    ['route' => 'İstanbul - Buenos Aires', 'price' => 3200, 'departure' => '17:00', 'arrival' => '22:00'],
    ['route' => 'İstanbul - Santiago', 'price' => 3400, 'departure' => '11:00', 'arrival' => '15:30'],
    ['route' => 'İstanbul - Cairo', 'price' => 950, 'departure' => '22:00', 'arrival' => '23:45'],
    ['route' => 'İstanbul - Athens', 'price' => 800, 'departure' => '05:30', 'arrival' => '07:00'],
    ['route' => 'İstanbul - Amsterdam', 'price' => 1300, 'departure' => '08:30', 'arrival' => '11:00'],
    ['route' => 'İstanbul - Stockholm', 'price' => 1400, 'departure' => '17:30', 'arrival' => '21:00']
];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uçuş Rezervasyon Sistemi</title>
    <style>
        /* Stil kısmı */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        .flight {
            background: white;
            padding: 20px;
            margin: 10px 0;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .flight h2 {
            color: #007bff;
            margin-bottom: 10px;
        }
        .flight p {
            margin: 5px 0;
        }
        .button {
            background: linear-gradient(45deg, #27ae60, #2ecc71);
            color: white;
            padding: 12px 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            font-size: 16px;
        }
        .button:hover {
            background: linear-gradient(45deg, #219653, #1e8449);
            transform: scale(1.05);
        }
        .cart {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        .cart h3 {
            color: #007bff;
        }
        .cart ul {
            list-style: none;
            padding: 0;
        }
        .cart li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Uçuşlar</h1>
    
    <!-- Uçuşları görüntüle -->
    <?php
    foreach ($flights as $flight) {
        echo "<div class='flight'>";
        echo "<h2>" . $flight['route'] . "</h2>";
        echo "<p>Fiyat: " . $flight['price'] . " TL</p>";
        echo "<p>Kalkış: " . $flight['departure'] . " - Varış: " . $flight['arrival'] . "</p>";
        echo "<form method='POST' action=''>
                <input type='hidden' name='route' value='" . $flight['route'] . "'>
                <input type='hidden' name='price' value='" . $flight['price'] . "'>
                <input type='hidden' name='departure' value='" . $flight['departure'] . "'>
                <input type='hidden' name='arrival' value='" . $flight['arrival'] . "'>
                <button type='submit' name='add_to_cart' class='button'>Sepete Ekle</button>
              </form>";
        echo "</div>";
    }
    ?>

    <!-- Sepet İçeriği -->
    <div class="cart">
        <h3>Sepetiniz</h3>
        <ul>
            <?php
            if (!empty($cart_items)) {
                foreach ($cart_items as $item) {
                    echo "<li>" . $item['flight_route'] . " - " . $item['price'] . " TL</li>";
                }
            } else {
                echo "<li>Sepetiniz boş.</li>";
            }
            ?>
        </ul>
    </div>

</body>
</html>
