<?php
session_start();

// Ambil URL lengkap
$currentPath = $_SERVER['REQUEST_URI'];

// Daftar halaman yang boleh diakses tanpa login
$halaman_bebas_login = [
    '/alyza_art_website/landing-page/index.php'
];

// Kalau bukan halaman bebas login, baru cek login
if (!in_array($currentPath, $halaman_bebas_login)) {
    if (!isset($_SESSION['user'])) {
        $role = $_GET['role'] ?? 'customer';
        header("Location: ../login/login.php?role=$role");
        exit();
    }
}

$page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alyza Art | Digital Commission</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&display=swap" rel="stylesheet">
</head>
<body>