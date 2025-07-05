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
  <title>Kelola Artikel</title> 
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
    <h1 class="text-3xl font-bold">// HALAMAN ADMIN //</h1> 
  </header> 

  <div class="flex max-w-7xl mx-auto mt-8 px-4"> 

    <!-- Sidebar --> 
    <aside class="w-1/4 bg-white dark:bg-gray-800 dark:text-white rounded shadow p-4"> 
      <h2 class="text-xl font-semibold mb-4 text-center dark:bg-gray-800 dark:text-white">MENU</h2> 
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
  <div class="flex justify-between items-center mb-4"> 
  <h2 class="text-xl font-bold">Daftar Artikel</h2> 
  <a href="add_artikel.php" 
     class="px-4 py-2 rounded transition text-white 
            bg-red-600 hover:bg-red-700 
            dark:bg-gray-700 dark:hover:bg-gray-700">+ Tambah Artikel</a> 
</div> 

<div class="overflow-auto rounded">
  <table class="min-w-full table-auto border border-gray-300 dark:border-gray-600 text-sm "> 
    <thead class="bg-red-600 text-white dark:bg-gray-700 dark:text-white">
  <tr> 
    <th class="p-3 border dark:border-gray-700">No</th> 
    <th class="p-3 border dark:border-gray-700">Nama Artikel</th> 
    <th class="p-3 border dark:border-gray-700">Kategori</th>
    <th class="p-3 border dark:border-gray-700">Isi Artikel</th> 
    <th class="p-3 border dark:border-gray-700">Aksi</th> 
  </tr> 
</thead>



          <tbody>
            <?php 
            $sql = "SELECT * FROM tbl_artikel"; 
            $query = mysqli_query($db, $sql); 
            $no = 1; 
            while ($data = mysqli_fetch_array($query)) { 
              echo "<tr class='even:bg-gray-50 dark:even:bg-gray-700'>"; 
              echo "<td class='border p-2 text-center dark:border-gray-600'>" . $no++ . "</td>"; 
              echo "<td class='border p-2 dark:border-gray-600'>" . htmlspecialchars($data['nama_artikel']) . "</td>"; 
              echo "<td class='border p-2 dark:border-gray-600'>" . htmlspecialchars($data['kategori']) . "</td>";
              echo "<td class='border p-2 dark:border-gray-600'>" . htmlspecialchars($data['isi_artikel']) . "</td>"; 
              echo "<td class='border p-2 text-center space-x-2 dark:border-gray-600'>
                      <a href='edit_artikel.php?id_artikel={$data['id_artikel']}' class='text-blue-600 hover:underline'>Edit</a>   
                      <a href='delete_artikel.php?id_artikel={$data['id_artikel']}' onclick='return confirm(\"Yakin ingin menghapus?\")' class='text-red-600 hover:underline'>Hapus</a> 
                    </td>"; 
              echo "</tr>"; 
            } 
            ?> 
          </tbody> 
        </table> 
      </div>
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
