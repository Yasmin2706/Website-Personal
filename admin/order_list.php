<?php include __DIR__ . '/../includes/header.php'; ?>

<head>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../assets/admin-styles.css">
    <link rel="stylesheet" href="../assets/logout-styles.css">

    <style>
        /* Notification Style */
        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
            z-index: 1000;
            transition: opacity 0.5s;
        }
        
        .fade-out {
            opacity: 0;
        }
        
        /* Order Management Layout */
        .order-management-wrapper {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }
        
        .order-table-container {
            flex: 2;
        }
        
        .notes-panel {
            flex: 1;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: none;
            height: fit-content;
        }
    </style>
</head>

<body>
    <div class="header-wrapper">
        <a href="../login/logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- NAVIGASI -->
    <header>
        <h1>Order Management</h1>
        <nav class="admin-nav">
            <ul>
                <li><a href="index_admin.php">Beranda</a></li>
                <li><a href="order_list.php"class="active">Order List</a></li>
            </ul>
        </nav>
    </header>

    <!-- TABEL ORDER MANAGEMENT LIST -->
    <div class="admin-container">
        <div class="order-management-wrapper">
            <div class="order-table-container">
                <table class="order-table" id="ordersTable">
                    <thead>
                        <tr>
                            <th>ID Order</th>
                            <th>Nama Customer</th>
                            <th>Jenis Order</th>
                            <th>Status</th>
                            <th>Deadline</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>

            <!-- Panel Catatan -->
            <div class="notes-panel" id="notesPanel">
                <div class="notes-header">
                    <h3>Catatan Order <span id="currentOrderId"></span></h3>
                </div>
                <div class="notes-content" id="notesContent">
                    <p class="no-notes">Pilih order untuk melihat catatan</p>
                </div>
            </div>

            <!-- Modal Add Notes -->
            <div class="modal" id="notesModal" style="display:none;">
                <div class="modal-content">
                    <span class="close-modal">&times;</span>
                    <h3>Tambahkan Catatan</h3>
                    <form id="notesForm">
                        <input type="hidden" id="notesOrderId">
                        <div class="form-group">
                            <textarea id="adminNotes" rows="5" placeholder="Tulis catatan untuk order ini..."></textarea>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn">Simpan Catatan</button>
                            <button type="button" class="btn-cancel" onclick="document.getElementById('notesModal').style.display='none'">Batal</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Form Edit (Hidden) -->
            <div class="edit-form" id="editForm" style="display:none;">
                <h3>Edit Order <span id="editOrderId"></span></h3>
                <form id="orderEditForm">
                    <input type="hidden" id="editId">
                    <div class="form-group">
                        <label>Nama Customer:</label>
                        <input type="text" id="editCustomerName" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Order:</label>
                        <select id="editOrderType">
                            <option value="Full Body + BG">Full Body + BG</option>
                            <option value="Half Body">Half Body</option>
                            <option value="Head Only">Head Only</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deadline:</label>
                        <input type="date" id="editDeadline" required>
                    </div>
                    <button type="submit" class="btn">Simpan</button>
                    <button type="button" class="btn-cancel" onclick="hideEditForm()">Batal</button>
                </form>
            </div>
        </div>

            <script src="../assets/admin-order.js"></script>
    </div>
</body>

<?php include '../includes/footer.php'; ?>