<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Sectorista;

class LinkUsersSectoristas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:link-sectoristas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vincula usuarios con rol sectorista a sus registros en la tabla sectoristas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔗 Vinculando usuarios con sectoristas...');
        $this->newLine();

        // Obtener todos los sectoristas
        $sectoristas = Sectorista::all();
        
        if ($sectoristas->isEmpty()) {
            $this->error('❌ No hay sectoristas en la base de datos.');
            return 1;
        }

        $this->info("📊 Encontrados {$sectoristas->count()} sectoristas");
        $this->newLine();

        $vinculados = 0;
        $creados = 0;

        foreach ($sectoristas as $sectorista) {
            // Buscar usuario por nombre similar
            $user = User::where('name', $sectorista->name)
                        ->where('role', 'sectorista')
                        ->first();

            if ($user) {
                // Vincular usuario existente
                $user->sectorista_id = $sectorista->id;
                $user->save();
                $vinculados++;
                $this->info("✅ Vinculado: {$user->name} -> Sectorista ID: {$sectorista->id}");
            } else {
                // Crear nuevo usuario para este sectorista
                $email = $this->generateEmail($sectorista->name);
                $newUser = User::create([
                    'name' => $sectorista->name,
                    'email' => $email,
                    'password' => bcrypt('sectorista123'),
                    'role' => 'sectorista',
                    'sectorista_id' => $sectorista->id,
                ]);
                $creados++;
                $this->info("➕ Creado: {$newUser->name} ({$email}) -> Sectorista ID: {$sectorista->id}");
            }
        }

        $this->newLine();
        $this->info("✨ Proceso completado:");
        $this->info("   - Usuarios vinculados: {$vinculados}");
        $this->info("   - Usuarios creados: {$creados}");
        $this->newLine();
        $this->info("🔐 Contraseña para todos los sectoristas: sectorista123");

        return 0;
    }

    /**
     * Generate email from name
     */
    private function generateEmail($name)
    {
        // Convertir nombre a email
        $email = strtolower($name);
        $email = str_replace(['á', 'é', 'í', 'ó', 'ú'], ['a', 'e', 'i', 'o', 'u'], $email);
        $email = str_replace(' ', '.', $email);
        $email = preg_replace('/[^a-z0-9.]/', '', $email);
        $email .= '@simpac.com';
        
        // Verificar si ya existe
        $count = 1;
        $originalEmail = $email;
        while (User::where('email', $email)->exists()) {
            $email = str_replace('@simpac.com', $count . '@simpac.com', $originalEmail);
            $count++;
        }
        
        return $email;
    }
}
