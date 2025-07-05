<?php include "koneksi.php"; ?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <meta charset="UTF-8"> 
  <title>Personal Web | Home</title> 
  <script src="https://cdn.tailwindcss.com"></script> 
  <script>
    tailwind.config = {
      darkMode: 'class'
    }
  </script>
</head> 
<body class="bg-gray-100 text-gray-800 font-sans dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300"> 
 
  <!-- Header --> 
  <header class="bg-red-900 dark:bg-gray-800 text-white text-center p-6 text-2xl font-bold"> 
    Personal Web | SyivaAyu 
  </header> 
 
  <!-- Navigation --> 
  <nav class="bg-red-700 dark:bg-gray-700 text-white dark:text-gray-100 py-3"> 
    <ul class="flex justify-center space-x-10 font-medium text-lg"> 
      <li><a href="index.php" class="hover:underline">Artikel</a></li> 
      <li><a href="gallery.php" class="hover:underline">Gallery</a></li> 
      <li><a href="about.php" class="hover:underline">About</a></li> 
      <li><a href="admin/login.php" class="hover:underline">Login</a></li> 
      <li><button onclick="toggleDarkMode()" class="hover:underline">🌓 Mode</button></li>
    </ul> 
  </nav> 
 
  <!-- Form Pencarian -->
<form method="GET" class="max-w-2xl mx-auto mt-4 px-4 ">
  <input type="text" name="keyword" placeholder="Cari artikel..."
    class="w-full p-2 border border-gray-300 rounded shadow focus:outline-none focus:ring focus:border-blue-500">
</form>

  <!-- Main Content --> 
  <main class="max-w-6xl mx-auto p-6 grid grid-cols-1 md:grid-cols-3 gap-6 mt-6"> 
 
    <!-- Artikel Utama --> 
    <section class="md:col-span-2 bg-white dark:bg-gray-800 dark:text-white p-6 rounded shadow"> 
      <h2 class="text-xl font-bold mb-4">Artikel Terbaru</h2> 
      <div class="space-y-6"> 
        <?php 
        $keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($db, $_GET['keyword']) : '';
$sql = "SELECT * FROM tbl_artikel";

if (!empty($keyword)) {
    $sql .= " WHERE nama_artikel LIKE '%$keyword%' OR isi_artikel LIKE '%$keyword%'";
}

$sql .= " ORDER BY id_artikel DESC";
        $query = mysqli_query($db, $sql); 
        $data = mysqli_fetch_array($query);
        ?>
        <div class="border-b border-gray-300 dark:border-gray-600 pb-4"> 
          <h3 class="text-lg font-semibold text-red-700 dark:text-red-400">
            <?= htmlspecialchars($data['nama_artikel']) ?>
          </h3> 
          <p class="mt-2"><?= nl2br(htmlspecialchars($data['isi_artikel'])) ?></p> 
        </div>


        <!-- Form Komentar -->
        <h3 class="text-md font-semibold mt-6">Tinggalkan Komentar:</h3>
        <form action="simpan_komentar.php" method="post" class="space-y-2 mt-2">
          <input type="hidden" name="id_artikel" value="<?= $data['id_artikel']; ?>">
          <input type="text" name="nama" placeholder="Nama Anda" required 
            class="w-full p-2 border rounded bg-white dark:bg-gray-700 text-black dark:text-white">
          <textarea name="komentar" rows="3" placeholder="Komentar Anda" required 
            class="w-full p-2 border rounded bg-white dark:bg-gray-700 text-black dark:text-white"></textarea>
          <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Kirim</button>
        </form>

        <!-- Komentar -->
        <?php
        $id_artikel = $data['id_artikel'];
        $kom = mysqli_query($db, "SELECT * FROM tbl_komentar WHERE id_artikel='$id_artikel' ORDER BY tanggal DESC");
        while ($komen = mysqli_fetch_array($kom)) {
          echo "<div class='border-t border-gray-300 dark:border-gray-600 pt-2 mt-2'>";
          echo "<strong>" . htmlspecialchars($komen['nama_pengunjung']) . "</strong><br>";
          echo "<p class='text-sm text-gray-700 dark:text-gray-300'>" . htmlspecialchars($komen['isi_komentar']) . "</p>";
          echo "<p class='text-xs text-gray-500 dark:text-gray-400'>" . $komen['tanggal'] . "</p>";
          echo "</div>";
        }
        ?>
      </div>
    </section> 

    <!-- Sidebar --> 
    <aside class="bg-white dark:bg-gray-800 dark:text-white p-6 rounded shadow"> 
      <h2 class="text-lg font-bold mb-4">Daftar Artikel</h2> 
      <ul class="space-y-2 list-disc list-inside text-gray-700 dark:text-gray-300"> 
        <?php 
        $sql = "SELECT * FROM tbl_artikel ORDER BY id_artikel DESC"; 
        $query = mysqli_query($db, $sql); 
        while ($artikel = mysqli_fetch_array($query)) { 
          echo "<li>" . htmlspecialchars($artikel['nama_artikel']) . "</li>"; 
        } 
        ?> 
      </ul> 
    </aside> 
  </main> 
 
  <!-- Footer --> 
  <footer class="bg-red-800 dark:bg-gray-900 text-white text-center py-4 mt-10"> 
    &copy; <?php echo date('Y'); ?> | Created by SyivaAyu
  </footer> 

  <!-- Dark Mode Script -->
  <script>
    if (localStorage.getItem('theme') === 'dark') {
      document.documentElement.classList.add('dark');
    }

    function toggleDarkMode() {
      document.documentElement.classList.toggle('dark');
      if (document.documentElement.classList.contains('dark')) {
        localStorage.setItem('theme', 'dark');
      } else {
        localStorage.setItem('theme', 'light');
      }
    }
  </script>

</body> 
</html>


