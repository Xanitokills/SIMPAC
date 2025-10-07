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
            $table->foreignId('implementation_plan_id')->constrained('implementation_plans')->onDelete('cascade');
            $table->string('code')->unique(); // Código único de la entidad (ej: MINSA, MINEDU)
            $table->string('name'); // Nombre completo de la entidad
            $table->string('sector')->nullable(); // Sector al que pertenece
            $table->string('type')->nullable(); // Tipo: Nacional, Regional, Local
            $table->text('description')->nullable(); // Descripción
            $table->enum('status', ['active', 'inactive', 'transferred'])->default('active');
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
