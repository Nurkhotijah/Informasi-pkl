<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'default title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/logo absensipkl.png') }}" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.1/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.min.js"></script>
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
                <!-- Dashboard -->
                <li class="p-3 {{ request()->is('pages-industri/dashboard-industri') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
                  <img width="25" height="25" src="https://img.icons8.com/material-outlined/25/FFFFFF/home--v2.png" alt="home--v2" />
                  <a href="{{ route('industri.dashboard') }}" class="text-sm">Dashboard</a>
                </li>
                
                <!-- Kelola Kehadiran -->
                <li class="p-3 {{ request()->is('kelola-kehadiran') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
                  <img width="25" height="25" src="https://img.icons8.com/ios/25/FFFFFF/attendance-mark.png" alt="attendance-mark" />
                  <a href="{{ route('kelola-kehadiran') }}" class="text-sm">Kelola Kehadiran</a>
                </li>
                
                <!-- Jurnal Siswa -->
                <li class="p-3 {{ request()->is('jurnal-industri') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
                  <img width="25" height="25" src="https://img.icons8.com/ios/25/FFFFFF/book--v1.png" alt="book--v1" />
                  <a href="{{ route('jurnal-industri.index') }}" class="text-sm">Jurnal Siswa</a>
                </li>
                
                <!-- Penilaian Siswa -->
                <li class="p-3 {{ request()->is('penilaian') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
                  <img width="25" height="25" src="https://img.icons8.com/ios/25/FFFFFF/test-results.png" alt="test-results" />
                  <a href="{{ route('penilaian.index') }}" class="text-sm">Penilaian Siswa</a>
                </li>
                
                <!-- Data Sekolah -->
                <li class="p-3 {{ request()->is('sekolah') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
                  <img width="25" height="25" src="https://img.icons8.com/ios/25/FFFFFF/school.png" alt="school" />
                  <a href="{{ route('sekolah.index') }}" class="text-sm">Data Sekolah</a>
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
                                    <a class="flex items-center space-x-2" href="{{ route('profile-industri') }}">
                                        <img alt="test-account" height="30"
                                            src="https://img.icons8.com/fluency-systems-filled/50/000000/test-account.png"
                                            width="30" />
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li class="block px-4 py-2 hover:bg-gray-100 cursor-pointer transition">
                                    <form method="POST" action="{{ route('logout-industri') }}">
                                        @csrf
                                        <button type="submit" class="flex items-center space-x-2 w-full text-left">
                                            <img alt="logout-rounded-left" height="30" 
                                                 src="https://img.icons8.com/ios-filled/50/000000/logout-rounded-left.png" width="30" />
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>


    <div class="flex-1 p-6 overflow-auto bg-gray-100">
        @yield('content')
    </div>
   </div>

<script>

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