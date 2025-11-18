<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('action_plan_items', function (Blueprint $table) {
            // Verificar si las columnas existen antes de agregarlas
            if (!Schema::hasColumn('action_plan_items', 'predecessor_action')) {
                $table->string('predecessor_action')->nullable()->comment('Acción predecesora (Ej: 1.1.1)');
            }
            if (!Schema::hasColumn('action_plan_items', 'start_date')) {
                $table->date('start_date')->nullable()->comment('Fecha de inicio');
            }
            if (!Schema::hasColumn('action_plan_items', 'end_date')) {
                $table->date('end_date')->nullable()->comment('Fecha de término');
            }
            if (!Schema::hasColumn('action_plan_items', 'business_days')) {
                $table->integer('business_days')->nullable()->comment('Días hábiles calculados automáticamente');
            }
            if (!Schema::hasColumn('action_plan_items', 'problems')) {
                $table->text('problems')->nullable()->comment('Problemas presentados');
            }
            if (!Schema::hasColumn('action_plan_items', 'corrective_measures')) {
                $table->text('corrective_measures')->nullable()->comment('Medidas correctivas');
            }
        });
        
        // Actualizar los valores de status existentes para que coincidan con los nuevos valores
        // SQLite no soporta ALTER COLUMN, así que actualizamos los datos directamente
        DB::table('action_plan_items')
            ->where('status', 'en_proceso')
            ->update(['status' => 'proceso']);
        
        DB::table('action_plan_items')
            ->where('status', 'completado')
            ->update(['status' => 'finalizado']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir los valores de status
        DB::table('action_plan_items')
            ->where('status', 'proceso')
            ->update(['status' => 'en_proceso']);
        
        DB::table('action_plan_items')
            ->where('status', 'finalizado')
            ->update(['status' => 'completado']);
        
        Schema::table('action_plan_items', function (Blueprint $table) {
            $columns = ['predecessor_action', 'start_date', 'end_date', 'business_days', 'problems', 'corrective_measures'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('action_plan_items', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
