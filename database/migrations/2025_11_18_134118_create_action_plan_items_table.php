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
        Schema::create('action_plan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('action_plan_id')->constrained('action_plans')->onDelete('cascade');
            $table->string('action_name');
            $table->text('description')->nullable();
            $table->string('responsible')->nullable();
            $table->date('due_date')->nullable();
            $table->enum('status', ['pendiente', 'en_proceso', 'completado'])->default('pendiente');
            $table->text('comments')->nullable();
            $table->json('attachments')->nullable(); // Array de archivos adjuntos
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_plan_items');
    }
};
