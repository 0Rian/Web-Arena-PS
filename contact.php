<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nama = htmlspecialchars($_POST['nama']);
  $email = htmlspecialchars($_POST['email']);
  $pesan = htmlspecialchars($_POST['pesan']);

  echo "
  <body style='background:#0f172a;color:white;font-family:sans-serif;text-align:center;padding:60px;'>
    <h1 style='color:#3b82f6;'>Terima kasih, $nama!</h1>
    <p>Pesanmu telah dikirim dengan sukses.</p>
    <p><b>Isi pesan:</b> $pesan</p>
    <a href='index.html' style='color:#9333ea;'>Kembali ke Beranda</a>
  </body>";
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hubungi Kami - Arena PS</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0f172a] text-white font-sans">
<header class="bg-black/90 p-4 text-center text-2xl font-bold text-blue-400">Hubungi Kami</header>

<main class="container mx-auto py-12 px-6 text-center">
  <h2 class="text-3xl font-gaming text-purple-500 mb-6">Kirim Pesan</h2>
  <form action="contact.php" method="POST" class="max-w-lg mx-auto space-y-4 bg-[#1e293b] p-8 rounded-2xl shadow-lg">
    <input type="text" name="nama" placeholder="Nama Lengkap" required class="w-full p-3 rounded text-black">
    <input type="email" name="email" placeholder="Email" required class="w-full p-3 rounded text-black">
    <textarea name="pesan" placeholder="Tulis pesanmu..." required class="w-full p-3 rounded text-black h-32"></textarea>
    <button type="submit" class="bg-purple-600 hover:bg-blue-500 py-3 px-6 rounded-lg font-bold text-white w-full">
      Kirim Sekarang
    </button>
  </form>
</main>

<footer class="text-center text-gray-400 py-6">
  <a href="index.html" class="text-blue-400 hover:underline">← Kembali ke Beranda</a>
</footer>
</body>
</html>
