<?php include __DIR__ . '/../includes/header.php'; ?>

<head>
<link rel="stylesheet" href="../styles.css">
<link rel="stylesheet" href="../assets/admin-styles.css">
<link rel="stylesheet" href="../assets/logout-styles.css">
</head>

<body>
    <!-- HEADER BERANDA -->
    <section class="header">
        <div class="header-container">
            <h1>Selamat Datang <br> ✨ Admin Alyza Art ✨</h1>
            <a href="../login/logout.php" class="logout-btn">Logout</a>
        </div>
    </section>
    <div class="admin-dashboard">
        
        <nav class="admin-nav">
            <ul>
                <li><a href="index_admin.php" class="active">Beranda</a></li>
                <li><a href="order_list.php">Order List</a></li>
            </ul>
        </nav>
        
        <div class="stats-container">
            <div class="stat-box">
                <h3>Total Orders</h3>
                <p>150</p>
            </div>
            <div class="stat-box">
                <h3>Orders in Progress</h3>
                <p>25</p>
            </div>
            <div class="stat-box">
                <h3>Completed Orders</h3>
                <p>125</p>
            </div>
            <div class="stat-box">
                <h3>Total Artists</h3>
                <p>8</p>
            </div>
            <div class="stat-box">
                <h3>Total Customers</h3>
                <p>142</p>
            </div>
        </div>
    </div>
</body>

<?php include __DIR__ . '/../includes/footer.php'; ?>
