<nav class="bg-white shadow-md">
  <div class="container mx-auto px-4 py-2 flex justify-between items-center">
    <!-- Logo dan Nama Sekolah -->
    <div class="flex items-center space-x-4">
      <button id="sidebarToggle" class="text-3xl bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600" onclick="toggleNav()">&#9776;</button>
      <a class="flex items-center space-x-2" href="#">
        <img src="" alt="Logo" class="w-8 h-8">
        <span class="font-semibold text-lg text-gray-700">SMK Negeri 1 Tambelangan</span>
      </a>
    </div>
    <div class="relative">
      <button class="flex items-center space-x-2 bg-blue-500 text-white px-4 py-2 rounded-full focus:outline-none hover:bg-blue-600" id="navbarDropdown">
        <span class="bi bi-person-circle"></span>
        <span><?php echo $_SESSION['nama']; ?></span>
      </button>
      <ul class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg hidden" id="dropdownMenu">
        <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="#">Profil</a></li>
        <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="#" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<script>
  document.getElementById('navbarDropdown').addEventListener('click', function() {
    document.getElementById('dropdownMenu').classList.toggle('hidden');
  });

  function toggleNav() {
    const sidebar = document.getElementById("mySidebar");
    if (sidebar.classList.contains("-translate-x-full")) {
      openNav();
    } else {
      closeNav();
    }
  }
</script>
