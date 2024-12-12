<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'default title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('assets/logo absensipkl.png') }}" type="image/x-icon"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.1/css/boxicons.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
  html, body {
      overflow-y: auto; /* Halaman tetap dapat discroll */
      scrollbar-width: none; /* Hilangkan scrollbar di Firefox */
  }

  body::-webkit-scrollbar {
      display: none; /* Hilangkan scrollbar di Chrome, Safari, Edge */
  }
</style>

<body class="bg-gray-100">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <div id="sidebar" class="fixed inset-0 w-64 md:w-1/6 bg-gray-800 text-white flex flex-col shadow-lg z-30 transition-transform transform md:relative md:block md:translate-x-0 -translate-x-full">
<!-- Tombol untuk menutup sidebar (X) -->
<button id="closeSidebarBtn" class="absolute top-3 right-3 text-white text-lg focus:outline-none md:hidden">
  <i class="fas fa-times"></i>
</button>

<div class="flex items-center justify-center p-4 bg-gray-800 text-lg font-bold text-white border-b border-gray-700">
  <div class="relative flex items-center justify-center  rounded-full ">
    <div class="flex items-center justify-center  bg-white rounded-full border-2 border-gray-200 shadow-md">
      <img src="{{ asset('assets/si-pkl.png') }}" alt="profile" class="rounded-full w-10 h-10">
    </div>
  </div>
  <span class="ml-4 text-xl tracking-wide">SI-PKL</span>
</div>
      <div class="mt-4 flex-grow">
        <ul>
          <li class="p-3 {{ request()->is('pages-industri/dashboard-industri') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
            <img width="25" height="25" src="https://img.icons8.com/material-outlined/25/FFFFFF/home--v2.png" alt="home--v2" />
            <a href="{{ route('industri.dashboard') }}" class="text-sm">Dashboard</a>
          </li>
          <li class="p-3 {{ request()->is('kelola-kehadiran') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
            <img width="25" height="25" src="https://img.icons8.com/ios/25/FFFFFF/attendance-mark.png" alt="attendance-mark" />
            <a href="{{ route('kelola-kehadiran') }}" class="text-sm">Kelola Kehadiran</a>
          </li>
          <li class="p-3 {{ request()->is('jurnal-industri') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
            <img width="25" height="25" src="https://img.icons8.com/ios/25/FFFFFF/book--v1.png" alt="book--v1" />
            <a href="{{ route('jurnal-industri.index') }}" class="text-sm">Jurnal Siswa</a>
          </li>
          <li class="p-3 {{ request()->is('penilaian') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
            <img width="25" height="25" src="https://img.icons8.com/ios/25/FFFFFF/test-results.png" alt="test-results" />
            <a href="{{ route('penilaian.index') }}" class="text-sm">Penilaian Siswa</a>
        </li>        
          <li class="p-3 {{ request()->is('sekolah') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
            <img width="25" height="25" src="https://img.icons8.com/ios/25/FFFFFF/school.png" alt="school" />
            <a href="{{ route('sekolah.index') }}" class="text-sm">Data Sekolah</a>
          </li>
         
        </ul>        
      </div>
    </div>

    <!-- Konten Utama -->
    <div class="flex-1 flex flex-col overflow-auto"> 
      <nav class="bg-white p-4 text-gray-800 flex items-center justify-between border-b border-white shadow-lg sticky top-0 z-10 w-full">
          <div class="flex items-center space-x-4">
              <!-- Mobile Sidebar Toggle -->
              <button id="openSidebarBtn" class="md:hidden text-gray-800">
                  <i class="fas fa-bars"></i>
              </button>
          </div>
  
          <div class="flex items-center space-x-6 ml-auto">
              <!-- Profile Dropdown -->
              <div class="relative">
                  <button class="focus:outline-none flex items-center space-x-2" id="profileButton">
                      <img src="{{ Auth::user()->foto_profile ? asset('storage/' . Auth::user()->foto_profile) : asset('assets/default-profile.png') }}" alt="profile" class="w-auto h-8 cursor-pointer transition duration-150 ease-in-out hover:border-gray-800"/>
                  </button>
  
                  <!-- Profile Dropdown Menu -->
                  <div class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-lg hidden transition-all ease-in-out duration-150" id="profileDropdown">
                      <ul class="py-1 text-gray-700">
                          <li class="block px-4 py-2 hover:bg-gray-100 cursor-pointer transition">
                              <a class="flex items-center space-x-2" href="{{ route('profile-industri') }}">
                                  <img alt="test-account" height="30" src="https://img.icons8.com/fluency-systems-filled/50/000000/test-account.png" width="30"/>
                                  <span>Profile</span>
                              </a>
                          </li>
                          <li id="logout" class="block px-4 py-2 hover:bg-gray-100 cursor-pointer transition">
                              <a class="flex items-center space-x-2" href="#" onclick="showLogoutConfirmation()">
                                  <img alt="logout-rounded-left" height="30" src="https://img.icons8.com/ios-filled/50/000000/logout-rounded-left.png" width="30"/>
                                  <span>Logout</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </nav>
  
      <!-- Popup Logout Confirmation -->
      <div id="confirmationLogout" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-800 bg-opacity-50 text-sm md:text-lg">
          <div class="bg-white py-6 px-12 rounded-lg shadow-lg">
              <p class="text-center text-gray-700">Yakin mau logout?</p>
              <div class="mt-4 flex justify-center gap-6">
                  <button id="cancelLogout" class="bg-white text-green-500 border border-green-500 py-2 px-4 rounded-xl hover:bg-green-500 hover:text-white" onclick="hideLogoutConfirmation()">Tidak</button>
                  <button id="confirmLogout" class="bg-white border border-red-500 text-red-500 py-2 px-4 rounded-xl hover:bg-red-500 hover:text-white" onclick="logout()">Ya</button>
              </div>
          </div>
      </div>
  
      <!-- Main Content -->
      <main class="flex-1 p-6 bg-gray-100">
          @yield('content')
      </main>
  </div>
  
  <script>

    // Menampilkan popup saat tombol logout diklik
  document.getElementById('logout').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('confirmationLogout').classList.remove('hidden');
    });

    // Mengonfirmasi logout dan redirect ke halaman lain
    document.getElementById('confirmLogout').addEventListener('click', function() {
        document.getElementById('confirmationLogout').classList.add('hidden');
        window.location.href = '/'; // Ganti '/' dengan URL halaman tujuan setelah logout
    });

    // Membatalkan logout dan menutup popup
    document.getElementById('cancelLogout').addEventListener('click', function() {
        document.getElementById('confirmationLogout').classList.add('hidden');
    });
    
     // Menampilkan dropdown profile
     document.getElementById('profileButton').addEventListener('click', function() {
        const dropdown = document.getElementById('profileDropdown');
        dropdown.classList.toggle('hidden');
    });

    // Menampilkan konfirmasi logout
    function showLogoutConfirmation() {
        document.getElementById('confirmationLogout').classList.remove('hidden');
    }

    // Menyembunyikan konfirmasi logout
    function hideLogoutConfirmation() {
        document.getElementById('confirmationLogout').classList.add('hidden');
    }

    // Aksi logout (misalnya redirect ke halaman logout)
    function logout() {
        window.location.href = "{{ route('logout') }}"; // Ganti dengan route logout Anda
    }
   // Sidebar toggle untuk mobile
