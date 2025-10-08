<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CleanTestData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:clean-test-data {--keep-users : Mantener usuarios del sistema}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Limpia datos de prueba manteniendo usuarios y roles del sistema';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧹 Limpiando datos de prueba...');
        $this->newLine();

        if (!$this->confirm('¿Estás seguro de limpiar los datos de prueba? (Los usuarios se mantendrán)', true)) {
            $this->info('Operación cancelada.');
            return 0;
        }

        DB::beginTransaction();

        try {
            // Deshabilitar verificación de foreign keys
            DB::statement('PRAGMA foreign_keys = OFF;');

            // Tablas a limpiar en orden (respetando foreign keys)
            $tablesToClean = [
                'induction_sessions' => '📚 Sesiones de Inducción',
                'actos_resolutivos' => '📄 Actos Resolutivos',
                'meeting_agreements' => '🤝 Acuerdos de Reuniones',
                'meeting_history' => '📜 Historial de Reuniones',
                'meetings' => '📅 Reuniones',
                'oficios' => '📋 Oficios',
                'entity_assignments' => '👥 Asignaciones de Entidades',
                'implementation_plans' => '📊 Planes de Implementación',
                'sectoristas' => '👔 Sectoristas',
                'entities' => '🏢 Entidades',
                'tasks' => '✅ Tareas',
                'team_members' => '👨‍💼 Miembros del Equipo',
                'projects' => '📁 Proyectos',
            ];

            foreach ($tablesToClean as $table => $description) {
                if (Schema::hasTable($table)) {
                    $count = DB::table($table)->count();
                    
                    // Usar delete en lugar de truncate para SQLite
                    DB::table($table)->delete();
                    
                    // Resetear el autoincrement
                    DB::statement("DELETE FROM sqlite_sequence WHERE name = '{$table}';");
                    
                    $this->line("  ✓ {$description}: {$count} registros eliminados");
                }
            }

            // Reactivar verificación de foreign keys
            DB::statement('PRAGMA foreign_keys = ON;');

            DB::commit();

            $this->newLine();
            $this->info('═══════════════════════════════════════════════════════');
            $this->info('✅ Datos de prueba eliminados exitosamente');
            $this->info('═══════════════════════════════════════════════════════');
            $this->newLine();
            $this->line('Los usuarios del sistema se mantienen intactos:');
            $this->line('  👑 admin@simpac.com');
            $this->line('  🎯 secretario@simpac.com');
            $this->line('  ⚖️  procurador@simpac.com');
            $this->line('  👥 sectorista@simpac.com');
            $this->line('  ◆ responsable@simpac.com');
            $this->line('  ◆ colegiado@simpac.com');
            $this->newLine();
            $this->comment('Para recargar datos de prueba ejecuta: php artisan db:seed --class=TestDataSeeder');
            $this->info('═══════════════════════════════════════════════════════');

            return 0;

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('❌ Error al limpiar datos: ' . $e->getMessage());
            return 1;
        }
    }
}
