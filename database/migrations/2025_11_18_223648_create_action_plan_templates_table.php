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
        Schema::create('action_plan_templates', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20); // 1.1.1, 1.2.1, etc.
            $table->string('name');
            $table->text('description');
            $table->string('default_responsible')->nullable();
            $table->string('predecessor_action', 100)->nullable();
            $table->integer('default_business_days')->default(1);
            $table->string('section')->nullable(); // Ej: "1.1 - Aprobación del plan"
            $table->integer('order')->default(0);
            $table->timestamps();
            
            $table->unique('code');
            $table->index('section');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_plan_templates');
    }
};
