<?php
session_start();

// Hardcoded user credentials
$valid_users = [
    'admin' => [
        'password' => 'admin123',
        'role' => 'admin',
        'redirect' => '/alyza_art_website/admin/index_admin.php' // Gunakan path absolut
    ],
    'customer' => [
        'password' => 'customer123',
        'role' => 'customer',
        'redirect' => '/alyza_art_website/customer/index_customer.php' // Gunakan path absolut
    ],
    'artist' => [
        'password' => 'artist123',
        'role' => 'artist',
        'redirect' => '/alyza_art_website/artist/index_artist.php' // Gunakan path absolut
    ]
];

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

if (isset($valid_users[$username]) && 
    $password === $valid_users[$username]['password'] && 
    $role === $valid_users[$username]['role']) {
    
    $_SESSION['user'] = $username;
    $_SESSION['role'] = $role;
    
    // Debugging
    echo "Redirecting to: " . $valid_users[$username]['redirect'];
    
    header("Location: " . $valid_users[$username]['redirect']);
    exit();
} else {
    header("Location: /alyza_art_website/index.php?error=invalid_credentials");
    exit();
}
?>
