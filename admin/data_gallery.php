<?php 
include('../koneksi.php'); 
session_start(); 
if (!isset($_SESSION['username'])) { 
  header('location:login.php'); 
  exit; 
} 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <meta charset="UTF-8"> 
  <title>Kelola Gallery</title> 
  <script src="https://cdn.tailwindcss.com"></script> 
  <script>
    tailwind.config = {
      darkMode: 'class'
    }
  </script>
</head> 
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen transition-colors duration-300"> 

  <!-- Header --> 
  <header class="bg-red-900 dark:bg-gray-800 text-white text-center py-6 shadow"> 
    <h1 class="text-3xl font-bold">Kelola Gallery</h1> 
  </header> 

  <div class="flex max-w-7xl mx-auto mt-8 px-4">

    <!-- Sidebar --> 
    <aside class="w-1/4 bg-white dark:bg-gray-800 dark:text-white rounded shadow p-4"> 
      <h2 class="text-xl font-semibold dark:bg-gray-800 dark:text-white mb-4 text-center">MENU</h2> 
      <ul class="space-y-2 text-gray-700 dark:text-gray-200"> 
        <li><a href="beranda_admin.php" class="block hover:text-red-600">Beranda</a></li> 
        <li><a href="data_artikel.php" class="block hover:text-red-600">Kelola Artikel</a></li> 
        <li><a href="data_gallery.php" class="block  hover:text-red-800 ">Kelola Gallery</a></li> 
         <li><a href="komentar.php" class="block hover:text-red-600">Kelola Komentar</a></li>
        <li><a href="about.php" class="block hover:text-red-600">About</a></li> 
        <li>
          <a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');" 
             class="block text-red-600 hover:underline font-medium">Logout</a> 
        </li>
        <li><button onclick="toggleDarkMode()" class="hover:underline">🌓 Mode</button></li>
      </ul> 
    </aside> 

    <!-- Main Content --> 
    <main class="w-3/4 bg-white dark:bg-gray-800 dark:text-white rounded shadow p-6 ml-6"> 
      <div class="flex justify-between items-center mb-4"> 
        <h2 class="text-xl font-bold">Daftar Gallery</h2> 
        <a href="add_gallery.php" 
            class="px-4 py-2 rounded transition text-white 
            bg-red-600 hover:bg-red-700 
            dark:bg-gray-600 dark:hover:bg-gray-700">+ Tambah Gallery</a>
  </div>     

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6"> 
        <?php 
        $sql = "SELECT * FROM tbl_gallery"; 
        $query = mysqli_query($db, $sql); 
        while ($data = mysqli_fetch_array($query)) { 
          echo "<div class='bg-gray-50 dark:bg-gray-700 border dark:border-gray-600 rounded shadow overflow-hidden'>"; 
          echo "<img src='../images/{$data['foto']}' class='w-full h-48 object-cover'>"; 
          echo "<div class='p-4'>"; 
          echo "<p class='font-semibold text-gray-800 dark:text-white mb-2'>" . htmlspecialchars($data['judul']) . "</p>"; 
          echo "<div class='flex justify-between text-sm'>"; 
          echo "<a href='edit_gallery.php?id_gallery={$data['id_gallery']}' class='text-blue-600 hover:underline'>Edit</a>"; 
          echo "<a href='delete_gallery.php?id_gallery={$data['id_gallery']}' onclick='return confirm(\"Yakin ingin menghapus?\")' class='text-red-600 hover:underline'>Hapus</a>"; 
          echo "</div></div></div>"; 
        } 
        ?> 
      </div> 
    </main> 
  </div> 

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
