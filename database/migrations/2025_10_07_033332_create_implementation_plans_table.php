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
            $table->string('resolution_number')->unique(); // Número de Resolución Ministerial
            $table->string('resolution_type')->default('RM'); // Tipo: RM (Resolución Ministerial)
            $table->string('plan_name'); // Nombre del plan
            $table->text('description')->nullable(); // Descripción del plan
            $table->string('pdf_path'); // Ruta del documento PDF del Plan
            $table->string('resolution_pdf_path')->nullable(); // Ruta del documento PDF de la Resolución
            $table->date('start_date'); // Fecha de inicio de vigencia
            $table->date('end_date')->nullable(); // Fecha fin de vigencia (null hasta que se genere modificación)
            $table->year('year'); // Año del plan para facilitar búsquedas
            $table->enum('status', ['active', 'expired', 'modified'])->default('active'); // Estado del plan
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null'); // Usuario que aprueba
            $table->timestamp('approved_at')->nullable(); // Fecha de aprobación
            $table->text('closure_reason')->nullable(); // Motivo de cierre/modificación
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
