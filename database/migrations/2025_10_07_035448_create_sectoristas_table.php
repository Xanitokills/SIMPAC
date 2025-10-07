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
            $table->string('employee_code')->unique()->nullable(); // Código de empleado (desde Active Directory)
            $table->string('name'); // Nombre completo
            $table->string('email')->unique(); // Correo electrónico (desde Active Directory)
            $table->string('phone')->nullable(); // Teléfono
            $table->string('department')->nullable(); // Departamento/Área de trabajo
            $table->string('position')->nullable(); // Cargo
            $table->enum('status', ['active', 'inactive'])->default('active');
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
