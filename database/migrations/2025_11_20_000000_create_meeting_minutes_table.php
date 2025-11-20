<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meeting_minutes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_assignment_id')->constrained()->onDelete('cascade');
            $table->string('minute_number');
            $table->date('date');
            $table->string('subject');
            $table->string('component')->nullable();
            $table->enum('status', ['firmado', 'falta_de_firma', 'proceso_de_firmas', 'proceso_de_firmas_pge'])->default('proceso_de_firmas');
            $table->string('pdf_path')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meeting_minutes');
    }
};
