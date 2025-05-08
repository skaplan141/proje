<?php
header('Content-Type: application/json');

$flights = [
    ["route" => "İstanbul - Ankara", "price" => 500, "departure" => "09:00", "arrival" => "10:30"],
    ["route" => "İstanbul - İzmir", "price" => 600, "departure" => "11:00", "arrival" => "12:30"],
    ["route" => "İstanbul - Antalya", "price" => 700, "departure" => "13:00", "arrival" => "14:30"],
    ["route" => "İstanbul - Bodrum", "price" => 650, "departure" => "15:00", "arrival" => "16:30"],
    ["route" => "İstanbul - Kayseri", "price" => 550, "departure" => "17:00", "arrival" => "18:30"],
    ["route" => "İstanbul - Trabzon", "price" => 720, "departure" => "19:00", "arrival" => "20:30"],
    ["route" => "İstanbul - Adana", "price" => 680, "departure" => "21:00", "arrival" => "22:30"],
    ["route" => "İstanbul - Gaziantep", "price" => 590, "departure" => "08:00", "arrival" => "09:30"],
    ["route" => "İstanbul - Mersin", "price" => 650, "departure" => "10:00", "arrival" => "11:30"],
    ["route" => "İstanbul - Bursa", "price" => 450, "departure" => "12:00", "arrival" => "13:30"],
    ["route" => "İstanbul - Eskişehir", "price" => 520, "departure" => "14:00", "arrival" => "15:30"],
    ["route" => "İstanbul - Konya", "price" => 600, "departure" => "18:00", "arrival" => "19:30"],
    ["route" => "İstanbul - Aydın", "price" => 570, "departure" => "20:00", "arrival" => "21:30"],
    ["route" => "Ankara - İzmir", "price" => 500, "departure" => "09:30", "arrival" => "11:00"],
    ["route" => "Ankara - Antalya", "price" => 600, "departure" => "12:30", "arrival" => "14:00"],
    ["route" => "Ankara - Bodrum", "price" => 650, "departure" => "15:30", "arrival" => "17:00"],
    ["route" => "Ankara - Trabzon", "price" => 720, "departure" => "18:30", "arrival" => "20:00"],
    ["route" => "Ankara - Kayseri", "price" => 550, "departure" => "21:30", "arrival" => "23:00"],
    ["route" => "İzmir - Antalya", "price" => 480, "departure" => "10:00", "arrival" => "11:30"],
    ["route" => "İzmir - Bodrum", "price" => 520, "departure" => "12:30", "arrival" => "14:00"],
    ["route" => "İzmir - Kayseri", "price" => 600, "departure" => "15:30", "arrival" => "17:00"],
    ["route" => "İzmir - Trabzon", "price" => 670, "departure" => "18:30", "arrival" => "20:00"],
    ["route" => "Antalya - Bodrum", "price" => 450, "departure" => "09:00", "arrival" => "10:30"],
    ["route" => "Antalya - Kayseri", "price" => 590, "departure" => "11:00", "arrival" => "12:30"],
    ["route" => "Antalya - Trabzon", "price" => 630, "departure" => "13:00", "arrival" => "14:30"],
    ["route" => "Bodrum - Kayseri", "price" => 520, "departure" => "16:00", "arrival" => "17:30"],
    ["route" => "Bodrum - Trabzon", "price" => 700, "departure" => "18:00", "arrival" => "19:30"],
    ["route" => "Kayseri - Trabzon", "price" => 580, "departure" => "20:00", "arrival" => "21:30"],
    ["route" => "İstanbul - Sakarya", "price" => 400, "departure" => "09:15", "arrival" => "10:15"],
    ["route" => "İstanbul - Tekirdağ", "price" => 420, "departure" => "11:15", "arrival" => "12:15"],
    ["route" => "İstanbul - Kocaeli", "price" => 430, "departure" => "13:15", "arrival" => "14:15"],
    ["route" => "İstanbul - Yalova", "price" => 440, "departure" => "15:15", "arrival" => "16:15"],
    ["route" => "Ankara - Sakarya", "price" => 490, "departure" => "09:45", "arrival" => "11:15"],
    ["route" => "Ankara - Tekirdağ", "price" => 510, "departure" => "12:45", "arrival" => "14:15"],
    ["route" => "Ankara - Kocaeli", "price" => 520, "departure" => "15:45", "arrival" => "17:15"],
    ["route" => "Ankara - Yalova", "price" => 530, "departure" => "18:45", "arrival" => "20:15"],
    ["route" => "İzmir - Sakarya", "price" => 480, "departure" => "10:30", "arrival" => "12:00"],
    ["route" => "İzmir - Tekirdağ", "price" => 490, "departure" => "13:30", "arrival" => "15:00"],
    ["route" => "İzmir - Kocaeli", "price" => 500, "departure" => "16:30", "arrival" => "18:00"],
    ["route" => "İzmir - Yalova", "price" => 510, "departure" => "19:30", "arrival" => "21:00"],
    ["route" => "Antalya - Sakarya", "price" => 470, "departure" => "09:00", "arrival" => "10:30"],
    ["route" => "Antalya - Tekirdağ", "price" => 480, "departure" => "11:30", "arrival" => "13:00"],
    ["route" => "Antalya - Kocaeli", "price" => 490, "departure" => "14:30", "arrival" => "16:00"],
    ["route" => "Antalya - Yalova", "price" => 500, "departure" => "17:30", "arrival" => "19:00"],
];

$input = json_decode(file_get_contents('php://input'), true);
$message = trim($input['message']);

// Tüm girişleri küçük harfe çevir
$message = mb_strtolower($message, 'UTF-8');

