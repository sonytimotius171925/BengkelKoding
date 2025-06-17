<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PoliSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('polis')->insert([
            [
                'nama' => 'Poli Gigi',
                'deskripsi' => 'Menangani kesehatan dan perawatan gigi serta mulut.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Poli Umum',
                'deskripsi' => 'Pelayanan kesehatan dasar untuk berbagai penyakit umum dan konsultasi medis secara menyeluruh.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Poli Anak',
                'deskripsi' => 'Memberikan pelayanan kesehatan untuk bayi dan anak-anak.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Poli Penyakit Dalam',
                'deskripsi' => 'Mengelola diagnosis dan perawatan penyakit dalam dewasa.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Poli Kebidanan dan Kandungan',
                'deskripsi' => 'Memberikan layanan kesehatan khusus wanita, termasuk kehamilan, persalinan, dan masalah kandungan.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Poli Mata',
                'deskripsi' => 'Pelayanan kesehatan mata dan gangguan penglihatan.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Poli THT',
                'deskripsi' => 'Menangani penyakit dan gangguan Telinga, Hidung, dan Tenggorokan.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

        ]);
    }
}

