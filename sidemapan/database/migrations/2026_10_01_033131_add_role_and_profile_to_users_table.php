<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')
                ->default('pembeli')
                ->after('password');

            $table->string('phone', 20)
                ->nullable();

            $table->text('address')
                ->nullable();

            $table->boolean('is_active')
                ->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'phone',
                'address',
                'is_active',
            ]);
        });
    }
};