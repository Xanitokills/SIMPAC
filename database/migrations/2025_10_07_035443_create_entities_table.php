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
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Código único de la entidad (ej: MINSA, MINEDU)
            $table->string('name'); // Nombre completo de la entidad
            $table->string('type')->nullable(); // Tipo: ministerio, organismo, gobierno_regional, municipalidad
            $table->text('description')->nullable(); // Descripción
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entities');
    }
};
