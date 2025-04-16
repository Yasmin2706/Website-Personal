<?php 

include __DIR__ . '/../includes/header.php'; 

// Data statis (bisa dipindahkan ke file terpisah)
$static_orders = [
    [
        'id' => 'ORD-001',
        'customer' => 'John Doe',
        'type' => 'Full Body + BG',
        'status' => 'in_progress',
        'deadline' => '2024-06-15',
        'email' => 'john@example.com',
        'order_date' => '2024-05-20',
        'requests' => 'Please make the character look heroic with a sunset background.',
        'references' => ['art10.png', 'art3.png'],
        'price' => 'Rp 100,000'
    ],
    [
        'id' => 'ORD-002',
        'customer' => 'Jane Smith',
        'type' => 'Head Only',
        'status' => 'pending',
        'deadline' => '2024-06-20',
        'email' => 'jane@example.com',
        'order_date' => '2024-05-22',
        'requests' => 'Warna mata harus biru',
        'references' => ['reference3.jpg'],
        'price' => 'Rp 50,000'
    ]
];

// Inisialisasi session status
if (!isset($_SESSION['order_status'])) {
    $_SESSION['order_status'] = [];
    foreach ($static_orders as $order) {
        $_SESSION['order_status'][$order['id']] = $order['status'];
    }
}

// Handle POST request untuk update status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['progress'], $_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_SESSION['order_status'][$id])) {
        $_SESSION['order_status'][$id] = $_POST['progress'];
        header("Location: order_detail.php?id=$id"); // redirect biar gak repost saat refresh
        exit;
    }
}

// Gabungkan data static dengan status dari session
$orders = array_map(function($order) {
    $order['status'] = $_SESSION['order_status'][$order['id']] ?? $order['status'];
    return $order;
}, $static_orders);

// Get selected order ID
$selected_order_id = isset($_GET['id']) ? $_GET['id'] : (count($orders) > 0 ? $orders[0]['id'] : null);
$selected_order = null;

if ($selected_order_id) {
    foreach ($orders as $order) {
        if ($order['id'] === $selected_order_id) {
            $selected_order = $order;
            break;
        }
    }
}
?>


<head>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../assets/artist-styles.css">
    <link rel="stylesheet" href="../assets/logout-styles.css">
</head>

