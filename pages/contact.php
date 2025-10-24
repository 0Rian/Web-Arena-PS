<?php
// ===== BAGIAN PHP UNTUK PROSES EMAIL =====

// Variabel untuk menampilkan pesan status
$message_sent = false;
$error_message = '';

// Cek apakah formulir sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    // --- 1. Ambil dan Bersihkan Data (Keamanan) ---
    // strip_tags() untuk menghapus HTML
    // trim() untuk menghapus spasi di awal/akhir
    $name = strip_tags(trim($_POST["name"]));
    $email = strip_tags(trim($_POST["email"]));
    $subject = strip_tags(trim($_POST["subject"]));
    $message_body = strip_tags(trim($_POST["message"]));

    // --- 2. Validasi Data ---
    if (empty($name) || empty($email) || empty($subject) || empty($message_body)) {
        // Cek apakah ada bidang yang kosong
        $error_message = 'Harap isi semua bidang yang wajib diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Cek format email
        $error_message = 'Alamat email yang Anda masukkan tidak valid.';
    } else {
        // --- 3. Jika Lolos Validasi, Kirim Email ---

        // PENTING: Ganti dengan alamat email tujuan Anda!
        $to = "admin@rvbakery.com"; 

        // Siapkan subjek dan isi email
        $email_subject = "Pesan Baru dari Website RV Bakery: $subject";
        
        $email_body = "Anda menerima pesan baru dari formulir kontak website.\n\n";
        $email_body .= "Nama: $name\n";
        $email_body .= "Email: $email\n\n";
        $email_body .= "Pesan:\n$message_body\n";

        // Siapkan Headers Email
        // Header 'From' bisa diatur sesuai domain Anda
        // Header 'Reply-To' SANGAT PENTING agar Anda bisa membalas email pelanggan
        $headers = "From: no-reply@rvbakery.com\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Kirim email menggunakan fungsi mail() bawaan PHP
        if (mail($to, $email_subject, $email_body, $headers)) {
            $message_sent = true; // Sukses
        } else {
            // Gagal mengirim
            $error_message = 'Maaf, terjadi kesalahan. Pesan Anda tidak dapat terkirim.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="stylesheet" href="../css/main.css"> <link rel="stylesheet" href="../css/output.css"> <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - RV Bakery</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    <link rel="icon" href="https://placehold.co/32x32/854d0e/ffffff?text=SB" type="image/png">

    <script>
        // Konfigurasi custom untuk Tailwind CSS
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                        'serif': ['Playfair Display', 'serif'],
                    },
                    colors: {
                        'brand-cream': '#FFF7ED',
                        'brand-brown': {
                            'light': '#A16207',
                            'DEFAULT': '#854D0E',
                            'dark': '#422006'
                        },
                        'brand-gray': '#4B5563'
                    }
                }
            }
        }
    </script>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-brand-cream font-sans text-brand-gray">

<header class="bg-white/80 backdrop-blur-sm sticky top-0 z-50 shadow-md">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="../index.html" class="text-2xl font-serif font-bold text-brand-brown-dark">
            RV Bakery
        </a>
        
        <nav class="hidden md:flex space-x-8">
             <a href="../index.html#about" class="hover:text-brand-brown transition duration-300">Tentang Kami</a>
            <a href="products.html" class="hover:text-brand-brown transition duration-300">Produk</a>
            <a href="../index.html#gallery" class="hover:text-brand-brown transition duration-300">Galeri</a>
            <a href="../index.html#testimonials" class="hover:text-brand-brown transition duration-300">Testimoni</a>
            <a href="contact.php" class="font-bold text-brand-brown transition duration-300">Kontak</a> </nav>

        <div class="md:hidden">
            <button id="menu-btn" class="text-brand-brown-dark focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>
    
    <div id="mobile-menu" class="md:hidden hidden px-6 pb-4 space-y-2">
        <a href="../index.html#about" class="block py-2 hover:text-brand-brown transition duration-300">Tentang Kami</a>
        <a href="products.html" class="block py-2 hover:text-brand-brown transition duration-300">Produk</a>
        <a href="../index.html#gallery" class="block py-2 hover:text-brand-brown transition duration-300">Galeri</a>
        <a href="../index.html#testimonials" class="block py-2 hover:text-brand-brown transition duration-300">Testimoni</a>
        <a href="contact.php" class="block py-2 font-bold text-brand-brown transition duration-300">Kontak</a> </div>
</header>

    
<section id="contact-form" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-brand-brown-dark mb-4">Hubungi Kami</h2>
            <p class="max-w-2xl mx-auto">Ada pertanyaan atau pesanan khusus? Kirimkan pesan kepada kami!</p>
        </div>

        <div class="max-w-2xl mx-auto">
            
            <?php if ($message_sent): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative text-center" role="alert">
                    <strong class="font-bold">Terima kasih!</strong>
                    <span class="block sm:inline">Pesan Anda telah berhasil terkirim. Kami akan segera menghubungi Anda.</span>
                </div>
            <?php endif; ?>

            <?php if (!empty($error_message)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative text-center mb-6" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline"><?php echo $error_message; ?></span>
                </div>
            <?php endif; ?>

            <?php if (!$message_sent): ?>
                <form action="contact.php" method="POST" class="space-y-6">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-brand-brown-dark">Nama Anda</label>
                        <input type="text" id="name" name="name" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-brand-brown focus:border-brand-brown" placeholder="John Doe" required>
                    </div>
                    
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-brand-brown-dark">Email Anda</label>
                        <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-brand-brown focus:border-brand-brown" placeholder="anda@email.com" required>
                    </div>

                    <div>
                        <label for="subject" class="block mb-2 text-sm font-medium text-brand-brown-dark">Subjek</label>
                        <input type="text" id="subject" name="subject" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-brand-brown focus:border-brand-brown" placeholder="Contoh: Pesanan Kue Ulang Tahun" required>
                    </div>
                    
                    <div>
                        <label for="message" class="block mb-2 text-sm font-medium text-brand-brown-dark">Pesan Anda</label>
                        <textarea id="message" name="message" rows="6" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-brand-brown focus:border-brand-brown" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" name="submit" class="bg-brand-brown hover:bg-brand-brown-light text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105">
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            <?php endif; ?>

        </div>
    </div>
</section>


<footer class="bg-brand-brown-dark text-white py-8">
    <div class="container mx-auto px-6 text-center">
        <p>&copy; 2024 RV Bakery. Dibuat dengan ❤.</p>
    </div>
</footer>

<script>
    document.getElementById('menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>

</body>
</html>