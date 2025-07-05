<?php 
session_start(); 
if (isset($_SESSION['username'])) { 
  header('location:beranda_admin.php'); 
} 
require_once("../koneksi.php"); 
?> 

<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <meta charset="UTF-8"> 
  <title>Login Administrator</title> 
  <script src="https://cdn.tailwindcss.com"></script> 
  <script>
    tailwind.config = {
      darkMode: 'class'
    }
  </script>
</head> 

<body class="bg-gradient-to-br from-red-100 to-blue-300 dark:from-gray-900 dark:to-gray-800 min-h-screen flex items-center justify-center transition-colors duration-300"> 

  <div class="bg-white dark:bg-gray-800 dark:text-white shadow-lg rounded-lg p-8 w-full max-w-md relative"> 
    
    <!-- Tombol Dark Mode Pojok Kanan -->
    <button onclick="toggleDarkMode()" title="Ganti Mode" 
      class="absolute top-4 right-4 text-gray-600 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 text-xl">
      🌓
    </button>

    <h2 class="text-2xl font-bold text-center mb-6">Login Administrator</h2> 
    
    <form action="cek_login.php" method="post" class="space-y-5"> 
      <div>
        <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Username</label> 
        <input type="text" name="username" id="username" required 
          class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500"> 
      </div> 
      
      <div> 
        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label> 
        <input type="password" name="password" id="password" required 
          class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500"> 
      </div> 
      
      <div class="flex justify-between items-center"> 
        <input type="submit" name="login" value="Login" 
          class="bg-red-700 text-white px-4 py-2 rounded hover:bg-red-800 cursor-pointer"> 
        <input type="reset" name="cancel" value="Cancel" 
          class="bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-white px-4 py-2 rounded hover:bg-gray-400 dark:hover:bg-gray-500 cursor-pointer"> 
      </div> 
    </form> 
    
    <div class="text-center text-sm text-gray-600 dark:text-gray-400 mt-6"> 
      &copy; <?php echo date('Y'); ?> - SyivaAyuu
    </div> 
  </div> 

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