<body>
    <div class="header-wrapper">
        <a href="../login/logout.php" class="logout-btn">Logout</a>
    </div>
    <!-- NAVIGASI -->
    <header>
        <h1>Order Detail</h1>
        <nav class="artist-nav">
            <ul>
                <li><a href="index_artist.php">Beranda</a></li>
                <li><a href="order_detail.php" class="active">Order Detail</a></li>
                <li><a href="chat_list.php">Chat</a></li>
            </ul>
        </nav>
    </header>

    <div class="order-detail-container">
        <!-- Order List Preview -->
        <div class="order-list">
            <h2>Daftar Order</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Order</th>
                        <th>Nama Customer</th>
                        <th>Jenis Order</th>
                        <th>Status</th>
                        <th>Deadline</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr 
                            class="<?= $order['id'] === $selected_order_id ? 'active' : '' ?>"
                            onclick="window.location.href='?id=<?= $order['id'] ?>'"
                        >
                            <td><?= htmlspecialchars($order['id']) ?></td>
                            <td><?= htmlspecialchars($order['customer']) ?></td>
                            <td><?= htmlspecialchars($order['type']) ?></td>
                            <td><?= ucfirst(str_replace('_', ' ', $order['status'])) ?></td>
                            <td><?= htmlspecialchars($order['deadline']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Order Detail Section -->
        <?php if ($selected_order): ?>
            <div class="order-detail">
                <h2>Detail Order #<?= htmlspecialchars($selected_order['id']) ?></h2>
                
                <div class="order-info">
                    <div class="info-section">
                        <h3>Customer Information</h3>
                        <p><strong>Name:</strong> <?= htmlspecialchars($selected_order['customer']) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($selected_order['email']) ?></p>
                        <p><strong>Order Date:</strong> <?= htmlspecialchars($selected_order['order_date']) ?></p>
                        <p><strong>Deadline:</strong> <?= htmlspecialchars($selected_order['deadline']) ?></p>
                    </div>
                    
                    <div class="info-section">
                        <h3>Order Details</h3>
                        <p><strong>Type:</strong> <?= htmlspecialchars($selected_order['type']) ?></p>
                        <p><strong>Special Requests:</strong> <?= htmlspecialchars($selected_order['requests']) ?></p>
                        <p><strong>Reference Images:</strong> 
                            <?php foreach ($selected_order['references'] as $ref): ?>
                                <a href="#"><?= htmlspecialchars($ref) ?></a>
                            <?php endforeach; ?>
                        </p>
                        <p><strong>Price:</strong> <?= htmlspecialchars($selected_order['price']) ?></p>
                    </div>
                </div>
                
                <div class="progress-section">
                    <h3>Update Progress</h3>
                    <form class="progress-form" method="POST" action="order_detail.php?id=<?= $selected_order['id'] ?>">
                        <div class="form-group">
                            <label>Current Status:</label>
                            <select name="progress" id="progressSelect">
                                <option value="not_started" <?= $selected_order['status'] === 'not_started' ? 'selected' : '' ?>>Not Started</option>
                                <option value="sketch" <?= $selected_order['status'] === 'sketch' ? 'selected' : '' ?>>Sketch Phase</option>
                                <option value="coloring" <?= $selected_order['status'] === 'coloring' ? 'selected' : '' ?>>Coloring Phase</option>
                                <option value="finalizing" <?= $selected_order['status'] === 'finalizing' ? 'selected' : '' ?>>Finalizing</option>
                                <option value="completed" <?= $selected_order['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                            </select>
                        </div>
                        
                        <div class="action-buttons">
                            <a href="chat_list.php?order_id=<?= $selected_order['id'] ?>" class="btn-chat">
                                <i class="fas fa-comments"></i> Chat with Customer
                            </a>
                            <button type="submit" class="btn-update">
                                <i class="fas fa-sync-alt"></i> Update Progress
                            </button>
                        </div>
                    </form>
                </div>
        <?php else: ?>
            <p>Tidak ada order yang dipilih.</p>
        <?php endif; ?>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const progressForm = document.getElementById('progressForm');
        const progressSelect = document.getElementById('progressSelect');
        let currentOrderId = '<?= $selected_order['id'] ?>';
        
        // Object untuk menyimpan status terakhir dari setiap order
        const orderStatuses = {};
        
        // Inisialisasi status awal untuk semua order
        <?php foreach ($orders as $order): ?>
            orderStatuses['<?= $order['id'] ?>'] = '<?= $order['status'] ?>';
        <?php endforeach; ?>
        
        // Set nilai dropdown sesuai order yang dipilih
        progressSelect.value = orderStatuses[currentOrderId];
        
        // Form submission
        progressForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const newStatus = progressSelect.value;
            
            // Update status di memory
            orderStatuses[currentOrderId] = newStatus;
            
            // Update status di table
            const statusCells = document.querySelectorAll(`tr[onclick*="${currentOrderId}"] td:nth-child(4)`);
            statusCells.forEach(cell => {
                cell.textContent = newStatus.replace('_', ' ')
                    .split(' ')
                    .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                    .join(' ');
            });
            
            showNotification('Progress updated successfully!');
            
            // In real application, you would add AJAX call here to update server
            console.log(`Order ${currentOrderId} status updated to ${newStatus}`);
        });
        
        // Update dropdown saat order berubah
        document.querySelectorAll('.order-list tbody tr').forEach(row => {
            row.addEventListener('click', function() {
                // Simpan status order saat ini sebelum pindah
                orderStatuses[currentOrderId] = progressSelect.value;
                
                // Dapatkan orderId yang baru dipilih
                const newOrderId = this.getAttribute('onclick').match(/\?id=(.*?)'/)[1];
                currentOrderId = newOrderId;
                
                // Update dropdown dengan status order yang baru dipilih
                progressSelect.value = orderStatuses[newOrderId];
            });
        });
        
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.innerHTML = `
                <i class="fas fa-check-circle"></i> ${message}
            `;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.classList.add('fade-out');
                setTimeout(() => notification.remove(), 500);
            }, 3000);
        }
    });
    </script>
    </div>
</body>

<?php include __DIR__ . '/../includes/footer.php'; ?>