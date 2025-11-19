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
        if (!Schema::hasTable('action_plan_items')) {
            return;
        }

        Schema::table('action_plan_items', function (Blueprint $table) {
            if (!Schema::hasColumn('action_plan_items', 'section_name')) {
                $table->string('section_name')->nullable()->after('action_name')->comment('Nombre de la sección (ej: 1.1 - Aprobación del plan)');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('action_plan_items')) {
            return;
        }

        Schema::table('action_plan_items', function (Blueprint $table) {
            if (Schema::hasColumn('action_plan_items', 'section_name')) {
                $table->dropColumn('section_name');
            }
        });
    }
};
