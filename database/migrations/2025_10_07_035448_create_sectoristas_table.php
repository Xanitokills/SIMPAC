<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sectoristas', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del sectorista (operario)
            $table->string('email')->unique(); // Email
            $table->string('phone')->nullable(); // Teléfono
            $table->enum('status', ['active', 'inactive'])->default('active'); // Estado
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sectoristas');
    }
};
