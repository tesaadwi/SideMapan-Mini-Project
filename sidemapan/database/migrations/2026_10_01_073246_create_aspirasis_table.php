<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirasis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('jenis', ['aspirasi', 'pengaduan']);
            $table->string('judul');
            $table->text('isi');

            $table->text('tanggapan')->nullable();

            $table->enum('status', [
                'pending',
                'processing',
                'resolved',
                'rejected'
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};