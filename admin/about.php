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
  <title>Kelola About</title> 
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
    <h1 class="text-3xl font-bold">Kelola Halaman About</h1> 
  </header> 

  <div class="flex max-w-7xl mx-auto mt-8 px-4"> 

    <!-- Sidebar --> 
    <aside class="w-1/4 bg-white dark:bg-gray-800 dark:text-white rounded shadow p-4"> 
      <h2 class="text-xl font-semibold dark:bg-gray-800 bg-white mb-4 text-center">MENU</h2> 
      <ul class="space-y-2 text-gray-700 dark:text-gray-200"> 
        <li><a href="beranda_admin.php" class="block hover:text-red-600">Beranda</a></li> 
        <li><a href="data_artikel.php" class="block hover:text-red-600">Kelola Artikel</a></li> 
        <li><a href="data_gallery.php" class="block hover:text-red-600">Kelola Gallery</a></li> 
        <li><a href="komentar.php" class="block hover:text-red-600">Kelola Komentar</a></li>
        <li><a href="about.php" class="block  hover:text-red-600 dark:text-white-400">About</a></li>
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
        <h2 class="text-xl font-bold text-gray-800 dark:text-white">Tentang Saya</h2> 
        <a href="add_about.php" 
           class="px-4 py-2 rounded transition text-white 
            bg-red-600 hover:bg-red-700 
            dark:bg-gray-600 dark:hover:bg-gray-700">+ Tambah Artikel</a>
  </div>     

      <div class="space-y-4"> 
        <?php 
        $sql = "SELECT * FROM tbl_about ORDER BY id_about DESC"; 
        $query = mysqli_query($db, $sql); 
        while ($data = mysqli_fetch_array($query)) { 
          echo "<div class='p-4 bg-gray-50 dark:bg-gray-700 border dark:border-gray-600 rounded shadow'>"; 
          echo "<p class='mb-3 text-gray-800 dark:text-gray-200'>" . htmlspecialchars($data['about']) . "</p>"; 
          echo "<div class='flex space-x-4 text-sm'>";
          echo "<a href='edit_about.php?id_about={$data['id_about']}' class='text-blue-600 hover:underline'>Edit</a>";  
          echo "<a href='delete_about.php?id_about={$data['id_about']}' onclick='return confirm(\"Yakin ingin menghapus?\")' class='text-red-600 hover:underline'>Hapus</a>"; 
          echo "</div></div>"; 
        } 
        ?> 
      </div> 
    </main> 
  </div> 

  <!-- Footer --> 
  <footer class="bg-red-800 dark:bg-gray-900 text-white text-center py-4 mt-10"> 
    &copy; <?php echo date('Y'); ?> | Created by SyivaAyu 
  </footer> 

  <!-- Script Dark Mode -->
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
