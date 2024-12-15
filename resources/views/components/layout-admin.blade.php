<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'default title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/logo absensipkl.png') }}" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.1/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div id="sidebar"
            class="fixed inset-0 w-64 md:w-1/6 bg-gray-800 text-white flex flex-col shadow-lg z-30 transition-transform transform md:relative md:block md:translate-x-0 -translate-x-full">
            <button id="closeSidebarBtn" class="absolute top-3 right-3 text-white text-lg focus:outline-none md:hidden">
                <i class="fas fa-times"></i>
            </button>
            <div class="flex items-center justify-center p-3 text-lg font-bold border-b border-gray-700">
                <img alt="profile" class="rounded-full w-12 h-12 mr-4" src="{{ asset('assets/SI-PKL.png') }}">
                <span>SI-PKL</span>
            </div>
            <div class="mt-4 flex-grow">
                <ul>
                    <li
                        class="p-3 {{ request()->is('pages-admin/dashboard-admin') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
                        <img width="30" height="30"
                            src="https://img.icons8.com/material-outlined/24/FFFFFF/home--v2.png" alt="home--v2" />
                        <a href="{{ route('admin.dashboard') }}" class="text-sm">Dashboard</a>
                    </li>
                    <li
                        class="p-3 {{ request()->is('kehadiran-siswapkl') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
                        <img width="30" height="30"
                            src="https://img.icons8.com/ios/50/FFFFFF/attendance-mark.png" alt="attendance-mark" />
                        <a href="{{ route('kehadiran-siswapkl') }}" class="text-sm">Kehadiran Siswa</a>
                    </li>
                    <li
                        class="p-3 {{ request()->is('pkl') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
                        <img width="30" height="30"
                            src="https://img.icons8.com/ios/50/FFFFFF/submit-document.png" alt="submit-document" />
                        <a href="{{ route('pkl.index') }}" class="text-sm">Pengajuan PKL</a>
                    </li>
                    <li
                        class="p-3 {{ request()->is('data-siswa') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
                        <img width="30" height="30" src="https://img.icons8.com/ios/50/FFFFFF/book--v1.png"
                            alt="book--v1" />
                        <a href="{{ route('data-siswa') }}" class="text-sm">Data Siswa</a>
                    </li>
                    <li
                        class="p-3 {{ request()->is('jurnal-admin') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
                        <img width="30" height="30" src="https://img.icons8.com/ios/50/FFFFFF/book--v1.png"
                            alt="book--v1" />
                        <a href="{{ route('jurnal-admin.index') }}" class="text-sm">Jurnal Siswa</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-auto">
            <nav
                class="bg-white p-4 text-white flex items-center justify-between border-b border-white shadow-lg sticky top-0 z-10 w-full">
                <div class="flex items-center space-x-4">
                    <!-- Mobile Sidebar Toggle -->
                    <button id="openSidebarBtn" class="md:hidden text-gray-800">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="flex items-center space-x-6 ml-auto">
                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <button id="profileButton" class="focus:outline-none flex items-center space-x-2">
                            <img src="{{ Auth::check() && Auth::user()->foto_profile ? asset('storage/' . Auth::user()->foto_profile) : asset('assets/default-profile.png') }}" alt="profile" class="w-auto h-8" />
                        </button>

                        <!-- Profile Dropdown -->
                        <div id="profileDropdown"
                            class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-lg hidden transition-all ease-in-out duration-150">
                            <ul class="py-1 text-gray-700">
                                <li class="block px-4 py-2 hover:bg-gray-100 cursor-pointer transition">
                                    <a class="flex items-center space-x-2" href="{{ route('profile-admin') }}">
                                        <img alt="test-account" height="30"
                                            src="https://img.icons8.com/fluency-systems-filled/50/000000/test-account.png"
                                            width="30" />
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li id="logout" class="block px-4 py-2 hover:bg-gray-100 cursor-pointer transition">
                                    <a class="flex items-center space-x-2">
                                      <img alt="logout-rounded-left" height="30" src="https://img.icons8.com/ios-filled/50/000000/logout-rounded-left.png" width="30"/>
                                     <span>
                                      Logout
                                     </span>
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
                <button id="cancelLogout" class="bg-white text-green-500 border border-green-500 py-2 px-4 rounded-xl hover:bg-green-500 hover:text-white">Tidak</button>
                <button id="confirmLogout" class="bg-white border border-red-500 text-red-500 py-2 px-4 rounded-xl hover:bg-red-500 hover:text-white">Ya</button>
            </div>
        </div>
    </div>

    <div class="flex-1 p-6 overflow-auto bg-gray-100">
        @yield('content')
    </div>
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


        // Menampilkan dan menyembunyikan dropdown
        const profileButton = document.getElementById('profileButton');
        const profileDropdown = document.getElementById('profileDropdown');

        profileButton.addEventListener('click', () => {
            profileDropdown.classList.toggle('hidden');
        });

        // Sidebar toggle untuk mobile
        document.getElementById('openSidebarBtn').addEventListener('click', function () {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
        });

        document.getElementById('closeSidebarBtn').addEventListener('click', function () {
            document.getElementById('sidebar').classList.add('-translate-x-full');
        });
    </script>
</body>

</html>
