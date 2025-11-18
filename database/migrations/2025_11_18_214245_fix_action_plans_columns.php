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
        Schema::table('action_plans', function (Blueprint $table) {
            // Agregar columna notes si no existe
            if (!Schema::hasColumn('action_plans', 'notes')) {
                $table->text('notes')->nullable()->comment('Notas adicionales del plan');
            }
            
            // Agregar columna approval_date si no existe
            if (!Schema::hasColumn('action_plans', 'approval_date')) {
                $table->date('approval_date')->nullable()->comment('Fecha de aprobación del plan');
            }
        });
        
        // Eliminar columna approved_date si existe (era el nombre antiguo)
        Schema::table('action_plans', function (Blueprint $table) {
            if (Schema::hasColumn('action_plans', 'approved_date')) {
                $table->dropColumn('approved_date');
            }
            
            // Eliminar general_comments si existe (ahora usamos notes)
            if (Schema::hasColumn('action_plans', 'general_comments')) {
                $table->dropColumn('general_comments');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('action_plans', function (Blueprint $table) {
            // Revertir los cambios
            if (Schema::hasColumn('action_plans', 'notes')) {
                $table->dropColumn('notes');
            }
            
            if (Schema::hasColumn('action_plans', 'approval_date')) {
                $table->dropColumn('approval_date');
            }
            
            // Restaurar columnas antiguas
            if (!Schema::hasColumn('action_plans', 'approved_date')) {
                $table->date('approved_date');
            }
            
            if (!Schema::hasColumn('action_plans', 'general_comments')) {
                $table->text('general_comments')->nullable();
            }
        });
    }
};
