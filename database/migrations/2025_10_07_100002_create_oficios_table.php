<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('oficios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_assignment_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['solicitud', 'reiteracion'])->default('solicitud');
            $table->string('subject');
            $table->text('description')->nullable();
            $table->date('deadline_date');
            $table->date('issue_date');
            $table->string('oficio_number')->nullable();
            $table->enum('status', ['pendiente', 'cumplido', 'vencido'])->default('pendiente');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oficios');
    }
};
