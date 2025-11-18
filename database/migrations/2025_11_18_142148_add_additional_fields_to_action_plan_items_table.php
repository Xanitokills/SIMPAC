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
        Schema::table('action_plan_items', function (Blueprint $table) {
            $table->string('predecessor_action')->nullable()->after('responsible'); // Acción predecesora
            $table->date('start_date')->nullable()->after('due_date'); // Fecha de inicio
            $table->date('end_date')->nullable()->after('start_date'); // Fecha de término
            $table->integer('business_days')->nullable()->after('end_date'); // Días hábiles calculados
            $table->text('problems')->nullable()->after('notes'); // Problemas presentados
            $table->text('corrective_measures')->nullable()->after('problems'); // Medidas correctivas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('action_plan_items', function (Blueprint $table) {
            $table->dropColumn([
                'predecessor_action',
                'start_date',
                'end_date',
                'business_days',
                'problems',
                'corrective_measures'
            ]);
        });
    }
};
