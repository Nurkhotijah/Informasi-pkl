<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi PKL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('assets/logo absensipkl.png') }}" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <style>
        body {
          font-family: 'Poppins', sans-serif;
        }
         /* Prevent content from exceeding viewport width */
         html, body {
            overflow-x: hidden; 
        } 
    </style>
</head>

<body class="bg-gray-100">
 <!-- Header -->
<header class="flex justify-between items-center p-6 bg-gray-200 fixed w-full top-0 z-50 transition-all duration-300 shadow-lg">
  <div class="flex items-center">
      <img src="{{ asset('assets/si-pkl.png') }}" alt="Logo PKL" width="50" height="50"
          class="mr-3 rounded-full border-4 border-white p-1 bg-white shadow-md" />
      <h1 class="text-2xl font-bold text-blue-400 tracking-wide font-serif">SI-PKL</h1>
  </div>

  <nav class="hidden md:flex space-x-8 text-base">
      <a href="#home" class="nav-link text-blue-400 transition duration-300 hover:text-blue-400 hover:underline">Beranda</a>
      <a href="#about" class="nav-link text-blue-400 transition duration-300 hover:text-blue-400 hover:underline">Tentang</a>
      <a href="#service" class="nav-link text-blue-400 transition duration-300 hover:text-white hover:underline">Fitur</a>
  </nav>

  <div class="hidden md:flex space-x-4">
      <a href="{{ route('register') }}" class="bg-blue-400 text-white py-2 px-4 rounded-full shadow-lg transition-transform duration-300 hover:bg-blue-300 hover:text-white">
          Pengajuan
      </a>
      <a href="{{ route('login') }}" class="bg-blue-400 text-white py-2 px-4 rounded-full shadow-lg transition-transform duration-300 hover:bg-blue-300 hover:text-white">
        Masuk
    </a>
  </div>
  
  <div class="md:hidden">
      <button id="menu-button" class="text-white focus:outline-none">
          <i class="fas fa-bars text-2xl"></i>
      </button>
  </div>
</header>

<!-- Mobile Menu -->
<div class="flex justify-center">
  <nav id="menu" class="lg:hidden hidden w-full max-w-[calc(100%-3rem)] fixed mt-20 rounded-lg bg-white p-6 justify-center z-50 flex flex-col space-y-7 shadow-lg">
      <a href="#home" class="text-gray-700 hover:text-blue-500 transition duration-300">Home</a>
      <a href="#about" class="text-gray-700 hover:text-blue-500 transition duration-300">About</a>
      <a href="#service" class="text-gray-700 hover:text-blue-500 transition duration-300">Services</a>
      <a href="#faq" class="text-gray-700 hover:text-blue-500 transition duration-300">FAQ</a>
      <a href="#contact" class="text-gray-700 hover:text-blue-500 transition duration-300">Contact</a>

      <!-- Make buttons appear in separate rows -->
      <div class="mt-auto space-y-3">
        <a href="{{ route('register') }}" class="bg-blue-400 text-white py-2 px-4 rounded-full shadow-lg transition-transform duration-300 hover:bg-blue-300 hover:text-white">
          Pengajuan
      </a>
      <a href="{{ route('login') }}" class="bg-blue-400 text-white py-2 px-4 rounded-full shadow-lg transition-transform duration-300 hover:bg-blue-300 hover:text-white">
        Masuk
    </a>
      </div>
  </nav>
</div>

<!-- KONTEN UTAMA -->
<main id="home" class="flex flex-col md:flex-row justify-between items-center p-16 bg-gray-200 text-white">
  <!-- KONTEN TEKS DI SEBELAH KIRI -->
  <div class="max-w-lg space-y-6" data-aos="fade-up">
      <h2 class="text-5xl font-bold leading-tight mb-4 tracking-wider text-blue-400">
         SI-PKL
      </h2>
      <p class="text-blue-400 text-lg tracking-wide">
          Aplikasi ini memungkinkan sekolah untuk mengajukan siswa yang ingin melakukan PKL dan memonitor kegiatan siswa tersebut. 
      </p>
      <div class="flex space-x-4 mt-6">
          <a href="#about" class="bg-blue-400 text-white hover:bg-blue-300 hover:text-white py-3 px-6 rounded-full text-lg font-semibold shadow-md transition duration-300 transform hover:scale-110">
              Mulai Sekarang
          </a>
         
      </div>
  </div>

  <!-- GAMBAR DI SEBELAH KANAN -->
  <div class="flex-shrink-0 mt-10 md:mt-20" data-aos="fade-left">
      <div class="relative rounded-xl overflow-hidden transition-transform duration-300 transform hover:scale-105">
          <img src="{{ asset('assets/Deadline.png') }}" alt="" width="380" height="300" class="object-cover"/>
      </div>
  </div>
</main>

