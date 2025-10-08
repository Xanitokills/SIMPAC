<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', [
                'secretario_ctppge',
                'procurador_pge', 
                'responsable_componente',
                'organo_colegiado',
                'sectorista'
            ])->default('sectorista')->after('email');
            $table->foreignId('sectorista_id')->nullable()->after('role')->constrained('sectoristas')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['sectorista_id']);
            $table->dropColumn(['role', 'sectorista_id']);
        });
    }
};
