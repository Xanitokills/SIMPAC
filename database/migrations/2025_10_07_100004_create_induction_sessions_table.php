<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('induction_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_assignment_id')->constrained()->onDelete('cascade');
            $table->foreignId('acto_resolutivo_id')->nullable()->constrained('actos_resolutivos')->onDelete('set null');
            $table->string('subject');
            $table->dateTime('session_date');
            $table->string('meeting_link')->nullable();
            $table->text('guidelines')->nullable();
            $table->text('action_plan')->nullable();
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled');
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('induction_sessions');
    }
};
