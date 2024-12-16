@extends('components.layout-user')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="flex-1 p-6 bg-gray-100">
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-2">
            Hai {{ Auth::user()->name }}
            <span class="ml-2">
                <i class="fas fa-star text-yellow-500"></i>
            </span>
        </h1>
        <p class="text-lg font-semibold mb-1">Selamat Datang di SI-PKL</p>
        <div class="flex space-x-4">
            <a class="bg-blue-500 text-white px-4 py-2 rounded-lg" href="{{ route('jurnal-siswa.index') }}">Lihat Jurnal</a>
            @php
                $today = \Carbon\Carbon::now()->toDateString();
                $absenHariIni = \App\Models\Kehadiran::where('user_id', Auth::id())
                    ->whereDate('tanggal', $today)
                    ->first();
                    
                $buttonText = "Ayo Absen";
                if ($absenHariIni) {
                    if ($absenHariIni->foto_masuk && !$absenHariIni->foto_keluar) {
                        $buttonText = "Ayo Pulang";
                    } else if ($absenHariIni->foto_masuk && $absenHariIni->foto_keluar) {
                        $buttonText = "Selesai";
                    }
                }

                // Hitung jumlah kehadiran
                $jumlahKehadiran = \App\Models\Kehadiran::where('user_id', Auth::id())
                    ->where('status', 'Hadir')
                    ->count();
            @endphp
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg {{ $buttonText === 'Selesai' ? 'opacity-50 cursor-not-allowed' : '' }}" 
                    id="ayo-absen" 
                    {{ $buttonText === 'Selesai' ? 'disabled' : '' }}>
                {{ $buttonText }}
            </button>
            <a class="bg-gray-800 text-white px-4 py-2 rounded-lg flex items-center gap-2" 
            href="{{ route('cetak-sertifikat', Auth::user()->id) }}">
             <i class="fas fa-download"></i>
             Sertifikat PKL
         </a>         

        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <!-- Waktu Saat Ini -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Waktu Saat Ini</h2>
            <p class="text-3xl font-bold mt-4" id="current-time">--:--:-- WIB</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Jumlah Jurnal</h2>
            <p class="text-3xl font-bold mt-4" id="jumlah-jurnal">{{ $jumlahJurnal }}</p>
        </div>
        

        <!-- Jumlah Absen -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Jumlah Absen yang Telah Dilakukan</h2>
            <p class="text-3xl font-bold mt-4" id="jumlah-absen">{{ $jumlahKehadiran }}</p>
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
     / function updateJumlahJurnal() {
        fetch("/api/jumlah-jurnal")  // Pastikan route ini sudah ada
            .then(response => response.json())
            .then(data => {
                document.getElementById('jumlah-jurnal').textContent = data.jumlah_jurnal;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
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

    // Mendapatkan elemen modal dan tombol
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
                formData.append('foto_absen', blob, 'foto_absen.jpg');
                
                // Tentukan jenis absen berdasarkan teks tombol
                const absensiButton = document.getElementById("ayo-absen");
                const jenisAbsen = absensiButton.textContent.toLowerCase().includes("absen") ? "masuk" : "pulang";
                formData.append('jenis_absen', jenisAbsen);

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
                        document.getElementById("jumlah-absen").textContent = result.jumlah_kehadiran;
                        
                        const absensiButton = document.getElementById("ayo-absen");
                        if (jenisAbsen === "masuk") {
                            absensiButton.textContent = "Ayo Pulang";
                        } else {
                            absensiButton.textContent = "Selesai";
                            absensiButton.disabled = true;
                            absensiButton.classList.add("opacity-50", "cursor-not-allowed");
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

    // Menangani klik tombol Ambil Foto
    captureButton.addEventListener("click", capturePhoto);

    // Fungsi untuk menonaktifkan tombol setelah absen
    function disableButton() {
        const absensiButton = document.getElementById("ayo-absen");
        absensiButton.disabled = true;
        absensiButton.classList.add("cursor-not-allowed");
        absensiButton.classList.add("opacity-50");
    }

    // Menangani klik tombol Tutup
    closeButton.addEventListener("click", () => {
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
    });

    // Menangani klik untuk membuka modal kamera
    document.getElementById("ayo-absen").addEventListener("click", () => {
        capturedImage.classList.add("hidden");
        capturedImage.src = "";
        videoElement.classList.remove("hidden");
        captureButton.textContent = "Mulai Foto";
        captureButton.classList.remove("bg-green-500");
        captureButton.classList.add("bg-blue-500");

        cameraModal.classList.remove("hidden");
        startCamera();
    });

    // Memulai kamera saat halaman dimuat
    window.addEventListener("DOMContentLoaded", () => {
        updateTime();
    });

    // Fungsi untuk membuka modal
    function openModal(absensiId) {
        document.getElementById('modal-' + absensiId).classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    function closeModal(absensiId) {
        document.getElementById('modal-' + absensiId).classList.add('hidden');
    }

    // Fungsi untuk menampilkan gambar absen (Masuk/Pulang)
    function showImage(type, absensiId) {
        if (type === 'checkIn') {
            document.getElementById('checkInImage-' + absensiId).classList.remove('hidden');
            document.getElementById('checkOutImage-' + absensiId).classList.add('hidden');
        } else if (type === 'checkOut') {
            document.getElementById('checkOutImage-' + absensiId).classList.remove('hidden');
            document.getElementById('checkInImage-' + absensiId).classList.add('hidden');
        }
    }

</script>

@endsection
