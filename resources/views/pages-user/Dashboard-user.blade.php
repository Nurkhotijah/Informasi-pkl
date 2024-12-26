@extends('components.layout-user')

@section('title', 'Dashboard Siswa')

@section('content')
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex items-center mb-4">
                <h1 class="text-2xl font-bold mr-2">Hai {{ Auth::user()->name }}</h1>
                <i class="fas fa-star text-yellow-500"></i>
            </div>
            <p class="mb-4">Selamat Datang di SI-PKL</p>
            <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-2">
            <a class="bg-blue-500 text-white px-4 py-2 rounded flex items-center justify-center" href="{{ route('jurnal-siswa.index') }}">Lihat Jurnal</a>
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg {{ $buttonText === 'Selesai' ? 'opacity-50 cursor-not-allowed' : '' }}" 
                id="ayo-absen" 
                {{ $buttonText === 'Selesai' ? 'disabled' : '' }}>
            {{ $buttonText }}
            </button>                
            <a class="bg-gray-800 text-white px-4 py-2 rounded flex items-center justify-center"
                href="{{ route('cetak-sertifikat', Auth::user()->id) }}">
                <i class="fas fa-download mr-2"></i>
                Sertifikat           
            </a>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <p class="text-gray-600 mb-2">Waktu Saat Ini</p>
                <p class="text-2xl font-bold" id="current-time">--:--:-- WIB</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <p class="text-gray-600 mb-2">Jumlah Jurnal</p>
                <p class="text-2xl font-bold">{{ $jumlahJurnal }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <p class="text-gray-600 mb-2">Jumlah Absen</p>
                <p class="text-2xl font-bold">{{ $jumlahKehadiran }}</p>
            </div>
        </div>
    </div>

    <!-- Modal Kamera -->
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden" id="cameraModal">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Kamera</h2>
                <button class="text-gray-600 hover:text-gray-800" id="closeButton"><i class="fas fa-times"></i></button>
            </div>
            <video autoplay class="w-full h-auto bg-gray-200 rounded-lg" id="video"></video>
            <!-- Tempat Menampilkan Gambar Setelah Foto diambil -->
            <img id="captured-image" class="hidden mt-4 w-full h-auto bg-gray-200 rounded-lg" />
            <div class="flex justify-center mt-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2" id="captureButton">Mulai Foto</button>
            </div>
        </div>
    </div>
<script>
    const cameraModal = document.getElementById("cameraModal");
    const captureButton = document.getElementById("captureButton");
    const videoElement = document.getElementById("video");
    const capturedImage = document.getElementById("captured-image");
    const closeButton = document.getElementById("closeButton");

    // Fungsi untuk membuka kamera
    async function startCamera() {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({ video: true });
            videoElement.srcObject = stream;
        } catch (error) {
            console.error("Error accessing camera:", error);
            alert("Gagal mengakses kamera. Pastikan kamera tersedia dan izin diberikan.");
        }
    }

    // Fungsi untuk mengambil foto dan mengirim ke server
    async function capturePhoto() {
        if (captureButton.textContent === "Mulai Foto") {
            // Mulai mengambil foto
            const canvas = document.createElement("canvas");
            canvas.width = videoElement.videoWidth;
            canvas.height = videoElement.videoHeight;
            const ctx = canvas.getContext("2d");
            ctx.drawImage(videoElement, 0, 0, canvas.width, canvas.height);
            
            // Tampilkan gambar yang diambil
            capturedImage.src = canvas.toDataURL('image/jpeg');
            capturedImage.classList.remove("hidden");
            videoElement.classList.add("hidden");
            
            // Ubah teks tombol
            captureButton.textContent = "Selesai";
            captureButton.classList.remove("bg-blue-500");
            captureButton.classList.add("bg-green-500");
            
        } else {
            // Proses selesai dan kirim ke server
            const canvas = document.createElement("canvas");
            canvas.width = videoElement.videoWidth;
            canvas.height = videoElement.videoHeight;
            const ctx = canvas.getContext("2d");
            ctx.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

            canvas.toBlob(async (blob) => {
                const formData = new FormData();
                formData.append('foto_masuk', blob, 'foto_absen.jpg');
                
                // Tentukan jenis absen berdasarkan teks tombol
                const absensiButton = document.getElementById("ayo-absen");
                const jenisAbsen = absensiButton ? (absensiButton.textContent.toLowerCase().includes("absen") ? "masuk" : "pulang") : "masuk";
                formData.append('jenis_absen', jenisAbsen);
                formData.append('id', "{{$absenHariIni?->id}}");

                try {
                    const response = await fetch("{{ route('kehadiran.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: formData
                    });

                    const result = await response.json();
                    
                    if (response.ok) {
                        alert(jenisAbsen === "masuk" ? "Absensi masuk berhasil dicatat!" : "Absensi pulang berhasil dicatat!");
                        
                        // Update jumlah kehadiran dari response server
                        const jumlahAbsenElement = document.getElementById("jumlah-absen");
                        if (jumlahAbsenElement) {
                            jumlahAbsenElement.textContent = result.jumlah_kehadiran;
                        }
                        
                        if (absensiButton) {
                            if (jenisAbsen === "masuk") {
                                absensiButton.textContent = "Ayo Pulang";
                            } else {
                                absensiButton.textContent = "Selesai";
                                absensiButton.disabled = true;
                                absensiButton.classList.add("opacity-50", "cursor-not-allowed");
                            }
                        }
                        
                        // Tutup modal dan reset kamera
                        cameraModal.classList.add("hidden");
                        
                        if (videoElement.srcObject) {
                            videoElement.srcObject.getTracks().forEach(track => track.stop());
                        }
                        
                        // Reset tampilan untuk penggunaan berikutnya
                        captureButton.textContent = "Mulai Foto";
                        captureButton.classList.remove("bg-green-500");
                        captureButton.classList.add("bg-blue-500");
                        videoElement.classList.remove("hidden");
                        capturedImage.classList.add("hidden");
                        
                        // Reload halaman setelah berhasil absen
                        window.location.reload();
                    } else {
                        throw new Error(result.message || 'Terjadi kesalahan saat menyimpan absensi');
                    }
                } catch (error) {
                    console.error("Error:", error);
                    alert("Gagal mengirim data: " + error.message);
                }
            }, 'image/jpeg', 0.8);
        }
    }

    // Menampilkan modal saat tombol absen diklik
    document.getElementById("ayo-absen").addEventListener("click", function() {
        // Tampilkan modal kamera
        cameraModal.classList.remove("hidden");
        
        // Mulai kamera
        startCamera();
    });

    // Menutup modal
    closeButton.addEventListener("click", function() {
        cameraModal.classList.add("hidden");
        if (videoElement.srcObject) {
            videoElement.srcObject.getTracks().forEach(track => track.stop());
        }
    });

    // Menangani pengambilan foto
    captureButton.addEventListener("click", capturePhoto);

      // Timer untuk Waktu Saat Ini
      function updateTime() {
        const timeElement = document.getElementById("current-time");
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        timeElement.textContent = `${hours}:${minutes}:${seconds} WIB`;
    }

    // Update waktu setiap detik
    setInterval(updateTime, 1000);
</script>

@endsection
