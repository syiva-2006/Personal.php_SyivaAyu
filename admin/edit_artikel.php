<?php 
include('../koneksi.php'); 
session_start(); 
if (!isset($_SESSION['username'])) { 
  header('location:login.php'); 
  exit; 
} 
$id = $_GET['id_artikel']; 
$sql = "SELECT * FROM tbl_artikel WHERE id_artikel = '$id'"; 
$query = mysqli_query($db, $sql); 
$data = mysqli_fetch_array($query); 
?> 

<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <meta charset="UTF-8"> 
  <title>Edit Artikel</title> 
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
    <h1 class="text-3xl font-bold">Edit Artikel</h1> 
  </header> 

  <div class="flex max-w-7xl mx-auto mt-8 px-4"> 

    <!-- Sidebar --> 
    <aside class="w-1/4 bg-white dark:bg-gray-800 dark:text-white rounded shadow p-4"> 
      <h2 class="text-xl font-semibold dark:bg-gray-800 dark:text-white mb-4 text-center">MENU</h2> 
      <ul class="space-y-2 text-gray-700 dark:text-gray-200"> 
        <li><a href="beranda_admin.php" class="block hover:text-red-600">Beranda</a></li> 
        <li><a href="data_artikel.php" class="block  hover:text-red-800 ">Kelola Artikel</a></li> 
        <li><a href="data_gallery.php" class="block hover:text-red-600">Kelola Gallery</a></li> 
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
      <form action="proses_edit_artikel.php" method="post" class="space-y-6"> 
        <input type="hidden" name="id_artikel" value="<?php echo $data['id_artikel']; ?>"> 

        <!-- Judul Artikel -->
        <div> 
          <label for="nama_artikel" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Judul Artikel</label> 
          <input type="text" id="nama_artikel" name="nama_artikel" required 
            value="<?php echo htmlspecialchars($data['nama_artikel']); ?>" 
            class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring focus:border-red-500"> 
        </div> 

        <!-- Isi Artikel -->
        <div> 
          <label for="isi_artikel" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Isi Artikel</label> 
          <textarea id="isi_artikel" name="isi_artikel" rows="5" required 
            class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring focus:border-red-500"><?php echo htmlspecialchars($data['isi_artikel']); ?></textarea> 
        </div> 

        <!-- Tombol Aksi -->
        <div class="flex justify-end space-x-4"> 
          <button type="submit" 
            class="bg-red-700 text-white px-4 py-2 rounded hover:bg-red-800 transition">Update</button> 
          <a href="data_artikel.php" 
            class="bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-white px-4 py-2 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition">Batal</a> 
        </div> 
      </form> 
    </main> 
  </div> 

  <!-- Footer --> 
  <footer class="bg-red-800 dark:bg-gray-900 text-white text-center py-4 mt-10"> 
    &copy; <?php echo date('Y'); ?> | Created by SyivaAyuu
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