const sidebar = document.getElementById('sidebar');
const hamburgerBtn = document.getElementById('hamburgerBtn');
const closeSidebarBtn = document.getElementById('closeSidebarBtn');

// Menampilkan sidebar ketika hamburger button diklik
hamburgerBtn.addEventListener('click', () => {
  sidebar.classList.toggle('translate-x-0');  // Menampilkan sidebar
  sidebar.classList.toggle('-translate-x-full'); // Menyembunyikan sidebar
});

// Menutup sidebar ketika tombol close sidebar diklik
closeSidebarBtn.addEventListener('click', () => {
  sidebar.classList.toggle('-translate-x-full'); // Toggle untuk menutup sidebar
  sidebar.classList.toggle('translate-x-0'); // Toggle untuk membuka sidebar
});
// Mendapatkan elemen tombol profil dan dropdown
const profileButton = document.getElementById('profileButton');
    const profileDropdown = document.getElementById('profileDropdown');

    // Menambahkan event listener untuk klik pada tombol profil
    profileButton.addEventListener('click', function () {
        // Toggle class 'hidden' untuk menampilkan atau menyembunyikan dropdown
        profileDropdown.classList.toggle('hidden');
    });

    // Menutup dropdown ketika area lain di luar tombol profil diklik
    window.addEventListener('click', function (e) {
        if (!profileButton.contains(e.target) && !profileDropdown.contains(e.target)) {
            profileDropdown.classList.add('hidden');
        }
    });
  
    // Logout confirmation logic
    const logoutButton = document.getElementById('logout-industri');
    const confirmationLogout = document.getElementById('confirmationLogout');
    const cancelLogout = document.getElementById('cancelLogout');
    const confirmLogout = document.getElementById('confirmLogout');
  
    logoutButton.addEventListener('click', (event) => {
      event.preventDefault();
      confirmationLogout.classList.remove('hidden');
    });
  
    cancelLogout.addEventListener('click', () => {
      confirmationLogout.classList.add('hidden');
    });
  
    confirmLogout.addEventListener('click', () => {
      window.location.href = "{{ route('logout') }}";
    });
  </script>
  
</body>

</html>