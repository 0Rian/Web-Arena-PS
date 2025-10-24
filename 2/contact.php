<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kontak - Arena PS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-arena-dark text-white font-sans">
  <header class="bg-gray-900 shadow-lg fixed w-full top-0 z-50">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
      <h1 class="text-xl font-gaming text-arena-blue">🎮 Arena PS</h1>
      <nav class="space-x-6 font-semibold">
        <a href="index.html" class="hover:text-arena-blue">Beranda</a>
        <a href="about.html" class="hover:text-arena-blue">Tentang</a>
        <a href="contact.php" class="hover:text-arena-blue">Kontak</a>
      </nav>
    </div>
  </header>

  <section class="pt-28 pb-20 text-center px-6">
    <h2 class="text-4xl font-gaming text-arena-blue mb-8">Hubungi Kami</h2>
    <p class="text-arena-gray mb-10">Ada pertanyaan? Kirim pesan ke kami!</p>

    <form action="contact.php" method="POST" class="max-w-lg mx-auto bg-gray-800 p-8 rounded-lg">
      <input type="text" name="nama" placeholder="Nama Anda" class="w-full p-3 mb-4 rounded text-black" required>
      <input type="email" name="email" placeholder="Email Anda" class="w-full p-3 mb-4 rounded text-black" required>
      <textarea name="pesan" rows="4" placeholder="Pesan Anda..." class="w-full p-3 mb-4 rounded text-black" required></textarea>
      <button type="submit" class="bg-arena-purple px-6 py-3 rounded-full font-bold hover:bg-arena-blue transition">Kirim Pesan</button>
    </form>

    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $pesan = $_POST["pesan"];
        echo "<p class='mt-6 text-green-400'>Terima kasih, $nama! Pesan Anda telah terkirim 🎮</p>";
      }
    ?>
  </section>

  <footer class="bg-gray-900 text-center py-6">
    <p class="text-arena-gray">&copy; 2025 Arena PS | Semua Hak Dilindungi</p>
  </footer>
</body>
</html>
