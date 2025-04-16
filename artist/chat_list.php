<?php
session_start();

// Buat dummy list order kalau belum ada

if (!isset($_SESSION['chats'])) {
    $_SESSION['chats'] = [
        'ORD-001' => [
            ['sender' => 'customer', 'message' => 'Halo, ini request saya.'],
            ['sender' => 'artist', 'message' => 'Siap kak, akan saya kerjakan.'],
        ],
        'ORD-002' => [
            ['sender' => 'customer', 'message' => 'Bisa tambahkan warna merah?'],
            ['sender' => 'artist', 'message' => 'Tentu, saya ubah yaa.'],
        ],
        'ORD-003' => [
            ['sender' => 'customer', 'message' => 'Kapan bisa selesai ya?'],
        ],
    ];
}

$chatList = $_SESSION['chats'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../assets/artist-styles.css">
    <link rel="stylesheet" href="../assets/logout-styles.css">
    <meta charset="UTF-8">
    <title>Daftar Chat Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff0e5;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: #fff;
            padding: 16px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .chat-list {
            list-style: none;
            padding: 0;
        }

        .chat-item {
            background-color: #f8d7cc;
            padding: 12px 16px;
            margin-bottom: 10px;
            border-radius: 8px;
            transition: background 0.2s;
        }

        .chat-item:hover {
            background-color: #f8d7cc;
        }

        .chat-link {
            text-decoration: none;
            color: #333;
            display: block;
        }

        .chat-order-id {
            font-weight: bold;
            color: #e85b5b;
        }

        .last-message {
            font-size: 14px;
            color: #555;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="header-wrapper">
            <a href="../login/logout.php" class="logout-btn">Logout</a>
        </div>
        <!-- NAVIGASI -->
        <header>
            <h1>Chat</h1>
        </header>
        <nav class="artist-nav">
            <ul>
                <li><a href="index_artist.php">Beranda</a></li>
                <li><a href="order_detail.php">Order Detail</a></li>
                <li><a href="chat_list.php" class="active">Chat</a></li>
            </ul>
        </nav>
        <div class="container">
            <h2>Chat - Order ID</h2>
            <ul class="chat-list">
                <?php foreach ($chatList as $orderId => $messages): ?>
                    <?php $last = end($messages); ?>
                    <li class="chat-item">
                        <a class="chat-link" href="chat.php?order_id=<?= urlencode($orderId) ?>">
                            <div class="chat-order-id">Order ID: <?= htmlspecialchars($orderId) ?></div>
                            <div class="last-message">
                                <?= ucfirst($last['sender']) ?>: <?= htmlspecialchars($last['message']) ?>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php include '../includes/footer.php'; ?>
    </div>
</body>
</html>
