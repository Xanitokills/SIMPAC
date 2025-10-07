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
        Schema::create('implementation_plans', function (Blueprint $table) {
            $table->id();
            $table->enum('resolution_type', ['RM', 'RD', 'DS']); // Tipo de resolución
            $table->string('resolution_number')->unique(); // Número de Resolución
            $table->string('name'); // Nombre del plan
            $table->text('description')->nullable(); // Descripción del plan
            $table->string('pdf_path'); // Ruta del documento PDF
            $table->date('start_date'); // Fecha de inicio de vigencia
            $table->date('end_date')->nullable(); // Fecha fin de vigencia (null hasta que se genere modificación)
            $table->enum('status', ['active', 'expired', 'modified'])->default('active'); // Estado del plan
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null'); // Usuario que aprueba
            $table->timestamp('approved_at')->nullable(); // Fecha de aprobación
            $table->timestamps();
            $table->softDeletes(); // Para eliminación suave
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('implementation_plans');
    }
};
