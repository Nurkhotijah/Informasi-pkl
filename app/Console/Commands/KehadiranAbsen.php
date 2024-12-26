<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kehadiran;
use App\Models\User;

class KehadiranAbsen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:kehadiran-absen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menandai siswa yang tidak hadir dalam 24 jam sebagai tidak hadir';

    /**
     * Execute the console command.
     */
    public function handle()
{
    $this->info('Mulai menjalankan command KehadiranAbsen.');

    try {
        // Ambil tanggal hari ini
        $tanggalHariIni = now()->toDateString();

        // Ambil semua siswa dengan role 'siswa' yang belum melakukan absen atau izin
        $siswaBelumHadir = User::where('role', 'siswa') // Filter hanya untuk siswa
            ->whereDoesntHave('kehadiran', function ($query) use ($tanggalHariIni) {
                $query->where('tanggal', $tanggalHariIni);
            })->get();

        foreach ($siswaBelumHadir as $siswa) {
            // Validasi apakah profile dan id_sekolah tersedia
            if ($siswa->profile && $siswa->profile->id_sekolah) {
                Kehadiran::create([
                    'user_id' => $siswa->id,
                    'sekolah_id' => $siswa->profile->id_sekolah,
                    'tanggal' => $tanggalHariIni,
                    'status' => 'Tidak Hadir',
                ]);
                $this->info("Siswa ID {$siswa->id} berhasil ditandai sebagai Tidak Hadir.");
            } else {
                $this->warn("Siswa ID {$siswa->id} tidak memiliki sekolah yang valid.");
            }
        }

        $this->info('Command selesai dijalankan.');
    } catch (\Exception $e) {
        $this->error('Error: ' . $e->getMessage());
    }
}

}
