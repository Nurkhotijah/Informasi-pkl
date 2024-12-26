<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi PKL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('assets/logo absensipkl.png') }}" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">  
    <style>
      html {
        scroll-behavior: smooth;
      }
      #mobile-menu {
        transition: transform 0.3s ease-in-out;
        transform: translateX(100%);
        z-index: 60; /* Ensure mobile menu is above the header */
      }
      #mobile-menu.open {
        transform: translateX(0);
      }
      .gradient-text {
        background: linear-gradient(to right, #38b2ac, #4299e1);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }
      .sticky-header {
        position: sticky;
        top: 0;
        z-index: 50; /* Ensure header is below the mobile menu */
      }
    </style>
</head>
<body class="font-roboto">

  <header class="bg-gradient-to-r from-teal-500 to-blue-500 p-4 flex justify-between items-center sticky-header">
    <div class="flex items-center">
        <img src="{{ asset('assets/si-pkl.png') }}" alt="SI-PKL logo" class="h-10 w-10 rounded-full">
        <span class="text-white text-xl font-bold ml-2">SI-PKL</span>
    </div>
    <nav class="hidden md:flex space-x-4">
        <a href="#beranda" class="text-white hover:text-yellow-400">Beranda</a>
        <a href="#tentang" class="text-white hover:text-yellow-400">Tentang</a>
        <a href="#fitur" class="text-white hover:text-yellow-400">Fitur</a>
    </nav>
    <div class="hidden md:flex space-x-2">
        <a href="{{ route('register') }}"  class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Pengajuan</a>
        <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded">Masuk</a>
    </div>
    <div class="md:hidden">
        <button id="menu-toggle" class="text-white focus:outline-none">
            <i class="fas fa-bars text-2xl"></i>
        </button>
    </div>
  </header>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="fixed top-0 right-0 h-full w-64 bg-white p-4 hidden flex flex-col space-y-4">
    <button id="menu-close" class="text-black self-end focus:outline-none">
        <i class="fas fa-times text-2xl"></i>
    </button>
    <nav class="flex flex-col space-y-4">
        <a href="#beranda" class="gradient-text text-lg font-semibold menu-link">Beranda</a>
        <a href="#tentang" class="gradient-text text-lg font-semibold menu-link">Tentang</a>
        <a href="#fitur" class="gradient-text text-lg font-semibold menu-link">Fitur</a>
        <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Pengajuan</a>
        <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded">Masuk</a>
    </nav>
  </div>

  <main class="pt-24">
    <!-- Beranda Section -->
    <section id="beranda" class="py-20 bg-white pt-5">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between">
            <!-- Left Content (Text) -->
            <div class="text-center md:text-left md:w-1/2 mt-0 md:mt-[-50px]">
                <h2 class="text-3xl md:text-5xl font-bold text-indigo-700 mb-4">Selamat Datang di SI-PKL</h2>
                <p class="text-lg md:text-2xl text-gray-800 mb-6">Platform untuk memudahkan proses administrasi PKL siswa, memberikan pengalaman yang lebih baik dan efisien.</p>
                <!-- New Button Style -->
                <a href="#tentang" class="bg-gradient-to-r from-teal-500 to-blue-600 text-white px-6 md:px-8 py-3 md:py-4 rounded-full text-base md:text-lg font-semibold shadow-lg hover:scale-105 transition-all duration-300">Pelajari Lebih Lanjut</a>
            </div>
            <!-- Right Content (Image/Animated Icon) -->
            <div class="md:w-1/2 flex justify-center md:justify-end mt-8 md:mt-0" data-aos="zoom-in" data-aos-duration="1000">
                <div class="relative">
                    <img src="{{ asset('assets/1.png') }}" alt="Gambar Beranda" class="w-96 md:w-[400px] h-96 md:h-[400px]">
                </div>
            </div>
        </div>
    </section>    
  
    <section id="tentang" class="py-20 bg-gray-50">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-center py-12 px-4 md:px-6 lg:px-8">
            <!-- Left Content (Image/Icon) -->
            <div class="w-full md:w-1/2 flex justify-center order-2 md:order-1 mt-8 md:mt-0" data-aos="zoom-in" data-aos-duration="1000">
                <img src="{{ asset('assets/2.png') }}" alt="" class="max-w-full h-auto" height="200" width="400">
            </div>
            
            <!-- Right Content (Text) -->
            <div class="w-full md:w-1/2 md:pl-12 order-1 md:order-2">
                <h1 class="text-3xl font-bold text-blue-600 mb-4">Tentang Sistem Informasi PKL</h1>
                <p class="text-gray-600 mb-6">Sistem Informasi PKL ini membantu mengelola kegiatan PKL siswa dengan lebih efisien, mulai dari absensi hingga laporan kegiatan.</p>
                
                <!-- New Content with Icons -->
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-teal-500 text-xl mr-3"></i>
                        <span class="text-gray-700"><strong>Pengajuan Siswa</strong> untuk PKL yang mudah dan cepat.</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-teal-500 text-xl mr-3"></i>
                        <span class="text-gray-700"><strong>Absensi Online</strong> tanpa kertas, praktis dan efisien.</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-teal-500 text-xl mr-3"></i>
                        <span class="text-gray-700"><strong>Laporan Kegiatan</strong> yang terstruktur dan mudah dibuat.</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

  <section id="fitur" class="py-20 bg-gray-50">
    <div class="container mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-indigo-700">Fitur Unggulan</h2>
            <p class="text-lg text-gray-700 mt-4">Beragam fitur untuk mendukung kegiatan PKL siswa dengan lebih efisien.</p>
        </div>
        <!-- Fitur Items -->
        <div class="space-y-16">
            <!-- Fitur 1 -->
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 text-center md:text-left">
                    <h3 class="text-2xl font-semibold text-indigo-700 mb-4">Absensi Kamera</h3>
                    <p class="text-lg text-gray-700">Siswa dapat melakukan absensi dengan menggunakan kamera secara mudah dan praktis.</p>
                </div>
                <div class="md:w-1/2 flex justify-center" data-aos="zoom-in" data-aos-duration="1000">
                    <img alt="Absensi Kamera" class="w-72 h-72" src="{{ asset('assets/4.png') }}"/>
                </div>
            </div>
            <!-- Fitur 2 -->
            <div class="flex flex-col md:flex-row-reverse items-center justify-between">
                <div class="md:w-1/2 text-center md:text-left">
                    <h3 class="text-2xl font-semibold text-indigo-700 mb-4">Laporan Kegiatan</h3>
                    <p class="text-lg text-gray-700">Membantu siswa membuat laporan kegiatan PKL yang terstruktur dan mudah dipahami.</p>
                </div>
                <div class="md:w-1/2 flex justify-center" data-aos="zoom-in" data-aos-duration="1000">
                    <img alt="Laporan Kegiatan" class="w-72 h-72" src="{{ asset('assets/3.png') }}"/>
                </div>
            </div>
            <!-- Fitur 3 -->
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 text-center md:text-left">
                    <h3 class="text-2xl font-semibold text-indigo-700 mb-4">Pengajuan Izin</h3>
                    <p class="text-lg text-gray-700">Memudahkan siswa untuk mengajukan izin jika tidak dapat hadir ke lokasi PKL.</p>
                </div>
                <div class="md:w-1/2 flex justify-center" data-aos="zoom-in" data-aos-duration="1000">
                    <img alt="Pengajuan Izin" class="w-72 h-72" height="150" src="{{ asset('assets/6.png') }}" width="150"/>
                </div>
            </div>
            <!-- Fitur 4 -->
            <div class="flex flex-col md:flex-row-reverse items-center justify-between">
                <div class="md:w-1/2 text-center md:text-left">
                    <h3 class="text-2xl font-semibold text-indigo-700 mb-4">Monitoring</h3>
                    <p class="text-lg text-gray-700">Pantau kegiatan siswa secara real-time untuk memastikan kehadiran dan aktivitas mereka.</p>
                </div>
                <div class="md:w-1/2 flex justify-center" data-aos="zoom-in" data-aos-duration="1000">
                    <img alt="Monitoring" class="w-72 h-72" height="150" src="{{ asset('assets/5.png') }}" width="150"/>
                </div>
            </div>
        </div>
    </div>
    </section>
  </main>
    <!-- Footer -->
    <footer class="bg-gradient-to-r from-teal-500 to-blue-600 text-white py-6 mt-12">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Sistem Informasi PKL. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>
    AOS.init();
    document.getElementById('menu-toggle').addEventListener('click', function() {
        var menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
        menu.classList.toggle('open');
    });

    document.getElementById('menu-close').addEventListener('click', function() {
        var menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
        menu.classList.toggle('open');
    });

    document.querySelectorAll('.menu-link').forEach(link => {
        link.addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            menu.classList.add('hidden');
            menu.classList.remove('open');
        });
    });

    document.addEventListener('click', function(event) {
        var menu = document.getElementById('mobile-menu');
        var menuToggle = document.getElementById('menu-toggle');
        var menuClose = document.getElementById('menu-close');

        if (!menu.contains(event.target) && !menuToggle.contains(event.target) && !menuClose.contains(event.target)) {
            menu.classList.add('hidden');
            menu.classList.remove('open');
        }
    });
  </script>

</body>
</html>