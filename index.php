<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBin - Modernisasi Pengelolaan Sampah</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }
        h1, h2, h3 {
            color: #166534; /* Dark Green */
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #22c55e; /* Green */
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn:hover {
            background-color: #16a34a; /* Darker Green */
            transform: translateY(-2px);
        }

        /* Header & Navigation */
        .header {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-logo {
            font-size: 28px;
            font-weight: bold;
            color: #166534;
            text-decoration: none;
        }
        .nav-menu a {
            color: #333;
            text-decoration: none;
            margin: 0 15px;
            font-weight: 600;
        }
        .nav-actions .btn-secondary {
            background: none;
            color: #16a34a;
            border: 2px solid #16a34a;
            margin-left: 10px;
        }
        .nav-actions .btn-secondary:hover {
            background-color: #f0fdf4;
            transform: translateY(0);
        }

        /* Hero Section */
        .hero {
            background-color: #f0fdf4; /* Light Green BG */
            text-align: center;
            padding: 80px 0;
        }
        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto 30px auto;
            color: #555;
        }

        /* Features Section */
        .features {
            padding: 70px 0;
            text-align: center;
        }
        .features h2 {
            font-size: 36px;
            margin-bottom: 50px;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            text-align: left;
        }
        .feature-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .feature-card h3 {
            margin-top: 0;
        }

        /* How it Works Section */
        .how-it-works {
            padding: 70px 0;
            background-color: #f0fdf4;
            text-align: center;
        }
        .how-it-works h2 {
            font-size: 36px;
            margin-bottom: 50px;
        }
        .steps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
        }
        .step-card {
            text-align: center;
        }
        .step-number {
            width: 60px;
            height: 60px;
            background-color: #22c55e;
            color: white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* CTA Section */
        .cta {
            background-color: #166534;
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        .cta h2 {
            font-size: 36px;
            color: white;
            margin-bottom: 30px;
        }
        .cta .btn {
            background-color: white;
            color: #166534;
        }

        /* Footer */
        .footer {
            background-color: #14532d;
            color: #d1d5db;
            padding: 40px 0;
        }
        .footer .container {
            text-align: center;
        }
        .footer p {
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-menu { display: none; }
            .hero h1 { font-size: 36px; }
            .steps-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <header class="header">
        <nav class="container navbar">
            <a href="index.php" class="nav-logo">MyBin</a>
            <div class="nav-menu">
                <a href="#features">Layanan</a>
                <a href="#how-it-works">Cara Kerja</a>
                <a href="#">Tentang Kami</a>
            </div>
            <div class="nav-actions">
                <a href="login.php" class="btn btn-secondary">Masuk</a>
                <a href="register.php" class="btn">Daftar</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="container">
                <h1>Ubah Sampah Dapur Anda Menjadi Berkah</h1>
                <p>
                    [cite_start]MyBin adalah platform yang memberdayakan rumah tangga untuk mengubah sampah dapur menjadi sumber daya berharga dengan mudah, transparan, dan menguntungkan[cite: 247].
                </p>
                <a href="register.php" class="btn">Mulai Daur Ulang Sekarang</a>
            </div>
        </section>

        <section id="features" class="features">
            <div class="container">
                <h2>Ekosistem Layanan Terintegrasi</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <h3>Logistik Aliran Ganda</h3>
                        [cite_start]<p>Kami menyediakan layanan pengangkutan sampah organik dan anorganik secara terpisah untuk menjaga kualitas bahan baku kompos[cite: 54, 55, 59].</p>
                    </div>
                    <div class="feature-card">
                        <h3>Marketplace Pupuk Organik</h3>
                        [cite_start]<p>Beli "Pupuk Organik MyBin" berkualitas langsung dari platform kami[cite: 63, 64]. [cite_start]Produk ini merupakan hasil olahan sampah organik Anda[cite: 62].</p>
                    </div>
                    <div class="feature-card">
                        <h3>Poin & Reward Menarik</h3>
                        [cite_start]<p>Dapatkan "Poin MyBin" untuk setiap setoran sampah organik[cite: 74]. [cite_start]Poin dapat ditukar dengan diskon layanan, voucher produk, hingga saldo e-wallet[cite: 77, 78, 79].</p>
                    </div>
                    <div class="feature-card">
                        <h3>Pusat Edukasi Komunitas</h3>
                        [cite_start]<p>Akses berbagai konten edukasi seperti tutorial video dan panduan untuk membantu Anda memilah sampah dengan benar[cite: 50, 51].</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="how-it-works" class="how-it-works">
            <div class="container">
                <h2>Hanya 3 Langkah Mudah</h2>
                <div class="steps-grid">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <h3>Pilah Sampah Organik</h3>
                        [cite_start]<p>Pisahkan sampah organik (sisa makanan, daun, dll) di rumah Anda menggunakan wadah khusus dari kami[cite: 142].</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <h3>Jadwalkan Penjemputan</h3>
                        [cite_start]<p>Pesan layanan penjemputan dengan mudah melalui platform web MyBin sesuai jadwal yang Anda inginkan[cite: 143].</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <h3>Dapatkan Poin & Manfaat</h3>
                        [cite_start]<p>Petugas kami akan menjemput dan menimbang sampah Anda[cite: 144]. [cite_start]Poin akan otomatis masuk ke akun Anda[cite: 145].</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta">
            <div class="container">
                <h2>Siap Memulai Gaya Hidup Berkelanjutan?</h2>
                <a href="register.php" class="btn">Gabung dengan Komunitas MyBin</a>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 MyBin. Semua Hak Cipta Dilindungi.</p>
        </div>
    </footer>

</body>
</html>