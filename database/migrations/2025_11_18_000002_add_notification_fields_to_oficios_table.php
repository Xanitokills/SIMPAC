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
        Schema::table('oficios', function (Blueprint $table) {
            // Verificar y agregar solo los campos que no existen
            if (!Schema::hasColumn('oficios', 'notification_status')) {
                $table->string('notification_status')->default('pending')->after('status');
            }
            
            if (!Schema::hasColumn('oficios', 'notification_count')) {
                $table->integer('notification_count')->default(0);
            }
            
            if (!Schema::hasColumn('oficios', 'last_notification_date')) {
                $table->dateTime('last_notification_date')->nullable();
            }
            
            if (!Schema::hasColumn('oficios', 'last_notification_type')) {
                $table->string('last_notification_type')->nullable();
            }
            
            if (!Schema::hasColumn('oficios', 'notification_message')) {
                $table->text('notification_message')->nullable();
            }
            
            if (!Schema::hasColumn('oficios', 'notification_evidence')) {
                $table->json('notification_evidence')->nullable();
            }
            
            if (!Schema::hasColumn('oficios', 'deadline_date')) {
                $table->date('deadline_date')->nullable();
            }
            
            if (!Schema::hasColumn('oficios', 'response_received_date')) {
                $table->dateTime('response_received_date')->nullable();
            }
            
            if (!Schema::hasColumn('oficios', 'response_summary')) {
                $table->text('response_summary')->nullable();
            }
            
            if (!Schema::hasColumn('oficios', 'response_documents')) {
                $table->json('response_documents')->nullable();
            }
            
            if (!Schema::hasColumn('oficios', 'status_note')) {
                $table->text('status_note')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('oficios', function (Blueprint $table) {
            $table->dropColumn([
                'notification_status',
                'notification_count',
                'last_notification_date',
                'last_notification_type',
                'notification_message',
                'notification_evidence',
                'deadline_date',
                'response_received_date',
                'response_summary',
                'response_documents',
                'status_note',
            ]);
        });
    }
};
