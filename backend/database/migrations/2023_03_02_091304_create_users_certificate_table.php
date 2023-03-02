<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('users_certificate', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('certificate_id')->references('id')->on('certificates');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_certificate');
    }
};
