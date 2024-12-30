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
                    <li
                        class="p-3 {{ request()->is('pages-user/dashboard-user') ?  'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
                        <!-- Home Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hover:text-green-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12L11.204 3.045c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <a href="{{ route('user.dashboard') }}" class="text-sm">Dashboard</a>
                    </li>
                   <!-- Riwayat Kehadiran -->
                <li class="p-3 {{ request()->is('riwayat-absensi') ? 'bg-green-600' : 'hover:bg-gray-700 hover:shadow-lg transition-all duration-200 cursor-pointer' }} flex items-center space-x-2">
                    <a href="{{ route('riwayat-absensi') }}" class="flex items-center w-full space-x-2 text-sm">
                        <!-- Clock Icon -->
                        <svg class="w-6 h-6 hover:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a10 10 0 1010 10A10 10 0 0012 2zm0 12V8l-4 4" />
                        </svg>
                        <span>Riwayat Kehadiran</span>
                    </a>
                </li>

                <!-- Jurnal Kegiatan Harian -->
                <li class="p-3 {{ request()->is('jurnal-siswa') ? 'bg-green-600' : 'hover:bg-gray-700 hover:shadow-lg transition-all duration-200 cursor-pointer' }} flex items-center space-x-2">
                    <a href="{{ route('jurnal-siswa.index') }}" class="flex items-center w-full space-x-2 text-sm">
                        <!-- Pencil Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hover:text-green-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                        <span>Jurnal Kegiatan Harian</span>
                    </a>
                </li>

                <!-- Laporan PKL -->
                <li class="p-3 {{ request()->is('laporan-pkl') ? 'bg-green-600' : 'hover:bg-gray-700 hover:shadow-lg transition-all duration-200 cursor-pointer' }} flex items-center space-x-2">
                    <a href="{{ route('laporan-pkl') }}" class="flex items-center w-full space-x-2 text-sm">
                        <!-- File Icon -->
                        <svg class="w-6 h-6 hover:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2H6c-1.104 0-2 .896-2 2v16c0 1.104.896 2 2 2h12c1.104 0 2-.896 2-2V8l-6-6z" />
                        </svg>
                        <span>Laporan PKL</span>
                    </a>
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
                                    <a class="flex items-center space-x-2" href="{{ route('profilesiswa') }}">
                                        <img alt="test-account" height="30"
                                            src="https://img.icons8.com/fluency-systems-filled/50/000000/test-account.png"
                                            width="30" />
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li class="block px-4 py-2 hover:bg-gray-100 cursor-pointer transition">
                                    <form method="POST" action="{{ route('logout') }}">
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