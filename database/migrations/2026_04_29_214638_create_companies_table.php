<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();           // path or emoji
            $table->text('description')->nullable();
            $table->string('sector')->nullable();         // e.g. Tecnología, Salud
            $table->string('website')->nullable();
            $table->string('color')->default('blue');     // brand accent color
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
