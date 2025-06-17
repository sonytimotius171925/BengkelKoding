<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom lama jika ada
            if (Schema::hasColumn('users', 'poli')) {
                $table->dropColumn('poli');
            }

            // Tambahkan foreign key baru
            $table->foreignId('id_poli')->nullable()->constrained('polis')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_poli']);
            $table->dropColumn('id_poli');
            $table->string('poli')->nullable(); // jika ingin kembalikan kolom lama
        });
    }
};