<!-- Modal Web -->
<div id="webModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-100">
  <!-- Close Button Positioned on the Overlay -->
  <button class="absolute top-10 right-10 text-white hover:text-gray-300 z-50" onclick="toggleModal(false)">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
      </svg>
  </button>

  <!-- Modal Content -->
  <div class="relative bg-white rounded-sm shadow-lg max-w-4xl w-full h-4/5">
      <div class="w-full h-full">
          <iframe id="webIframe" class="w-full h-full" src="" frameborder="0"></iframe>
      </div>
  </div>
</div>

<!-- ABOUT US -->
<section id="about" class="py-16 bg-gradient-to-r from-blue-50 to-teal-50 scroll-mt-16">
  <div class="container mx-auto px-6" data-aos="fade-right">
    <!-- About Us dan Visi dan Misi Kami -->
    <div class="text-center mb-16">
      <!-- About Us Heading -->
      <h2 class="text-4xl font-bold text-blue-900 mb-6 font-serif">Tentang Kami</h2> <!-- Added font-serif -->
      <div class="w-24 h-1 bg-gradient-to-r from-blue-400 to-blue-600 mx-auto mb-10"></div>
    </div>
    
    <div class="flex flex-col md:flex-row justify-center space-y-8 md:space-y-0 md:space-x-8">
      <div class="w-full md:w-1/2">
        <p class="mb-6 leading-relaxed text-gray-900 font-serif" data-aos="fade-up">Sistem Informasi PKL adalah aplikasi yang dirancang untuk membantu sekolah dalam mengajukan siswa untuk PKL dan memantau kegiatan mereka. Dengan fitur absensi menggunakan kamera, pengajuan surat izin, dan pengisian laporan PKL, aplikasi ini memudahkan komunikasi antara sekolah dan industri.</p> <!-- Added font-serif -->
        <ul class="list-none space-y-4 font-serif" data-aos="fade-up"> <!-- Added font-serif -->
          <li class="flex items-start">
            <i class="fas fa-check text-blue-400 mr-3 mt-1"></i>
            <span><strong>Pengajuan Siswa</strong> untuk PKL yang mudah dan cepat.</span>
          </li>
          <li class="flex items-start">
            <i class="fas fa-check text-blue-400 mr-3 mt-1"></i>
            <span>Monitoring kegiatan siswa secara real-time.</span>
          </li>
          <li class="flex items-start">
            <i class="fas fa-check text-blue-400 mr-3 mt-1"></i>
            <span>Pengisian laporan dan jurnal kegiatan yang terintegrasi.</span>
          </li>
        </ul>
      </div>
      <div class="w-full md:w-1/2" data-aos="fade-up">
        <p class="mb-6 leading-relaxed text-gray-900 font-serif">Dengan Sistem Informasi PKL, data kegiatan siswa akan langsung terhubung ke industri dan sekolah, memastikan semua pihak mendapatkan informasi yang akurat dan tepat waktu.</p> <!-- Added font-serif -->
      </div>
    </div>
  </div>
</section>

