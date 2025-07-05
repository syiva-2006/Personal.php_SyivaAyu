<?php
include('koneksi.php');

// Ambil artikel berdasarkan ID
$id_artikel = $_GET['id'];
$artikel = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM tbl_artikel WHERE id_artikel = '$id_artikel'"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($artikel['nama_artikel']); ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class'
    }
  </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen transition-colors duration-300">

  <!-- Header -->
  <header class="bg-red-800 dark:bg-gray-800 text-white text-center py-6 shadow">
    <h1 class="text-3xl font-bold">Detail Artikel</h1>
  </header>

  <main class="max-w-3xl mx-auto p-6">
    <!-- Tombol dark mode -->
    <div class="flex justify-end mb-4">
      <button onclick="toggleDarkMode()" class="bg-gray-200 dark:bg-gray-700 px-3 py-1 rounded text-sm">🌓 Mode</button>
    </div>

    <!-- Artikel -->
    <article class="mb-8">
      <h2 class="text-2xl font-bold mb-2"><?php echo htmlspecialchars($artikel['nama_artikel']); ?></h2>
      <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Kategori: <?php echo htmlspecialchars($artikel['kategori']); ?></p>
      <p><?php echo nl2br(htmlspecialchars($artikel['isi_artikel'])); ?></p>
    </article>

    <!-- Komentar -->
    <section>
      <h3 class="text-xl font-semibold mb-2">Komentar</h3>

      <?php
      $komentar = mysqli_query($db, "SELECT * FROM tbl_komentar WHERE id_artikel = '$id_artikel' ORDER BY tanggal ASC");
      while ($k = mysqli_fetch_array($komentar)) {
        echo "<div class='mb-4 border-b border-gray-300 dark:border-gray-700 pb-2'>";
        echo "<p class='font-semibold'>" . htmlspecialchars($k['nama_pengunjung']) . "</p>";
        echo "<p class='text-sm'>" . htmlspecialchars($k['isi_komentar']) . "</p>";
        echo "<p class='text-xs text-gray-500 dark:text-gray-400'>" . $k['tanggal'] . "</p>";
        echo "</div>";
      }
      ?>
    </section>

    <!-- Form Komentar -->
    <section class="mt-8">
      <h3 class="text-xl font-semibold mb-2">Tulis Komentar</h3>
      <form action="" method="POST" class="space-y-4">
        <input type="text" name="nama" placeholder="Nama Anda" required class="w-full px-3 py-2 rounded bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600">
        <textarea name="komentar" placeholder="Tulis komentar..." required class="w-full px-3 py-2 rounded bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600"></textarea>
        <button type="submit" name="kirim" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 dark:bg-gray-700 dark:hover:bg-gray-600">Kirim Komentar</button>
      </form>

      <?php
      if (isset($_POST['kirim'])) {
        $nama = $_POST['nama'];
        $isi_komentar = $_POST['komentar'];
        $tanggal = date('Y-m-d H:i:s');

        mysqli_query($db, "INSERT INTO tbl_komentar (id_artikel, nama_pengunjung, isi_komentar, tanggal)
                          VALUES ('$id_artikel', '$nama', '$isi_komentar', '$tanggal')");

        echo "<script>window.location = 'artikel.php?id_artikel=$id_artikel';</script>";
      }
      ?>
    </section>
  </main>

  <!-- Footer -->
  <footer class="bg-red-800 dark:bg-gray-900 text-white text-center py-4 mt-10">
    &copy; <?php echo date('Y'); ?> | Created by SyivaAyuu
  </footer>

  <!-- Script Dark Mode -->
  <script>
    if (localStorage.getItem('theme') === 'dark') {
      document.documentElement.classList.add('dark');
    }

    function toggleDarkMode() {
      document.documentElement.classList.toggle('dark');
      localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
    }
  </script>
</body>
</html>

