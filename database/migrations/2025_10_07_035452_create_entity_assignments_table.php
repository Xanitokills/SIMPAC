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
            $table->foreignId('entity_id')->constrained('entities')->onDelete('cascade'); // Entidad asignada
            $table->foreignId('sectorista_id')->constrained('sectoristas')->onDelete('cascade'); // Sectorista asignado
            $table->foreignId('implementation_plan_id')->constrained('implementation_plans')->onDelete('cascade'); // Plan de implementación
            $table->timestamp('assigned_at'); // Fecha de asignación
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending'); // Estado
            $table->timestamp('completed_at')->nullable(); // Fecha de completación
            $table->foreignId('assigned_by')->nullable()->constrained('users')->onDelete('set null'); // Usuario que asigna
            $table->text('notes')->nullable(); // Notas adicionales
            $table->timestamps();
            $table->softDeletes();
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
