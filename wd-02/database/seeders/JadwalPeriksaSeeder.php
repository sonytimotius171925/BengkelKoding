<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\JadwalPeriksa;

class JadwalPeriksaSeeder extends Seeder
{
    public function run()
    {
        $dokters = User::where('role', 'dokter')->get();

        if ($dokters->isEmpty()) {
            $this->command->warn('Tidak ada user dengan role dokter. Seeder tidak dijalankan.');
            return;
        }

        $jadwalHari = [
            ['hari' => 'Senin', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00'],
            ['hari' => 'Selasa', 'jam_mulai' => '09:00:00', 'jam_selesai' => '13:00:00'],
            ['hari' => 'Rabu', 'jam_mulai' => '13:00:00', 'jam_selesai' => '17:00:00'],
            ['hari' => 'Kamis', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00'],
            ['hari' => 'Jumat', 'jam_mulai' => '10:00:00', 'jam_selesai' => '14:00:00'],
            ['hari' => 'Sabtu', 'jam_mulai' => '08:30:00', 'jam_selesai' => '11:30:00'],
        ];

        foreach ($dokters as $dokter) {
            foreach ($jadwalHari as $jadwal) {
                JadwalPeriksa::create([
                    'id_dokter' => $dokter->id,
                    'hari' => $jadwal['hari'],
                    'jam_mulai' => $jadwal['jam_mulai'],
                    'jam_selesai' => $jadwal['jam_selesai'],
                ]);
            }
        }

        $this->command->info('Jadwal periksa berhasil dibuat untuk semua dokter.');
    }
}
