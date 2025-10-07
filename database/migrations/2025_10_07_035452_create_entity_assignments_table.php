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
        Schema::create('entity_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id')->constrained('entities')->onDelete('cascade');
            $table->foreignId('sectorista_id')->constrained('sectoristas')->onDelete('cascade');
            $table->foreignId('implementation_plan_id')->constrained('implementation_plans')->onDelete('cascade');
            $table->date('assigned_date'); // Fecha de asignación
            $table->date('end_date')->nullable(); // Fecha de fin de asignación (si aplica)
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');
            $table->foreignId('assigned_by')->nullable()->constrained('users')->onDelete('set null'); // Quien asignó
            $table->text('notes')->nullable(); // Notas sobre la asignación
            $table->timestamps();
            $table->softDeletes();
            
            // Índices para búsquedas eficientes
            $table->index(['entity_id', 'sectorista_id', 'status']);
            $table->index(['implementation_plan_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity_assignments');
    }
};
