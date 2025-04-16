<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Sekarang - Alyza Art</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="/alyza_art_website/styles.css">
    <link rel="stylesheet" href="../assets/logout-styles.css">
    <style>
        /* Styling agar form rapi dan seragam */
        .order-form {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
        }

        .order-form form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .order-form label {
            font-weight: bold;
        }

        .order-form input, 
        .order-form select, 
        .order-form textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e85b5b;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box; /* Biar padding nggak bikin ukuran kacau */
        }

        .order-form textarea {
            height: 120px;
            resize: none;
        }

        /* Styling untuk opsi gambar */
        .opsi-gambar {
            display: flex;
            justify-content: space-between;
            gap: 15px;
        }

        .opsi-gambar label {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 8px;
            border: 2px solid #e85b5b;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .opsi-gambar input {
            transform: scale(1.2); /* Biar radio button lebih jelas */
        }

        /* Biar metode pembayaran nggak beda ukuran */
        .order-form select {
            height: 48px; /* Disamakan biar setara dengan input lainnya */
        }

        /* Styling tombol */
        button {
            background-color: #e85b5b;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #d88577;
        }
    </style>
</head>

<body>
    <div class="header-wrapper">
        <a href="../login/logout.php" class="logout-btn">Logout</a>
    </div>
    <!-- NAVIGASI -->
    <header>
        <h1>Form Pemesanan</h1>
        <nav>
            <ul>
                <li><a href="index_customer.php">Beranda</a></li>
                <li><a href="harga.php">Harga</a></li>
                <li><a href="order.php" class="active">Pesan Sekarang</a></li>
            </ul>
        </nav>
    </header>

    <section class="order-form">
        <form action="proses_pemesanan.php" method="POST">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="tanggal">Tanggal Pesan:</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label>Opsi Gambar:</label>
            <div class="opsi-gambar">
                <label for="tanpa_bg">
                    <input type="radio" id="tanpa_bg" name="opsi" value="tanpa_bg" required>
                    Tanpa Background
                </label>

                <label for="dengan_bg">
                    <input type="radio" id="dengan_bg" name="opsi" value="dengan_bg">
                    Dengan Background (+Rp 30.000)
                </label>
            </div>

            <label for="pembayaran">Metode Pembayaran:</label>
            <select id="pembayaran" name="pembayaran" required>
                <option value="transfer">Transfer Bank</option>
                <option value="ewallet">E-Wallet (Dana, OVO, Gopay)</option>
                <option value="cod">COD (Bayar di Tempat)</option>
            </select>

            <button type="button" onclick="cekForm()">Pesan Sekarang</button>
        </form>
    </section>

    <!-- POP-UP DATA HARUS LENGKAP -->
    <div id="popup-incomplete" style="display: none;">
        <div style="
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        ">
            <div style="
                background-color: #fff0f0;
                padding: 30px;
                border-radius: 10px;
                max-width: 400px;
                width: 90%;
                position: relative;
                text-align: center;
                box-shadow: 0 0 10px rgba(0,0,0,0.3);
            ">
                <!-- Tombol X -->
                <span onclick="tutupPopup()" style="
                    position: absolute;
                    top: 10px;
                    right: 15px;
                    font-size: 20px;
                    font-weight: bold;
                    cursor: pointer;
                    color: #e85b5b;
                ">&times;</span>

                <h3>Data harus lengkap</h3>
                <p>Silakan isi semua form sebelum melakukan pemesanan.</p>
            </div>
        </div>
    </div>

    <!-- POP-UP BERHASIL -->
    <div id="popup-success" style="display: none;">
        <div style="
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        ">
            <div style="
                background-color: #fff0f0;
                padding: 30px;
                border-radius: 10px;
                max-width: 400px;
                width: 90%;
                position: relative;
                text-align: center;
                box-shadow: 0 0 10px rgba(0,0,0,0.3);
            ">
                <!-- Tombol X -->
                <span onclick="tutupPopupSuccess()" style="
                    position: absolute;
                    top: 10px;
                    right: 15px;
                    font-size: 20px;
                    font-weight: bold;
                    cursor: pointer;
                    color: #e85b5b;
                ">&times;</span>

                <h3>Berhasil Memesan</h3>
                <p>Terima kasih! Pesanan kamu sudah dikirim.</p>
            </div>
        </div>
    </div>

    <script>
        function cekForm() {
            const nama = document.getElementById("nama").value.trim();
            const email = document.getElementById("email").value.trim();
            const tanggal = document.getElementById("tanggal").value.trim();
            const opsi = document.querySelector('input[name="opsi"]:checked');
            const pembayaran = document.getElementById("pembayaran").value.trim();

            if (!nama || !email || !tanggal || !opsi || !pembayaran) {
                document.getElementById("popup-incomplete").style.display = "block";
            } else {
                document.getElementById("popup-success").style.display = "block";
            }
        }

        function tutupPopup() {
            document.getElementById("popup-incomplete").style.display = "none";
        }
        function tutupPopupSuccess() {
            document.getElementById("popup-success").style.display = "none";
        }
    </script>

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2024 Alyza Art | Instagram: <a href="https://www.instagram.com/alyza.art" target="_blank">@alyza.art</a></p>
    </footer>

</body>
</html>
