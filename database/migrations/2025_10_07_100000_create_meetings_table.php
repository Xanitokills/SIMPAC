<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_assignment_id')->constrained()->onDelete('cascade');
            $table->string('contact_name');
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('subject');
            $table->dateTime('scheduled_date');
            $table->string('meeting_link')->nullable();
            $table->enum('status', ['scheduled', 'rescheduled', 'completed', 'cancelled'])->default('scheduled');
            $table->text('conclusion')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
