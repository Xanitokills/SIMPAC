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
        Schema::table('meetings', function (Blueprint $table) {
            // Campos para reuniones de coordinación en fase de ejecución
            $table->string('meeting_type')->default('general')->after('status'); // general, coordination, induction
            $table->json('components')->nullable()->after('meeting_type'); // componentes a tratar
            $table->text('agenda')->nullable()->after('notes');
            $table->dateTime('actual_date')->nullable()->after('scheduled_date');
            $table->text('attendees')->nullable();
            $table->text('minutes')->nullable(); // acta de reunión
            $table->boolean('proposal_presented')->default(false);
            $table->string('proposal_document_path')->nullable();
            $table->text('agreements_reached')->nullable();
            $table->text('cancellation_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->dropColumn([
                'meeting_type',
                'components',
                'agenda',
                'actual_date',
                'attendees',
                'minutes',
                'proposal_presented',
                'proposal_document_path',
                'agreements_reached',
                'cancellation_reason',
            ]);
        });
    }
};
