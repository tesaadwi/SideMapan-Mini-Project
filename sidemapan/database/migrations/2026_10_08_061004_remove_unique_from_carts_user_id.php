<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            // Hapus foreign key lama
            $table->dropForeign(['user_id']);

            // Hapus unique index pada user_id
            $table->dropUnique('carts_user_id_unique');

            // Buat kembali foreign key tanpa unique
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            // Hapus foreign key
            $table->dropForeign(['user_id']);

            // Kembalikan unique index
            $table->unique('user_id');

            // Buat kembali foreign key
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }
};