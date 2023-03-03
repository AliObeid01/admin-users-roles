<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table-> string('name',45);
            $table-> string('email',45)->unique();
            $table-> string('password',255);
            $table-> string('gender',45);
            $table-> string('blood_type',45);
            $table-> integer ('status')->default(0);
            $table-> string ('type')->default('user');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
