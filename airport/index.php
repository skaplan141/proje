<?php
session_start(); // Oturum başlat

// Eğer kullanıcı giriş yapmışsa, kullanıcı adını göster
if (isset($_SESSION['username'])) {
    echo "<h2>Hoş geldiniz, " . $_SESSION['username'] . "!</h2>";
} else {
    echo "<h2>Hoş geldiniz, Ziyaretçi!</h2>"; // Giriş yapmamış kullanıcı için
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anasayfa</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Ana sayfa içeriği -->

</body>
</html>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>SBS HAVACILIK</title>
</head>
<body>

    <header>
        <img src="images/logo.png" alt="Havalimanı Logo" class="logo">
        <h1>SBS HAVACILIK</h1>
        <nav>
            <ul>
                <li><a href="index.php">Ana Sayfa</a></li>
                <li><a href="flights.php">Uçuşlar</a></li>
                <li><a href="iletisim.html">İletişim</a></li>
                <li><a href="register.html">üye ol</a></li>
                

            </ul>
        </nav>
        
        <div class="container">
            
        <h1>NASIL YARDIMCI OLABİLİRİM?</h1>
        <div id="response" class="response"></div>
        <div class="input-container">
            <input type="text" id="user-input" placeholder="Mesajınızı yazın...">
            <button id="send-button">Gönder</button>
        </div>
        
    </div>
    </header>
    <img src="images/hero.jpg" alt="Ana Sayfa Kahraman Resmi" class="hero-image">

    <main class="main-content">
       
<div class="photo-gallery">
    <a href="link1.html">
        <img src="images/photo1.jpg" alt="Fotoğraf 1">
    </a>
    <a href="link2.html">
        <img src="images/photo2.jpg" alt="Fotoğraf 2">
    </a>
    <a href="link3.html">
        <img src="images/photo3.jpg" alt="Fotoğraf 3">
    </a>
</div>

        <section class="slider">
    <div class="slider-container">
        <div class="slide active">
            <img src="slider/foto1.jpg" alt="Geçişli Fotoğraf 1">
           
        </div>
        <div class="slide">
            <img src="slider/foto2.jpg" alt="Geçişli Fotoğraf 2">
        </div>
        <div class="slide">
            <img src="slider/foto3.jpg" alt="Geçişli Fotoğraf 3">
        </div>
       
    </div>
    <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
    <button class="next" onclick="changeSlide(1)">&#10095;</button>
</section>

        <section class="services">
            <h2>Hizmetlerimiz</h2>
            <div class="service-box">
                <img src="images/a1.png" alt="Uçuş İkonu" class="service-icon">
                <h3>Uçuş Rezervasyonu</h3>
                <p>En uygun uçuşları bulun ve rezervasyon yapın.</p>
            </div>
            <div class="service-box">
                <img src="images/a2.png" alt="Otel İkonu" class="service-icon">
                <h3>Otel Rezervasyonu</h3>
                <p>Yurt içi ve yurt dışında en iyi otelleri keşfedin.</p>
            </div>
            <div class="service-box">
                <img src="images/a3.png" alt="Araç İkonu" class="service-icon">
                <h3>Araç Kiralama</h3>
                <p>İhtiyacınıza uygun araçları kiralayın.</p>
            </div>
        </section>


        <section class="customer-reviews">
            <h2>Müşteri Yorumları</h2>
            <div class="reviews-container">
                <div class="review-card">
                    <p>"Harika bir deneyim!"</p>
                    <span>- Müşteri 1</span>
                </div>
                <div class="review-card">
                    <p>"Çok memnun kaldım!"</p>
                    <span>- Müşteri 2</span>
                </div>
                <div class="review-card">
                    <p>"Tekrar geleceğim!"</p>
                    <span>- Müşteri 3</span>
                </div>
            </div>
        </section>
    </main>
   


    <script>
      let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;

function showSlide(index) {
    const sliderContainer = document.querySelector('.slider-container');
    sliderContainer.style.transform = `translateX(-${index * 100}%)`; // Slaytları sola kaydır
}

function changeSlide(direction) {
    currentSlide += direction;
    if (currentSlide >= totalSlides) {
        currentSlide = 0; // İlk slayta geri dön
    } else if (currentSlide < 0) {
        currentSlide = totalSlides - 1; // Son slayta git
    }
    showSlide(currentSlide);
}

// Otomatik geçiş için
setInterval(() => {
    changeSlide(1);
}, 5000); // Her 5 saniyede bir geçiş
function fetchFlights() {
    const city = document.getElementById('flight-city').value;
    const resultsDiv = document.getElementById('flight-results');

    // API isteği
    fetch('http://localhost/flights_api.php', {  // URL'i kendi sunucunuza göre ayarlayın
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ city: city })
    })
    .then(response => response.json())
    .then(data => {
        resultsDiv.innerHTML = ''; // Önceki sonuçları temizle

        if (data.error) {
            resultsDiv.innerHTML = `<p style="color: red;">${data.error}</p>`;
        } else {
            data.forEach(flight => {
                resultsDiv.innerHTML += `
                    <div class="flight">
                        <strong>Güzergah:</strong> ${flight.route}<br>
                        <strong>Fiyat:</strong> ${flight.price} TL<br>
                        <strong>Kalkış:</strong> ${flight.departure}<br>
                        <strong>Varış:</strong> ${flight.arrival}<br>
                    </div>
                `;
            });
        }
    })
    .catch(error => {
        resultsDiv.innerHTML = `<p style="color: red;">Bir hata oluştu: ${error}</p>`;
    });
}


    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <link rel="stylesheet" href="chatbot.css">
</head>
<body>


    <script>
        document.getElementById('send-button').onclick = function() {
            const userInput = document.getElementById('user-input').value;
            if (userInput.trim() === '') return; // Boş mesaj gönderme
            fetch('chatbot.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ message: userInput })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('response').innerText += 'Kullanıcı: ' + userInput + '\n';
                document.getElementById('response').innerText += 'Bot: ' + data.response + '\n';
                document.getElementById('user-input').value = ''; // Giriş alanını temizle
                document.getElementById('response').scrollTop = document.getElementById('response').scrollHeight; // Yanıt alanını kaydır
            });
        };
    </script>
    <footer>
    <div class="footer-container">
      
        <div class="footer-contact">
            <h4>İletişim Bilgileri</h4>
            <p>Email: <a href="mailto:info@sbs_havacilik.com">info@sbs_havacilik.com</a></p>
            <p>Telefon: <a href="tel:1234567890">123-456-7890</a></p>
        </div>
        <div class="footer-social">
            <h4>Sosyal Medya</h4>
            <a href="#" target="_blank">Facebook</a>
            <a href="#" target="_blank">Twitter</a>
            <a href="#" target="_blank">Instagram</a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2025 Ets Tur Havalimanı. Tüm hakları saklıdır.</p>
    </div>
</footer>

</body>
</html>

