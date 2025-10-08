<?php

namespace App\Console\Commands;

use App\Models\Oficio;
use App\Models\MeetingAgreement;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CheckOverdueItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica y actualiza el estado de oficios y acuerdos vencidos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Verificando oficios y acuerdos vencidos...');

        // Verificar oficios
        $oficiosUpdated = 0;
        $oficios = Oficio::where('status', 'pendiente')
            ->where('deadline_date', '<', Carbon::now())
            ->get();

        foreach ($oficios as $oficio) {
            $oficio->update(['status' => 'vencido']);
            $oficiosUpdated++;
        }

        $this->info("✓ {$oficiosUpdated} oficios marcados como vencidos");

        // Verificar acuerdos
        $agreementsUpdated = 0;
        $agreements = MeetingAgreement::where('status', 'pendiente')
            ->where('deadline_date', '<', Carbon::now())
            ->get();

        foreach ($agreements as $agreement) {
            $agreement->update(['status' => 'vencido']);
            $agreementsUpdated++;
        }

        $this->info("✓ {$agreementsUpdated} acuerdos marcados como vencidos");

        $this->info('Proceso completado exitosamente.');

        return 0;
    }
}
