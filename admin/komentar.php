<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
  header('location:login.php');
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Kelola Komentar</title>
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
    <h1 class="text-3xl font-bold">Komentar Pengunjung</h1>
  </header>

  <!-- Main Content -->
  <div class="max-w-6xl mx-auto p-6">
    <div class="flex justify-end mb-4">
      <button onclick="toggleDarkMode()" class="bg-gray-200 dark:bg-gray-700 text-sm px-4 py-2 rounded hover:bg-gray-300 dark:hover:bg-gray-600 transition">🌓 Mode</button>
    </div>

    <table class="min-w-full table-auto border border-gray-300 dark:border-gray-600 text-sm rounded overflow-hidden">
      <thead class="bg-red-600 text-white dark:bg-gray-800 ">
  <tr>
    <th class="p-3 border dark:border-gray-600">Nama</th>
    <th class="p-3 border dark:border-gray-600">Komentar</th>
    <th class="p-3 border dark:border-gray-600">Tanggal</th>
    <th class="p-3 border dark:border-gray-600">Aksi</th>
  </tr>
</thead>


      <tbody>
        <?php
        $sql = "SELECT * FROM tbl_komentar ORDER BY id_komentar DESC";
        $query = mysqli_query($db, $sql);
        while ($data = mysqli_fetch_array($query)) {
          echo "<tr class='even:bg-gray-50 dark:even:bg-gray-800'>";
          echo "<td class='border p-2 dark:border-gray-600'>" . htmlspecialchars($data['nama_pengunjung']) . "</td>";
          echo "<td class='border p-2 dark:border-gray-600'>" . htmlspecialchars($data['isi_komentar']) . "</td>";
          echo "<td class='border p-2 dark:border-gray-600'>" . $data['tanggal'] . "</td>";
          echo "<td class='border p-2 text-center dark:border-gray-600'>
                  <a href='hapus_komentar.php?id=$data[id_komentar]' onclick='return confirm(\"Hapus komentar?\")' class='text-red-600 hover:underline'>Hapus</a>
                </td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Footer -->
  <footer class="bg-red-800 dark:bg-gray-900 text-white text-center py-4 mt-10">
    &copy; <?php echo date('Y'); ?> | Created by SyivaAyuu
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
