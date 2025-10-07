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
            $table->string('name'); // Nombre de la entidad
            $table->enum('type', ['ministerio', 'organismo_publico', 'gobierno_regional', 'gobierno_local', 'empresa_publica']); // Tipo de entidad
            $table->string('sector'); // Sector al que pertenece
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
        Schema::dropIfExists('entities');
    }
};
