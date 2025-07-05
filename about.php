<?php include "koneksi.php"; ?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <meta charset="UTF-8"> 
  <title>About | Personal Web</title> 
  <script src="https://cdn.tailwindcss.com"></script> 
  <script>
  tailwind.config = {
    darkMode: 'class'
  }
</script>
</head> 
<body class="bg-gray-100 text-gray-800 font-sans dark:bg-gray-900 dark:text-gray-100">
 <body class="bg-gray-100 text-gray-800 font-sans dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300">

  <!-- Header --> 
  <header class="bg-red-900 dark:bg-gray-900 text-white text-center p-6 text-2xl font-bold">
    About Me | SyivaAyuu
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
 
  <!-- About Content --> 
 <main class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 dark:text-white rounded shadow mt-8">
  <h2 class='text-xl font-bold mb-4 text-gray-700 dark:text-white'>Tentang Saya</h2>
    <div class="space-y-6"> 
      <?php 
      $sql = "SELECT * FROM tbl_about ORDER BY id_about DESC"; 
      $query = mysqli_query($db, $sql); 
      while ($data = mysqli_fetch_array($query)) { 
        echo "<div>"; 
       echo "<p class='text-gray-700 dark:text-gray-300'>" . htmlspecialchars($data['about']) . "</p>";
        echo "</div>"; 
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
