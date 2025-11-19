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
            if (!Schema::hasColumn('action_plan_items', 'evidence_file')) {
                $table->string('evidence_file')->nullable()->after('attachments')->comment('Ruta del archivo de evidencia');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('action_plan_items', function (Blueprint $table) {
            if (Schema::hasColumn('action_plan_items', 'evidence_file')) {
                $table->dropColumn('evidence_file');
            }
        });
    }
};
