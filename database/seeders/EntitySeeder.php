<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entity;

class EntitySeeder extends Seeder
{
    public function run(): void
    {
        $entities = [
            // Ministerios
            ['name' => 'Ministerio de Economía y Finanzas', 'type' => 'ministerio', 'sector' => 'Economía', 'status' => 'active'],
            ['name' => 'Ministerio de Educación', 'type' => 'ministerio', 'sector' => 'Educación', 'status' => 'active'],
            ['name' => 'Ministerio de Salud', 'type' => 'ministerio', 'sector' => 'Salud', 'status' => 'active'],
            ['name' => 'Ministerio del Interior', 'type' => 'ministerio', 'sector' => 'Interior', 'status' => 'active'],
            ['name' => 'Ministerio de Defensa', 'type' => 'ministerio', 'sector' => 'Defensa', 'status' => 'active'],
            ['name' => 'Ministerio de Justicia', 'type' => 'ministerio', 'sector' => 'Justicia', 'status' => 'active'],
            ['name' => 'Ministerio de Trabajo', 'type' => 'ministerio', 'sector' => 'Trabajo', 'status' => 'active'],
            ['name' => 'Ministerio de Agricultura', 'type' => 'ministerio', 'sector' => 'Agricultura', 'status' => 'active'],
            
            // Organismos Públicos
            ['name' => 'SUNAT', 'type' => 'organismo_publico', 'sector' => 'Economía', 'status' => 'active'],
            ['name' => 'RENIEC', 'type' => 'organismo_publico', 'sector' => 'Registros', 'status' => 'active'],
            ['name' => 'INDECOPI', 'type' => 'organismo_publico', 'sector' => 'Competencia', 'status' => 'active'],
            ['name' => 'OSINERGMIN', 'type' => 'organismo_publico', 'sector' => 'Energía', 'status' => 'active'],
            ['name' => 'OSIPTEL', 'type' => 'organismo_publico', 'sector' => 'Telecomunicaciones', 'status' => 'active'],
            ['name' => 'SUNASS', 'type' => 'organismo_publico', 'sector' => 'Saneamiento', 'status' => 'active'],
            
            // Gobiernos Regionales (algunos ejemplos)
            ['name' => 'Gobierno Regional de Lima', 'type' => 'gobierno_regional', 'sector' => 'Regional', 'status' => 'active'],
            ['name' => 'Gobierno Regional del Callao', 'type' => 'gobierno_regional', 'sector' => 'Regional', 'status' => 'active'],
            ['name' => 'Gobierno Regional de Arequipa', 'type' => 'gobierno_regional', 'sector' => 'Regional', 'status' => 'active'],
            ['name' => 'Gobierno Regional de Cusco', 'type' => 'gobierno_regional', 'sector' => 'Regional', 'status' => 'active'],
            ['name' => 'Gobierno Regional de Piura', 'type' => 'gobierno_regional', 'sector' => 'Regional', 'status' => 'active'],
            ['name' => 'Gobierno Regional de La Libertad', 'type' => 'gobierno_regional', 'sector' => 'Regional', 'status' => 'active'],
            
            // Gobiernos Locales (ejemplos de municipalidades)
            ['name' => 'Municipalidad Metropolitana de Lima', 'type' => 'gobierno_local', 'sector' => 'Local', 'status' => 'active'],
            ['name' => 'Municipalidad Provincial del Callao', 'type' => 'gobierno_local', 'sector' => 'Local', 'status' => 'active'],
            ['name' => 'Municipalidad de Miraflores', 'type' => 'gobierno_local', 'sector' => 'Local', 'status' => 'active'],
            ['name' => 'Municipalidad de San Isidro', 'type' => 'gobierno_local', 'sector' => 'Local', 'status' => 'active'],
            ['name' => 'Municipalidad de Surco', 'type' => 'gobierno_local', 'sector' => 'Local', 'status' => 'active'],
            
            // Empresas Públicas
            ['name' => 'SEDAPAL', 'type' => 'empresa_publica', 'sector' => 'Saneamiento', 'status' => 'active'],
            ['name' => 'Electroperú', 'type' => 'empresa_publica', 'sector' => 'Energía', 'status' => 'active'],
            ['name' => 'PETROPERU', 'type' => 'empresa_publica', 'sector' => 'Energía', 'status' => 'active'],
        ];

        foreach ($entities as $entity) {
            Entity::create($entity);
        }
    }
}