// Yanıt için başlangıç
$response = '';

if (strpos($message, 'yardım') !== false) {
    $response = "Kullanabileceğiniz komutlar:<br>
    - 'şehir [şehir adı]' : Belirtilen şehirden diğer şehirlere uçuş bilgilerini alırsınız.<br>
    - 'fiyat [min] [max]' : Belirtilen fiyat aralığında uçuş ararsınız.<br>
    - 'zaman [kalkış/varış] [saat]' : Belirtilen saatten sonra kalkış veya varış yapan uçuşları alırsınız.<br>
    - 'sıralama [fiyat/kalkış]' : Uçuşları belirtilen kritere göre sıralarsınız.";
} elseif (strpos($message, 'şehir') !== false) {
    $city = str_replace('şehir ', '', $message); // Kullanıcının girdiği şehir adını al
    $found = false;

    foreach ($flights as $flight) {
        if (stripos($flight['route'], $city) !== false) {
            $response .= "<strong>Güzergah:</strong> {$flight['route']}<br>";
            $response .= "<strong>Fiyat:</strong> {$flight['price']} TL<br>";
            $response .= "<strong>Kalkış:</strong> {$flight['departure']}<br>";
            $response .= "<strong>Varış:</strong> {$flight['arrival']}<br>";
            $response .= "<strong>Uçuş Süresi:</strong> " . (strtotime($flight['arrival']) - strtotime($flight['departure'])) / 60 . " dakika<br><br>";
            $found = true;
        }
    }

    if (!$found) {
        $response = "Üzgünüm, bu şehir için bir uçuş bulamadım. Mevcut şehirler:<br>";
        foreach ($flights as $flight) {
            $response .= "- " . explode(" - ", $flight['route'])[0] . "<br>"; // Güzergahın ilk kısmını al
        }
    }
} elseif (strpos($message, 'fiyat') !== false) {
    preg_match('/fiyat (\d+) (\d+)/', $message, $matches);
    if (count($matches) == 3) {
        $minPrice = (int)$matches[1];
        $maxPrice = (int)$matches[2];
        $found = false;

        foreach ($flights as $flight) {
            if ($flight['price'] >= $minPrice && $flight['price'] <= $maxPrice) {
                $response .= "<strong>Güzergah:</strong> {$flight['route']}<br>";
                $response .= "<strong>Fiyat:</strong> {$flight['price']} TL<br>";
                $response .= "<strong>Kalkış:</strong> {$flight['departure']}<br>";
                $response .= "<strong>Varış:</strong> {$flight['arrival']}<br>";
                $response .= "<strong>Uçuş Süresi:</strong> " . (strtotime($flight['arrival']) - strtotime($flight['departure'])) / 60 . " dakika<br><br>";
                $found = true;
            }
        }

        if (!$found) {
            $response = "Belirtilen fiyat aralığında uçuş bulamadım.";
        }
    } else {
        $response = "Lütfen geçerli bir fiyat aralığı belirtin. Örnek: 'fiyat 400 600'";
    }
} elseif (strpos($message, 'zaman') !== false) {
    preg_match('/zaman (kalkış|varış) (\d{2}:\d{2})/', $message, $matches);
    if (count($matches) == 3) {
        $type = $matches[1];
        $time = $matches[2];
        $found = false;

        foreach ($flights as $flight) {
            if (($type == 'kalkış' && $flight['departure'] > $time) || ($type == 'varış' && $flight['arrival'] > $time)) {
                $response .= "<strong>Güzergah:</strong> {$flight['route']}<br>";
                $response .= "<strong>Fiyat:</strong> {$flight['price']} TL<br>";
                $response .= "<strong>Kalkış:</strong> {$flight['departure']}<br>";
                $response .= "<strong>Varış:</strong> {$flight['arrival']}<br>";
                $response .= "<strong>Uçuş Süresi:</strong> " . (strtotime($flight['arrival']) - strtotime($flight['departure'])) / 60 . " dakika<br><br>";
                $found = true;
            }
        }

        if (!$found) {
            $response = "Belirtilen zamandan sonra uçuş bulamadım.";
        }
    } else {
        $response = "Lütfen geçerli bir zaman belirtin. Örnek: 'zaman kalkış 14:00'";
    }
} elseif (strpos($message, 'sıralama') !== false) {
    $criteria = str_replace('sıralama ', '', $message);
    if ($criteria == 'fiyat') {
        usort($flights, function($a, $b) {
            return $a['price'] <=> $b['price'];
        });
    } elseif ($criteria == 'kalkış') {
        usort($flights, function($a, $b) {
            return strtotime($a['departure']) <=> strtotime($b['departure']);
        });
    } else {
        $response = "Lütfen geçerli bir sıralama kriteri belirtin: 'fiyat' veya 'kalkış'.";
    }

    if (empty($response)) {
        foreach ($flights as $flight) {
            $response .= "<strong>Güzergah:</strong> {$flight['route']}<br>";
            $response .= "<strong>Fiyat:</strong> {$flight['price']} TL<br>";
            $response .= "<strong>Kalkış:</strong> {$flight['departure']}<br>";
            $response .= "<strong>Varış:</strong> {$flight['arrival']}<br>";
            $response .= "<strong>Uçuş Süresi:</strong> " . (strtotime($flight['arrival']) - strtotime($flight['departure'])) / 60 . " dakika<br><br>";
        }
    }
} else {
    $response = 'Lütfen bir komut belirtin. Örneğin: "şehir İstanbul" veya "yardım"';
}

echo json_encode(['response' => nl2br($response)]);
?>
