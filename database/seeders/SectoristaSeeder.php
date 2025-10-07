<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sectorista;

class SectoristaSeeder extends Seeder
{
    public function run(): void
    {
        $sectoristas = [
            [
                'name' => 'Juan Carlos Pérez García',
                'email' => 'jperez@pge.gob.pe',
                'phone' => '987654321',
                'status' => 'active',
            ],
            [
                'name' => 'María Elena Rodríguez López',
                'email' => 'mrodriguez@pge.gob.pe',
                'phone' => '987654322',
                'status' => 'active',
            ],
            [
                'name' => 'Carlos Alberto Mendoza Silva',
                'email' => 'cmendoza@pge.gob.pe',
                'phone' => '987654323',
                'status' => 'active',
            ],
            [
                'name' => 'Ana Patricia Torres Vargas',
                'email' => 'atorres@pge.gob.pe',
                'phone' => '987654324',
                'status' => 'active',
            ],
            [
                'name' => 'Luis Fernando Castillo Ramos',
                'email' => 'lcastillo@pge.gob.pe',
                'phone' => '987654325',
                'status' => 'active',
            ],
            [
                'name' => 'Rosa María Flores Gutiérrez',
                'email' => 'rflores@pge.gob.pe',
                'phone' => '987654326',
                'status' => 'active',
            ],
            [
                'name' => 'Miguel Ángel Sánchez Díaz',
                'email' => 'msanchez@pge.gob.pe',
                'phone' => '987654327',
                'status' => 'active',
            ],
            [
                'name' => 'Carmen Julia Vega Morales',
                'email' => 'cvega@pge.gob.pe',
                'phone' => '987654328',
                'status' => 'active',
            ],
        ];

        foreach ($sectoristas as $sectorista) {
            Sectorista::create($sectorista);
        }
    }
}
