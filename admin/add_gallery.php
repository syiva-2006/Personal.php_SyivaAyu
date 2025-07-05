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
  <title>Tambah Gambar</title> 
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
    <h1 class="text-3xl font-bold">Tambah Gambar ke Gallery</h1> 
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
      <form action="proses_add_gallery.php" method="post" enctype="multipart/form-data" class="space-y-6"> 

        <!-- Judul Gambar -->
        <div> 
          <label for="judul" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Judul Gambar</label> 
          <input type="text" id="judul" name="judul" required 
            class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring focus:border-red-500"> 
        </div> 

        <!-- Upload File -->
        <div> 
          <label for="foto" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pilih Gambar</label> 
          <input type="file" id="foto" name="foto" accept="image/*" required 
            class="block w-full text-sm text-gray-600 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-100 dark:file:bg-gray-600 file:text-red-700 dark:file:text-white hover:file:bg-blue-200 dark:hover:file:bg-gray-500"> 
        </div> 

        <!-- Tombol Simpan / Batal -->
        <div class="flex justify-end space-x-4"> 
          <button type="submit" 
            class="bg-red-700 text-white px-4 py-2 rounded hover:bg-red-800 transition">Simpan</button> 
          <a href="data_gallery.php" 
            class="bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-white px-4 py-2 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition">Batal</a> 
        </div> 
      </form> 
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

