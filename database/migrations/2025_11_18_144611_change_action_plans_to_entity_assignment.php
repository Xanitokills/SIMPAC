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
            // Eliminar la foreign key de meeting_id
            $table->dropForeign(['meeting_id']);
            
            // Agregar entity_assignment_id
            $table->foreignId('entity_assignment_id')->after('id')->constrained()->onDelete('cascade');
            
            // Hacer meeting_id nullable (opcional, para referencia)
            $table->unsignedBigInteger('meeting_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('action_plans', function (Blueprint $table) {
            // Revertir los cambios
            $table->dropForeign(['entity_assignment_id']);
            $table->dropColumn('entity_assignment_id');
            
            // Restaurar meeting_id como requerido
            $table->unsignedBigInteger('meeting_id')->nullable(false)->change();
            $table->foreign('meeting_id')->references('id')->on('meetings')->onDelete('cascade');
        });
    }
};
