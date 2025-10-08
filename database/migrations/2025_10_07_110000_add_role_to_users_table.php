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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'secretario_ctppge', 'procurador_pge', 'responsable_componente', 'organo_colegiado', 'sectorista'])->default('sectorista')->after('password');
            $table->foreignId('sectorista_id')->nullable()->constrained('sectoristas')->onDelete('set null')->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['sectorista_id']);
            $table->dropColumn(['role', 'sectorista_id']);
        });
    }
};
