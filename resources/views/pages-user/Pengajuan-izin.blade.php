@extends('components.layout-user')

@section('title', 'Pengajuan Izin')

@section('content')

<div class="w-full p-4 flex-1 space-y-8 bg-gray-100">
                <!-- Container untuk Form -->
                <div class="max-w-8xl mx-auto bg-white p-6 sm:p-8 rounded-lg shadow-lg mb-8">
                    <h2 class="text-2xl font-bold mb-4 text-black">Form Pengajuan Izin</h2>
                    <form id="izinForm" class="grid grid-cols-1 md:grid-cols-3 gap-4" onsubmit="return submitForm(event)">
                        <!-- Input untuk Nama Lengkap -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="nama-lengkap">
                                Nama Lengkap
                            </label>
                            <input class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" id="nama-lengkap" type="text" placeholder="Masukkan nama lengkap" required>
                        </div>

                        <!-- Input Tanggal Pengajuan Izin -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal-pengajuan-izin">
                                Tanggal Pengajuan Izin
                            </label>
                            <input class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" id="tanggal-pengajuan-izin" type="date" required>
                        </div>

                        <!-- Input Tanggal Mulai Izin -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal-izin">
                                Tanggal Mulai Izin
                            </label>
                            <input class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" id="tanggal-izin" type="date" required>
                        </div>

                        <!-- Input Tanggal Selesai Izin -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal-selesai-izin">
                                Tanggal Selesai Izin
                            </label>
                            <input class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" id="tanggal-selesai-izin" type="date" required>
                        </div>

                        <!-- Dropdown untuk Jenis Izin -->
                        <div class="mb-4 relative">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="jenis-izin">
                                Jenis Izin
                            </label>
                            <select class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" id="jenis-izin" required>
                                <option value="" disabled selected>Pilih Jenis Izin</option>
                                <option value="sakit">Sakit</option>
                                <option value="izin">Izin</option>
                                <option value="keperluan-lainnya">Keperluan Lainnya</option>
                            </select>
                        </div>

                        <!-- Input Surat Keterangan -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="surat-keterangan">
                                Surat Keterangan
                            </label>
                            <input class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" id="surat-keterangan" type="file">
                        </div>

                        <!-- Input Alasan Izin -->
                        <div class="mb-4 col-span-2">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="alasan-izin">
                                Alasan Izin
                            </label>
                            <input class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" id="alasan-izin" type="text" placeholder="Masukkan alasan izin" required>
                        </div>

                        <!-- Tombol Ajukan Izin -->
                        <div class="mb-4 flex items-end">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full" type="submit">
                                Ajukan Izin
                            </button>
                        </div>
                    </form>
                </div>

                <main class="p-6 overflow-y-auto h-full">
                    <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md mb-8">
                        <div class="flex justify-between mb-4">
                            <h1 class="text-2xl font-bold">Pengajuan Izin Siswa</h1>
                        </div>
                
                        <div class="overflow-x-auto"> 
                            <table class="min-w-full bg-white border rounded-lg shadow-md" id="izinTable">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">No</th>
                                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300 w-40">Nama Lengkap</th>
                                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300 w-32">Tanggal Pengajuan</th>
                                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300 w-32">Tanggal Mulai</th>
                                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300 w-32">Tanggal Selesai</th>
                                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Jenis Izin</th>
                                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Surat Keterangan</th>
                                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Status</th>
                                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300 w-32">Aksi</th>
                                    </tr>    
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr class="bg-white hover:bg-gray-50 transition">
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">1</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800 w-40">Nur Khotijah</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-20</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-22</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-26</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">Sakit</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-blue-500 underline cursor-pointer hover:text-blue-600">
                                            <i>Surat.png</i>
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-center text-green-500 font-semibold">
                                            Disetujui
                                        </td>
                                        <td class="py-4 px-3 border-b border-gray-300 text-center w-32">
                                            <div class="flex justify-center space-x-1">
                                                <button class="bg-yellow-400 text-white px-2 py-1 text-xs rounded-lg hover:bg-yellow-500 transition">
                                                    <a href="{{ route('edit-izin') }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                </button>
                                                <a href="{{ route('hapus-izin') }}" class="bg-red-500 text-white px-1 py-1 text-xs rounded-lg hover:bg-red-600 transition">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Data 2 -->
                                    <tr class="bg-white hover:bg-gray-50 transition">
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">2</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800 w-40">Ahmad Fadli</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-18</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-19</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-21</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">Keperluan Keluarga</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-blue-500 underline cursor-pointer hover:text-blue-600">
                                            <i>Surat.png</i>
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-center text-yellow-500 font-semibold">
                                            Menunggu
                                        </td>
                                        <td class="py-4 px-3 border-b border-gray-300 text-center w-32">
                                            <div class="flex justify-center space-x-1">
                                                <button class="bg-yellow-400 text-white px-2 py-1 text-xs rounded-lg hover:bg-yellow-500 transition">
                                                    <a href="{{ route('edit-izin') }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                </button>
                                                <a href="{{ route('hapus-izin') }}" class="bg-red-500 text-white px-1 py-1 text-xs rounded-lg hover:bg-red-600 transition">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Data 3 -->
                                    <tr class="bg-white hover:bg-gray-50 transition">
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">3</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800 w-40">Rina Astuti</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-15</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-16</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-20</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">Sakit</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-blue-500 underline cursor-pointer hover:text-blue-600">
                                            <i>Surat_sakit.png</i>
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-center text-red-500 font-semibold">
                                            Ditolak
                                        </td>
                                        <td class="py-4 px-3 border-b border-gray-300 text-center w-32">
                                            <div class="flex justify-center space-x-1">
                                                <button class="bg-yellow-400 text-white px-2 py-1 text-xs rounded-lg hover:bg-yellow-500 transition">
                                                    <a href="{{ route('edit-izin') }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                </button>
                                                <a href="{{ route('hapus-izin') }}" class="bg-red-500 text-white px-1 py-1 text-xs rounded-lg hover:bg-red-600 transition">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Data 4 -->
                                    <tr class="bg-white hover:bg-gray-50 transition">
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">4</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800 w-40">Siti Aminah</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-17</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-19</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-21</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">Urgent</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-blue-500 underline cursor-pointer hover:text-blue-600">
                                            <i>Urgent_request.png</i>
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-center text-green-500 font-semibold">
                                            Disetujui
                                        </td>
                                        <td class="py-4 px-3 border-b border-gray-300 text-center w-32">
                                            <div class="flex justify-center space-x-1">
                                                <button class="bg-yellow-400 text-white px-2 py-1 text-xs rounded-lg hover:bg-yellow-500 transition">
                                                    <a href="{{ route('edit-izin') }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                </button>
                                                <a href="{{ route('hapus-izin') }}" class="bg-red-500 text-white px-1 py-1 text-xs rounded-lg hover:bg-red-600 transition">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Data 5 -->
                                    <tr class="bg-white hover:bg-gray-50 transition">
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">5</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800 w-40">Budi Santoso</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-15</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-16</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-18</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">Cuti</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-blue-500 underline cursor-pointer hover:text-blue-600">
                                            <i>Cuti_surat.png</i>
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-center text-green-500 font-semibold">
                                            Disetujui
                                        </td>
                                        <td class="py-4 px-3 border-b border-gray-300 text-center w-32">
                                            <div class="flex justify-center space-x-1">
                                                <button class="bg-yellow-400 text-white px-2 py-1 text-xs rounded-lg hover:bg-yellow-500 transition">
                                                    <a href="{{ route('edit-izin') }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                </button>
                                                <a href="{{ route('hapus-izin') }}" class="bg-red-500 text-white px-1 py-1 text-xs rounded-lg hover:bg-red-600 transition">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="bg-white hover:bg-gray-50 transition">
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">6</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800 w-40">Eka Putri</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-10</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-11</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-13</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">Sakit</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-blue-500 underline cursor-pointer hover:text-blue-600">
                                            <i>Surat_Sakit.png</i>
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-center text-red-500 font-semibold">
                                            Ditolak
                                        </td>
                                        <td class="py-4 px-3 border-b border-gray-300 text-center w-32">
                                            <div class="flex justify-center space-x-1">
                                                <button class="bg-yellow-400 text-white px-2 py-1 text-xs rounded-lg hover:bg-yellow-500 transition">
                                                    <a href="{{ route('edit-izin') }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                </button>
                                                <a href="{{ route('hapus-izin') }}" class="bg-red-500 text-white px-1 py-1 text-xs rounded-lg hover:bg-red-600 transition">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Data 7 -->
                                    <tr class="bg-white hover:bg-gray-50 transition">
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">7</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800 w-40">Dian Hartono</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-08</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-09</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-10</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">Acara Keluarga</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-blue-500 underline cursor-pointer hover:text-blue-600">
                                            <i>Acara_Family.png</i>
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-center text-green-500 font-semibold">
                                            Disetujui
                                        </td>
                                        <td class="py-4 px-3 border-b border-gray-300 text-center w-32">
                                            <div class="flex justify-center space-x-1">
                                                <button class="bg-yellow-400 text-white px-2 py-1 text-xs rounded-lg hover:bg-yellow-500 transition">
                                                    <a href="{{ route('edit-izin') }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                </button>
                                                <a href="{{ route('hapus-izin') }}" class="bg-red-500 text-white px-1 py-1 text-xs rounded-lg hover:bg-red-600 transition">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="bg-white hover:bg-gray-50 transition">
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">8</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800 w-40">Agus Prabowo</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-05</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-06</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-07</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">Liburan</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-blue-500 underline cursor-pointer hover:text-blue-600">
                                            <i>Liburan_surat.png</i>
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-center text-yellow-500 font-semibold">
                                            Menunggu
                                        </td>
                                        <td class="py-4 px-3 border-b border-gray-300 text-center w-32">
                                            <div class="flex justify-center space-x-1">
                                                <button class="bg-yellow-400 text-white px-2 py-1 text-xs rounded-lg hover:bg-yellow-500 transition">
                                                    <a href="{{ route('edit-izin') }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                </button>
                                                <a href="{{ route('hapus-izin') }}" class="bg-red-500 text-white px-1 py-1 text-xs rounded-lg hover:bg-red-600 transition">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Data 9 -->
                                    <tr class="bg-white hover:bg-gray-50 transition">
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">9</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800 w-40">Maya Sari</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-03</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-04</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-05</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">Acara Pernikahan</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-blue-500 underline cursor-pointer hover:text-blue-600">
                                            <i>Pernikahan_surat.png</i>
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-center text-green-500 font-semibold">
                                            Disetujui
                                        </td>
                                        <td class="py-4 px-3 border-b border-gray-300 text-center w-32">
                                            <div class="flex justify-center space-x-1">
                                                <button class="bg-yellow-400 text-white px-2 py-1 text-xs rounded-lg hover:bg-yellow-500 transition">
                                                    <a href="{{ route('edit-izin') }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                </button>
                                                <a href="{{ route('hapus-izin') }}" class="bg-red-500 text-white px-1 py-1 text-xs rounded-lg hover:bg-red-600 transition">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="bg-white hover:bg-gray-50 transition">
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">10</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800 w-40">Rudi Setiawan</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-09-30</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-01</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-10-02</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">Sakit</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-blue-500 underline cursor-pointer hover:text-blue-600">
                                            <i>Surat_Sakit.png</i>
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-center text-red-500 font-semibold">Ditolak</td>
                                        <td class="py-4 px-3 border-b border-gray-300 text-center w-32">
                                            <div class="flex justify-center space-x-1">
                                                <button class="bg-yellow-400 text-white px-2 py-1 text-xs rounded-lg hover:bg-yellow-500 transition">
                                                    <a href="{{ route('edit-izin') }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                </button>
                                                <a href="{{ route('hapus-izin') }}" class="bg-red-500 text-white px-1 py-1 text-xs rounded-lg hover:bg-red-600 transition">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Data 11 -->
                                    <tr class="bg-white hover:bg-gray-50 transition">
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">11</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800 w-40">Tina Safitri</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-09-28</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-09-29</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">2024-09-30</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">Keluarga</td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-blue-500 underline cursor-pointer hover:text-blue-600">
                                            <i>Keluarga_surat.png</i>
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-300 text-center text-green-500 font-semibold">Disetujui</td>
                                        <td class="py-4 px-3 border-b border-gray-300 text-center w-32">
                                            <div class="flex justify-center space-x-1">
                                                <button class="bg-yellow-400 text-white px-2 py-1 text-xs rounded-lg hover:bg-yellow-500 transition">
                                                    <a href="{{ route('edit-izin') }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                </button>
                                                <a href="{{ route('hapus-izin') }}" class="bg-red-500 text-white px-1 py-1 text-xs rounded-lg hover:bg-red-600 transition">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </td>    
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="flex justify-end items-center mt-4">
                            <span class="mr-4" id="pageNumber">Halaman 1</span>
                            <button class="bg-gray-300 text-gray-700 p-2 rounded mr-2" onclick="prevPage()">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="bg-gray-300 text-gray-700 p-2 rounded" onclick="nextPage()">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
            
                        
            
                    </div>
                </main>
             
                
                <script>  
                 function submitForm(event) {
                event.preventDefault(); // Menghindari pengiriman formulir
        
                // Ambil data dari form
                const namaLengkap = document.getElementById('nama-lengkap').value;
                const tanggalPengajuan = document.getElementById('tanggal-pengajuan-izin').value;
                const tanggalMulai = document.getElementById('tanggal-izin').value;
                const tanggalSelesai = document.getElementById('tanggal-selesai-izin').value;
                const jenisIzin = document.getElementById('jenis-izin').value;
                const suratKeterangan = document.getElementById('surat-keterangan').files.length > 0 ? 'Ada' : 'Tidak Ada'; // Menampilkan status ada/tidak
        
                // Buat elemen baru untuk tabel
                const tableBody = document.querySelector('#riwayatTable tbody');
                const newRow = document.createElement('tr');
        
                newRow.innerHTML = `
                    <td class="py-4 px-4 border-b border-gray-300 text-gray-700">Menunggu</td>
                    <td class="py-4 px-4 border-b border-gray-300 text-gray-800">${namaLengkap}</td>
                    <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">${tanggalPengajuan}</td>
                    <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">${tanggalMulai}</td>
                    <td class="py-4 px-4 border-b border-gray-300 text-gray-600 text-center">${tanggalSelesai}</td>
                    <td class="py-4 px-4 border-b border-gray-300 text-gray-700">${jenisIzin}</td>
                    <td class="py-4 px-4 border-b border-gray-300 text-blue-500 underline cursor-pointer hover:text-blue-600">
                        Surat
                    </td>
                    <td class="py-4 px-4 border-b border-gray-300 text-center text-gray-600">Menunggu</td>
                    <td class="py-4 px-3 border-b border-gray-300 text-center w-32">
                        <div class="flex justify-center space-x-1">
                            <button class="bg-yellow-400 text-white px-2 py-1 text-xs rounded-lg hover:bg-yellow-500 transition">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="bg-red-500 text-white px-1 py-1 text-xs rounded-lg hover:bg-red-600 transition">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    </td>
                `;
        
                // Tambahkan baris baru ke tabel
                tableBody.appendChild(newRow);
        
                // Reset form
                document.getElementById('izinForm').reset();
                document.getElementById('alasan-lainnya-container').classList.add('hidden');
            }
        
            function handleAlasanChange(select) {
                const lainnyaContainer = document.getElementById('alasan-lainnya-container');
                if (select.value === 'lainnya') {
                    lainnyaContainer.classList.remove('hidden');
                } else {
                    lainnyaContainer.classList.add('hidden');
                }
            }
        
            // Memanggil fungsi untuk menampilkan tombol yang sesuai saat halaman dimuat
            updateTombolAbsensi();
        
            // Dropdown Functionality
            const profileButton = document.getElementById('profileButton');
            const profileDropdown = document.getElementById('profileDropdown');
        
            profileButton.addEventListener('click', () => {
                profileDropdown.classList.toggle('hidden');
            });
        
            // Close dropdown if clicked outside
            window.addEventListener('click', function (e) {
                if (!profileButton.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.classList.add('hidden');
                }
            });
            </script>
            
        </div>
    </div>
@endsection