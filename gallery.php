<?php include "koneksi.php"; ?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <meta charset="UTF-8"> 
  <title>Gallery | Personal Web</title> 
  <script src="https://cdn.tailwindcss.com"></script>
   <script>
  tailwind.config = {
    darkMode: 'class'
  }
</script>
</head> 
<body class="bg-gray-100 text-gray-800 font-sans dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300">

  <!-- Header --> 
  <header class="bg-red-900 dark:bg-gray-900 text-white text-center p-6 text-2xl font-bold"> 
    Gallery | SyivaAyuu 
  </header> 

  <!-- Navigation --> 
  <nav class="bg-red-700 text-white py-3 dark:bg-gray-800 dark:text-gray-100">
    <ul class="flex justify-center space-x-10 font-medium text-lg"> 
      <li><a href="index.php" class="hover:underline">Artikel</a></li> 
      <li><a href="gallery.php" class="hover:underline">Gallery</a></li> 
      <li><a href="about.php" class="hover:underline">About</a></li> 
      <li><a href="admin/login.php" class="hover:underline">Login</a></li> 
      <li><button onclick="toggleDarkMode()" class="hover:underline">🌓 Mode</button></li> <!-- Tambah di sini -->
    </ul> 
  </nav> 

  <!-- Form Pencarian -->
  <form method="GET" class="max-w-2xl mx-auto mt-4 px-4">
  <input type="text" name="cari" placeholder="Cari judul gambar..."
    class="w-full p-2 border border-gray-300 rounded shadow focus:outline-none focus:ring focus:border-blue-500">
</form>

  <!-- Gallery Grid --> 
  <main class="max-w-6xl mx-auto p-6"> 
    <h2 class="text-xl font-bold mb-6 text-center">Galeri Foto</h2> 
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6"> 
      <?php 
      $cari = isset($_GET['cari']) ? mysqli_real_escape_string($db, $_GET['cari']) : '';
$sql = "SELECT * FROM tbl_gallery";

if (!empty($cari)) {
    $sql .= " WHERE judul LIKE '%$cari%'";
}

$sql .= " ORDER BY id_gallery DESC";
      $query = mysqli_query($db, $sql); 
      while ($data = mysqli_fetch_array($query)) { 
        echo "<div class='bg-white dark:bg-gray-800 border dark:border-gray-600 rounded shadow overflow-hidden'>";
        echo "<img src='images/{$data['foto']}' class='w-full h-48 object
cover' alt='Gambar'>"; 
        echo "<div class='p-4'>"; 
        echo "<h3 class='text-lg font-semibold text-blue-700 dark:text-blue-400'>";
htmlspecialchars($data['judul']) . "</h3>"; 
        echo "</div></div>"; 
      } 
      ?> 
    </div> 
  </main> 

  <!-- Footer --> 
  <footer class="bg-red-800 dark:bg-gray-900 text-white text-center py-4 mt-10">
    &copy; <?php echo date('Y'); ?> | Created by SyivaAyuu
  </footer> 

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
