<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alyza Art | Digital Art Marketplace</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        /* Additional styles for landing page */
        .landing-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .hero-section {
            background-color: #fff8f2;
            border-radius: 15px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .hero-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        .welcome-message {
            font-size: 2.2rem;
            color: #e85b5b;
            margin-bottom: 20px;
            font-family: 'Montserrat', sans-serif;
        }
        
        .description {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #5c3d2e;
            margin-bottom: 30px;
        }
        
        .login-section {
            background-color: #f8d7cc;
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .login-title {
            font-size: 1.5rem;
            color: #5c3d2e;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .form-group label {
            font-weight: bold;
            color: #5c3d2e;
        }
        
        .form-group input, 
        .form-group select {
            padding: 12px;
            border: 2px solid #e89b8d;
            border-radius: 5px;
            font-size: 1rem;
        }
        
        .login-button {
            background-color: #e85b5b;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .login-button:hover {
            background-color: #d44c4c;
        }
    </style>
</head>
<body>
    <div class="landing-container">
        <!-- Hero Section -->
        <section class="hero-section">
            <!-- Tombol Kembali di kanan atas -->
            <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
                <a href="../index.php" style="
                    background-color: #e85b5b;
                    color: white;
                    padding: 8px 16px;
                    border-radius: 5px;
                    text-decoration: none;
                    font-weight: bold;
                    transition: background-color 0.3s;
                " onmouseover="this.style.backgroundColor='#d44c4c'" onmouseout="this.style.backgroundColor='#e85b5b'">
                    ← Kembali
                </a>
            </div>

            <img src="/alyza_art_website/landing-page/images/header-lp.png" alt="Digital Art Showcase" class="hero-image">
            <h1 class="welcome-message">Silakan Login Ke Alyza Art Marketplace</h1>
            <p class="description">
                Tempat terbaik untuk menemukan dan memesan karya seni digital berkualitas tinggi. 
                Jelajahi berbagai gaya seni dari artist berbakat kami, atau jika Anda seorang artist, 
                tawarkan jasa Anda kepada pelanggan di seluruh dunia. Mulai petualangan seni digital Anda bersama kami!
            </p>
        </section>
        
        <!-- Login Section -->
        <section class="login-section">
            <h2 class="login-title">Masuk ke Akun Anda</h2>
            <form action="../login/login.php" method="POST" class="login-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="role">Login Sebagai</label>
                    <select id="role" name="role" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="customer">Customer</option>
                        <option value="artist">Artist</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                
                <button type="submit" class="login-button">Login</button>
            </form>

        </section>
    </div>
</body>
</html>