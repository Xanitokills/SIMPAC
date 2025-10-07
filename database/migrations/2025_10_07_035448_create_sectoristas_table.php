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
        Schema::create('sectoristas', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Código único del sectorista (puede ser DNI o código de empleado)
            $table->string('full_name'); // Nombre completo
            $table->string('email')->unique(); // Correo electrónico (desde Active Directory)
            $table->string('phone')->nullable(); // Teléfono
            $table->string('area')->nullable(); // Área de trabajo
            $table->string('position')->nullable(); // Cargo
            $table->enum('role', ['sectorista', 'operario', 'supervisor'])->default('sectorista'); // Rol
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->foreignId('registered_by')->nullable()->constrained('users')->onDelete('set null'); // Usuario de TI que registró
            $table->timestamp('registered_at')->nullable(); // Fecha de alta en el sistema
            $table->text('notes')->nullable(); // Observaciones
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sectoristas');
    }
};
