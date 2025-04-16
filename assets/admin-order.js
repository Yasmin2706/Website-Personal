// Data Order Sementara
let orders = [
    {
        id: "ORD-001",
        customer: "John Doe",
        type: "Full Body + BG",
        status: "in_progress",
        deadline: "2024-06-15",
        notes: "Mohon perhatikan detail background"
    },
    {
        id: "ORD-002",
        customer: "Jane Smith",
        type: "Head Only",
        status: "pending",
        deadline: "2024-06-20",
        notes: "Warna mata harus biru"
    }
];

// Fungsi Render Tabel
function renderOrders() {
    const tbody = document.querySelector('#ordersTable tbody');
    tbody.innerHTML = '';
    
    orders.forEach(order => {
        const row = document.createElement('tr');
        row.dataset.orderId = order.id;
        row.innerHTML = `
            <td>${order.id}</td>
            <td>${order.customer}</td>
            <td>${order.type}</td>
            <td>
                <select class="status-select" data-order="${order.id}">
                    <option value="pending" ${order.status === 'pending' ? 'selected' : ''}>Pending</option>
                    <option value="in_progress" ${order.status === 'in_progress' ? 'selected' : ''}>In Progress</option>
                    <option value="completed" ${order.status === 'completed' ? 'selected' : ''}>Completed</option>
                </select>
            </td>
            <td>${order.deadline}</td>
            <td>
                <button class="btn-edit" data-order="${order.id}">Edit</button>
                <button class="btn-notes" data-order="${order.id}">Notes</button>
            </td>
        `;
        tbody.appendChild(row);
        
        if (window.currentOrderId === order.id) {
            showNotes(order.id);
            row.style.backgroundColor = '#fff8f2';
        }
    });
}

// Tampilkan Catatan
function showNotes(orderId) {
    const order = orders.find(o => o.id === orderId);
    if (order) {
        document.getElementById('currentOrderId').textContent = order.id;
        document.getElementById('notesContent').innerHTML = order.notes 
            ? `<p>${order.notes}</p>` 
            : '<p class="no-notes">Belum ada catatan</p>';
        document.getElementById('notesPanel').style.display = 'block';
    }
}

// Form Add Notes
function showNotesForm(orderId) {
    const order = orders.find(o => o.id === orderId);
    if (order) {
        document.getElementById('notesOrderId').value = order.id;
        document.getElementById('adminNotes').value = order.notes;
        document.getElementById('notesModal').style.display = 'flex';
    }
}

// Update Status
function updateStatus(orderId, status) {
    const order = orders.find(o => o.id === orderId);
    if (order) {
        order.status = status;
        showNotification(`Status ${orderId} diperbarui: ${status}`);
    }
}

// Notifikasi
function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.add('fade-out');
        setTimeout(() => notification.remove(), 500);
    }, 3000);
}

// Event Listeners
document.addEventListener('DOMContentLoaded', () => {
    renderOrders();
    
    // Status Change
    document.addEventListener('change', (e) => {
        if (e.target.classList.contains('status-select')) {
            const orderId = e.target.dataset.order;
            const status = e.target.value;
            updateStatus(orderId, status);
        }
    });
    
    // Klik row
    document.querySelector('#ordersTable tbody').addEventListener('click', (e) => {
        const row = e.target.closest('tr');
        if (row && row.dataset.orderId) {
            showNotes(row.dataset.orderId);
            document.querySelectorAll('#ordersTable tr').forEach(r => {
                r.style.backgroundColor = r === row ? '#fff8f2' : '';
            });
        }
    });
    
    // Notes Button
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('btn-notes')) {
            const orderId = e.target.dataset.order;
            showNotesForm(orderId);
        }
    });
    
    // Save Notes
    document.getElementById('notesForm').addEventListener('submit', (e) => {
        e.preventDefault();
        const orderId = document.getElementById('notesOrderId').value;
        const notes = document.getElementById('adminNotes').value;
        
        const order = orders.find(o => o.id === orderId);
        if (order) {
            order.notes = notes;
            document.getElementById('notesModal').style.display = 'none';
            showNotes(orderId);
            showNotification(`Catatan untuk ${orderId} disimpan`);
        }
    });
    
    // Close Modal
    document.querySelector('.close-modal').addEventListener('click', () => {
        document.getElementById('notesModal').style.display = 'none';
    });

    // Edit Button
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('btn-edit')) {
            const orderId = e.target.dataset.order;
            showEditForm(orderId);
        }
    });
    
    // Edit Form Submission
    document.getElementById('orderEditForm').addEventListener('submit', handleEditFormSubmit);
    
    // Close modal when clicking outside
    document.getElementById('editForm').addEventListener('click', (e) => {
        if (e.target === document.getElementById('editForm')) {
            hideEditForm();
        }
    });
});

// Show the edit form
function showEditForm(orderId) {
    const order = orders.find(o => o.id === orderId);
    if (order) {
        document.getElementById('editOrderId').textContent = order.id;
        document.getElementById('editId').value = order.id;
        document.getElementById('editCustomerName').value = order.customer;
        document.getElementById('editOrderType').value = order.type;
        document.getElementById('editDeadline').value = order.deadline;
        document.getElementById('editForm').style.display = 'block';
    }
}

// Hide the edit form
function hideEditForm() {
    document.getElementById('editForm').style.display = 'none';
}

// Handle form submission
function handleEditFormSubmit(e) {
    e.preventDefault();
    const orderId = document.getElementById('editId').value;
    const customerName = document.getElementById('editCustomerName').value;
    const orderType = document.getElementById('editOrderType').value;
    const deadline = document.getElementById('editDeadline').value;
    
    const order = orders.find(o => o.id === orderId);
    if (order) {
        order.customer = customerName;
        order.type = orderType;
        order.deadline = deadline;
        
        renderOrders();
        hideEditForm();
        showNotification(`Order ${orderId} berhasil diperbarui`);
    }
}