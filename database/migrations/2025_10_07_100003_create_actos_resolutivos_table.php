<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('actos_resolutivos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oficio_id')->constrained()->onDelete('cascade');
            $table->string('resolution_number');
            $table->date('resolution_date');
            $table->string('document_path');
            $table->text('notes')->nullable();
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actos_resolutivos');
    }
};