<!-- SERVICES SECTION -->
<section id="service" class="bg-gradient-to-r from-pink-100 via-blue-100 to-pink-100 py-16 scroll-mt-16 font-sans" data-aos="fade-up">
  <div class="container mx-auto px-6">
    <div class="text-center mb-12">
      <h2 class="text-3xl font-extrabold text-blue-900 font-serif" data-aos="fade-up">Fitur Utama</h2>
      <div class="flex justify-center mt-3">
        <div class="w-32 h-1 bg-gradient-to-r from-blue-400 to-blue-600 mx-auto mb-8 rounded-full"></div>
      </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Card 1 -->
      <div class="p-6 rounded-2xl shadow-lg hover:shadow-2xl focus:shadow-blue-500 transition-shadow duration-300 transform hover:-translate-y-1 cursor-pointer bg-white" data-aos="fade-up" tabindex="0">
        <div class="flex items-center justify-center mb-4">
          <img src="{{ asset('assets/Authentication.png') }}" alt="router Icon" class="w-12 h-12 mr-4">
          <h3 class="text-xl font-bold text-blue-900">Absensi Kamera</h3>
        </div>
        <p class="text-gray-700 text-sm text-center">Siswa dapat melakukan absensi dengan menggunakan kamera secara mudah.</p>
      </div>
      <!-- Card 2 -->
      <div class="p-6 rounded-2xl shadow-lg hover:shadow-2xl focus:shadow-blue-500 transition-shadow duration-300 transform hover:-translate-y-1 cursor-pointer bg-white" data-aos="fade-up" data-aos-delay="100" tabindex="0">
        <div class="flex items-center justify-center mb-4">
          <img src="{{ asset('assets/Computer.png') }}" alt="monitoring Icon" class="w-12 h-12 mr-4">
          <h3 class="text-xl font-bold text-blue-900">Monitoring Kegiatan</h3>
        </div>
        <p class="text-gray-700 text-sm text-center">Pantau kegiatan siswa secara real-time untuk memastikan kehadiran dan aktivitas mereka.</p>
      </div>
      <!-- Card 3 -->
      <div class="p-6 rounded-2xl shadow-lg hover:shadow-2xl focus:shadow-blue-500 transition-shadow duration-300 transform hover:-translate-y-1 cursor-pointer bg-white" data-aos="fade-up" data-aos-delay="200" tabindex="0">
        <div class="flex items-center justify-center mb-4">
          <img src="{{ asset('assets/Chart 5.png') }}" alt="report Icon" class="w-12 h-12 mr-4">
          <h3 class="text-xl font-bold text-blue-900">Laporan Kegiatan</h3>
        </div>
        <p class="text-gray-700 text-sm text-center">Siswa dapat mengisi laporan kegiatan dan jurnal secara terintegrasi.</p>
      </div>
      <!-- Card 4 -->
      <div class="p-6 rounded-2xl shadow-lg hover:shadow-2xl focus:shadow-blue-500 transition-shadow duration-300 transform hover:-translate-y-1 cursor-pointer bg-white" data-aos="fade-up" data-aos-delay="300" tabindex="0">
        <div class="flex items-center justify-center mb-4">
          <img src="{{ asset('assets/Message Received 1.png') }}" alt="WA Icon" class="w-12 h-12 mr-4">
          <h3 class="text-xl font-bold text-blue-900">Notifikasi</h3>
        </div>
        <p class="text-gray-700 text-sm text-center">Notifikasi untuk sekolah dan industri mengenai status siswa.</p>
      </div>
      <!-- Card 5 -->
      <div class="p-6 rounded-2xl shadow-lg hover:shadow-2xl focus:shadow-blue-500 transition-shadow duration-300 transform hover:-translate-y-1 cursor-pointer bg-white" data-aos="fade-up" data-aos-delay="400" tabindex="0">
        <div class="flex items-center justify-center mb-4">
          <img src="{{ asset('assets/Approval 5.png') }}" alt="tiket Icon" class="w-12 h-12 mr-4">
          <h3 class="text-xl font-bold text-blue-900">Pengajuan Surat Izin</h3>
        </div>
        <p class="text-gray-700 text-sm text-center">Siswa dapat mengajukan surat izin dengan mudah melalui aplikasi.</p>
      </div>
      <!-- Card 6 -->
      <div class="p-6 rounded-2xl shadow-lg hover:shadow-2xl focus:shadow-blue-500 transition-shadow duration-300 transform hover:-translate-y-1 cursor-pointer bg-white" data-aos="fade-up" data-aos-delay="500" tabindex="0">
        <div class="flex items-center justify-center mb-4">
          <img src="{{ asset('assets/accept.png') }}" alt="star Icon" class="w-12 h-12 mr-4">
          <h3 class="text-xl font-bold text-blue-900">Fitur Unggulan</h3>
        </div>
        <p class="text-gray-700 text-sm text-center">Fitur lengkap untuk memudahkan proses PKL antara sekolah dan industri.</p>
      </div>
    </div>
  </div>
</section>




<!-- FOOTER -->
<footer class="bg-blue-400 text-white p-6 text-center">
  <p class="text-sm lg:text-base">Copyright 2024 SI-PKL. Semua hak dilindungi.</p>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>  
  // Inisialisasi AOS
   AOS.init({
      duration: 1000, // Duration of animations in milliseconds
      easing: 'ease-in-out', // Easing function
    });

// Menangani menu hamburger
const menuButton = document.getElementById('menu-button');
        const menu = document.getElementById('menu');
        const closeButton = document.getElementById('close-button');

        menuButton.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        closeButton.addEventListener('click', () => {
            menu.classList.add('hidden');
        });

// Mengubah latar belakang navbar saat di-scroll
window.addEventListener('scroll', function() {
  const navbar = document.getElementById('navbar');
  if (window.scrollY > 50) {
    navbar.classList.add('shadow-md');
  } else {
    navbar.classList.remove('shadow-md');
  }
});

function toggleModal(show) {
        const modal = document.getElementById('webModal');
        const iframe = document.getElementById('webIframe');
        if (show) {
            // Ganti dengan URL web yang ingin ditampilkan
            iframe.src = "http://127.0.0.1:8000/";
            modal.classList.remove('hidden');
        } else {
            iframe.src = "";
            modal.classList.add('hidden');
        }
    }

// Tambahkan efek scroll halus untuk semua tautan dengan kelas 'nav-link'
document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('click', function(event) {
    event.preventDefault(); // Mencegah perilaku tautan default
    const targetID = this.getAttribute('href').slice(1); // Dapatkan ID target, hilangkan #
    const targetElement = document.getElementById(targetID); // Temukan elemen target

    // Periksa apakah elemen target ada
    if (targetElement) {
      window.scrollTo({
        top: targetElement.offsetTop - 70, // Gulir ke offset elemen - 70px (tinggi navbar)
        behavior: 'smooth' // Aktifkan scroll halus
      });
    }
  });
});

</script>
</body>
</html>
