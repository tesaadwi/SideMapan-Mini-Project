<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aspirasis', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->after('id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('jenis', ['aspirasi', 'pengaduan'])
                ->after('user_id');

            $table->string('judul')
                ->after('jenis');

            $table->text('isi')
                ->after('judul');

            $table->text('tanggapan')
                ->nullable()
                ->after('isi');

            $table->enum('status', [
                'pending',
                'processing',
                'resolved',
                'rejected',
            ])->default('pending')->after('tanggapan');
        });
    }

    public function down(): void
    {
        Schema::table('aspirasis', function (Blueprint $table) {
            $table->dropForeign(['user_id']);

            $table->dropColumn([
                'user_id',
                'jenis',
                'judul',
                'isi',
                'tanggapan',
                'status',
            ]);
        });
    }
};