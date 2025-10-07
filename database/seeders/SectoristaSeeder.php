<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sectorista;

class SectoristaSeeder extends Seeder
{
    /**
     * Seed the application's database with sample sectoristas.
     */
    public function run(): void
    {
        $sectoristas = [
            [
                'name' => 'Juan Pérez García',
                'position' => 'Operario Senior',
                'email' => 'juan.perez@simpac.gob.pe',
                'phone' => '+51 987654321',
                'status' => 'active',
            ],
            [
                'name' => 'María González López',
                'position' => 'Operaria de Campo',
                'email' => 'maria.gonzalez@simpac.gob.pe',
                'phone' => '+51 987654322',
                'status' => 'active',
            ],
            [
                'name' => 'Carlos Rodríguez Sánchez',
                'position' => 'Coordinador de Sector',
                'email' => 'carlos.rodriguez@simpac.gob.pe',
                'phone' => '+51 987654323',
                'status' => 'active',
            ],
            [
                'name' => 'Ana Martínez Torres',
                'position' => 'Operaria Junior',
                'email' => 'ana.martinez@simpac.gob.pe',
                'phone' => '+51 987654324',
                'status' => 'active',
            ],
            [
                'name' => 'Luis Fernández Díaz',
                'position' => 'Supervisor de Sector',
                'email' => 'luis.fernandez@simpac.gob.pe',
                'phone' => '+51 987654325',
                'status' => 'active',
            ],
            [
                'name' => 'Rosa Quispe Huamán',
                'position' => 'Operaria de Campo',
                'email' => 'rosa.quispe@simpac.gob.pe',
                'phone' => '+51 987654326',
                'status' => 'active',
            ],
            [
                'name' => 'Pedro Vargas Mendoza',
                'position' => 'Operario Senior',
                'email' => 'pedro.vargas@simpac.gob.pe',
                'phone' => '+51 987654327',
                'status' => 'active',
            ],
            [
                'name' => 'Carmen Flores Rojas',
                'position' => 'Coordinadora Regional',
                'email' => 'carmen.flores@simpac.gob.pe',
                'phone' => '+51 987654328',
                'status' => 'active',
            ],
        ];

        foreach ($sectoristas as $sectorista) {
            Sectorista::create($sectorista);
        }
    }
}
