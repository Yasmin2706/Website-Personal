<?php include __DIR__ . '/../includes/header.php'; ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alyza Art | Digital Commission</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../assets/logout-styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&display=swap" rel="stylesheet">
</head>

<body>
    <!-- HEADER BERANDA -->
    <section class="header">
        <div class="header-container">
            <h1>Selamat Datang di <br> ✨ Alyza Art ✨ <br> Yayas</h1>
            <a href="../login/logout.php" class="logout-btn">Logout</a>
        </div>
    </section>

    <!-- NAVIGASI -->
    <nav>
        <ul>
            <li><a href="index_customer.php" class="<?= ($page == 'index_customer.php') ? 'active' : '' ?>">Beranda</a></li>
            <li><a href="harga.php" class="<?= ($page == 'harga.php') ? 'active' : '' ?>">Harga</a></li>
            <li><a href="order.php" class="<?= ($page == 'order.php') ? 'active' : '' ?>">Pesan Sekarang</a></li>
        </ul>
    </nav>

    <!-- KONTEN BERANDA -->
    <div class="content-section">
        <img src="images/b1.png" alt="Artwork 1">
        <p>🎨 Alyza Art adalah platform yang menerima komisi dari para pelanggan
            yang menginginkan gambar imajinasi yang dituangkan di atas canvas kosong.
            Digital Art berkualitas tinggi dengan harga terjangkau!</p>
    </div>

    <div class="content-section">
        <p>💖 Dibuat dengan penuh kreativitas dan sentuhan personal.</p>
        <img src="images/b2.png" alt="Artwork 2">
    </div>

    <div class="content-section">
        <img src="images/b3.png" alt="Artwork 3">
        <p>📌 Cocok untuk hadiah, avatar, atau koleksi pribadi.</p>
    </div>

    <div class="content-section">
        <p>🔥 Order sekarang dan dapatkan hasil terbaik hanya di Alyza Art!</p>
        <img src="images/b4.png" alt="Artwork 4">
    </div>

    <!-- GALERI -->
    <nav class="galeri-title">
        <ul>
            <li><h3>🎨 Galeri Karya 🎨</h3></li>
        </ul>
    </nav>

    <section id="galeri">
        <div class="gallery">
            <div class="art-item">
                <img src="images/art1.png" alt="Karya 1">
                <p>Cat</p>
            </div>
            <div class="art-item">
                <img src="images/art2.png" alt="Karya 2">
                <p>Dark Fantasy</p>
            </div>
            <div class="art-item">
                <img src="images/art3.png" alt="Karya 3">
                <p>Sunset Dream</p>
            </div>
            <div class="art-item">
                <img src="images/art4.png" alt="Karya 4">
                <p>Maki</p>
            </div>
            <div class="art-item">
                <img src="images/art5.png" alt="Karya 5">
                <p>Gojo</p>
            </div>
            <div class="art-item">
                <img src="images/art6.png" alt="Karya 6">
                <p>Fantasy</p>
            </div>
            <div class="art-item">
                <img src="images/art7.png" alt="Karya 7">
                <p>Butterfly</p>
            </div>
            <div class="art-item">
                <img src="images/art8.png" alt="Karya 8">
                <p>Criminal</p>
            </div>
            <div class="art-item">
                <img src="images/art9.png" alt="Karya 9">
                <p>Suho</p>
            </div>
            <div class="art-item">
                <img src="images/art10.png" alt="Karya 10">
                <p>Lavender</p>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <?php include __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
