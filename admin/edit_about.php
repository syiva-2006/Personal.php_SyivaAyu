<?php 
include('../koneksi.php'); 
session_start(); 
if (!isset($_SESSION['username'])) { 
  header('location:login.php'); 
  exit; 
} 
$id = $_GET['id_about']; 
$sql = "SELECT * FROM tbl_about WHERE id_about = '$id'"; 
$query = mysqli_query($db, $sql); 
$data = mysqli_fetch_array($query); 
?> 

<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <meta charset="UTF-8"> 
  <title>Edit About</title> 
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
    <h1 class="text-3xl font-bold">Edit Data About</h1> 
  </header> 

  <div class="flex max-w-7xl mx-auto mt-8 px-4"> 

    <!-- Sidebar --> 
    <aside class="w-1/4 bg-white dark:bg-gray-800 rounded shadow p-4"> 
      <h2 class="text-xl font-semibold text-red-700 dark:text-white mb-4 text-center">MENU</h2> 
      <ul class="space-y-2 text-gray-700 dark:text-gray-300"> 
        <li><a href="beranda_admin.php" class="block hover:text-red-600">Beranda</a></li>
        <li><a href="data_artikel.php" class="block hover:text-red-600">Kelola Artikel</a></li> 
        <li><a href="data_gallery.php" class="block hover:text-red-600">Kelola Gallery</a></li> 
        <li><a href="komentar.php" class="block hover:text-red-600">Kelola Komentar</a></li>
        <li><a href="about.php" class="block  hover:text-red-800 ">About</a></li> 
        <li>
          <button onclick="toggleDarkMode()" class="hover:underline">🌓 Mode</button>
        </li>
        <li> 
          <a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');" 
             class="block text-red-600 hover:underline font-medium">Logout</a> 
        </li> 
      </ul> 
    </aside> 

    <!-- Main Content --> 
    <main class="w-3/4 bg-white dark:bg-gray-800 rounded shadow p-6 ml-6"> 
      <form action="proses_edit_about.php" method="post" class="space-y-6"> 
        <input type="hidden" name="id_about" value="<?php echo $data['id_about']; ?>"> 
        <div> 
          <label for="about" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">About</label> 
          <textarea id="about" name="about" rows="5" required 
            class="w-full p-2 border rounded bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring focus:border-blue-500"><?php echo htmlspecialchars($data['about']); ?></textarea> 
        </div> 
        <div class="flex justify-end space-x-4"> 
          <button type="submit" 
            class="bg-red-700 text-white px-4 py-2 rounded hover:bg-red-800 transition">Update</button> 
          <a href="about.php" 
            class="bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-white px-4 py-2 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition">Batal</a> 
        </div> 
      </form> 
    </main> 
  </div> 

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
      localStorage.setItem('theme',
        document.documentElement.classList.contains('dark') ? 'dark' : 'light');
    }
  </script>

</body> 
</html>

