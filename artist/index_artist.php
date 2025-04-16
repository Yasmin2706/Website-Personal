<?php include __DIR__ . '/../includes/header.php'; ?>

<head>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../assets/artist-styles.css">
    <link rel="stylesheet" href="../assets/logout-styles.css">
</head>

<body>
    <!-- HEADER BERANDA -->
    <section class="header">
        <div class="header-container">
            <h1>Selamat Datang <br> ✨ Artist Alyza Art ✨</h1>
            <a href="../login/logout.php" class="logout-btn">Logout</a>
        </div>
    </section>
    <div class="artist-dashboard">
        <!-- NAVIGASI -->
        <nav class="artist-nav">
            <ul>
                <li><a href="index_artist.php" class="<?= ($page == 'index_artist.php') ? 'active' : '' ?>">Beranda</a></li>
                <li><a href="order_detail.php" class="<?= ($page == 'order_detail.php') ? 'active' : '' ?>">Order Detail</a></li>
                <li><a href="chat_list.php" class="<?= ($page == 'chat_list.php') ? 'active' : '' ?>">Chat</a></li>
            </ul>
        </nav>
        
        <div class="order-summary">
            <h2>Orders To Complete</h2>
            <div class="summary-cards">
                <div class="summary-card urgent">
                    <h3>Urgent Orders</h3>
                    <p>3</p>
                </div>
                <div class="summary-card in-progress">
                    <h3>In Progress</h3>
                    <p>5</p>
                </div>
                <div class="summary-card new">
                    <h3>New Orders</h3>
                    <p>2</p>
                </div>
            </div>
            
        </div>
    </div>
</body>

<!-- FOOTER -->
<?php include __DIR__ . '/../includes/footer.php'; ?>
