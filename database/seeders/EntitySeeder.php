<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entity;

class EntitySeeder extends Seeder
{
    /**
     * Seed the application's database with Peruvian state entities.
     */
    public function run(): void
    {
        $entities = [
            // Ministerios
            ['code' => 'PCM', 'name' => 'Presidencia del Consejo de Ministros', 'type' => 'ministerio'],
            ['code' => 'MINAGRI', 'name' => 'Ministerio de Desarrollo Agrario y Riego', 'type' => 'ministerio'],
            ['code' => 'MINAM', 'name' => 'Ministerio del Ambiente', 'type' => 'ministerio'],
            ['code' => 'MINCETUR', 'name' => 'Ministerio de Comercio Exterior y Turismo', 'type' => 'ministerio'],
            ['code' => 'MINEDU', 'name' => 'Ministerio de Educación', 'type' => 'ministerio'],
            ['code' => 'MINSA', 'name' => 'Ministerio de Salud', 'type' => 'ministerio'],
            ['code' => 'MTPE', 'name' => 'Ministerio de Trabajo y Promoción del Empleo', 'type' => 'ministerio'],
            ['code' => 'MININTER', 'name' => 'Ministerio del Interior', 'type' => 'ministerio'],
            ['code' => 'MINDEF', 'name' => 'Ministerio de Defensa', 'type' => 'ministerio'],
            ['code' => 'MEF', 'name' => 'Ministerio de Economía y Finanzas', 'type' => 'ministerio'],
            ['code' => 'MINJUS', 'name' => 'Ministerio de Justicia y Derechos Humanos', 'type' => 'ministerio'],
            ['code' => 'MINCUL', 'name' => 'Ministerio de Cultura', 'type' => 'ministerio'],
            ['code' => 'MIDIS', 'name' => 'Ministerio de Desarrollo e Inclusión Social', 'type' => 'ministerio'],
            ['code' => 'MIMP', 'name' => 'Ministerio de la Mujer y Poblaciones Vulnerables', 'type' => 'ministerio'],
            ['code' => 'PRODUCE', 'name' => 'Ministerio de la Producción', 'type' => 'ministerio'],
            ['code' => 'RREE', 'name' => 'Ministerio de Relaciones Exteriores', 'type' => 'ministerio'],
            ['code' => 'MTC', 'name' => 'Ministerio de Transportes y Comunicaciones', 'type' => 'ministerio'],
            ['code' => 'VIVIENDA', 'name' => 'Ministerio de Vivienda, Construcción y Saneamiento', 'type' => 'ministerio'],
            ['code' => 'MINEM', 'name' => 'Ministerio de Energía y Minas', 'type' => 'ministerio'],
            
            // Organismos Públicos
            ['code' => 'SUNAT', 'name' => 'Superintendencia Nacional de Aduanas y de Administración Tributaria', 'type' => 'organismo'],
            ['code' => 'ESSALUD', 'name' => 'Seguro Social de Salud', 'type' => 'organismo'],
            ['code' => 'SIS', 'name' => 'Seguro Integral de Salud', 'type' => 'organismo'],
            ['code' => 'SUNASS', 'name' => 'Superintendencia Nacional de Servicios de Saneamiento', 'type' => 'organismo'],
            ['code' => 'OSINERGMIN', 'name' => 'Organismo Supervisor de la Inversión en Energía y Minería', 'type' => 'organismo'],
            ['code' => 'OSIPTEL', 'name' => 'Organismo Supervisor de Inversión Privada en Telecomunicaciones', 'type' => 'organismo'],
            ['code' => 'INDECOPI', 'name' => 'Instituto Nacional de Defensa de la Competencia y de la Protección de la Propiedad Intelectual', 'type' => 'organismo'],
            ['code' => 'INEI', 'name' => 'Instituto Nacional de Estadística e Informática', 'type' => 'organismo'],
            ['code' => 'RENIEC', 'name' => 'Registro Nacional de Identificación y Estado Civil', 'type' => 'organismo'],
            ['code' => 'ONP', 'name' => 'Oficina de Normalización Previsional', 'type' => 'organismo'],
            ['code' => 'SBS', 'name' => 'Superintendencia de Banca, Seguros y AFP', 'type' => 'organismo'],
            ['code' => 'SUNARP', 'name' => 'Superintendencia Nacional de los Registros Públicos', 'type' => 'organismo'],
            ['code' => 'SERNANP', 'name' => 'Servicio Nacional de Áreas Naturales Protegidas', 'type' => 'organismo'],
            ['code' => 'SENAMHI', 'name' => 'Servicio Nacional de Meteorología e Hidrología', 'type' => 'organismo'],
            ['code' => 'SENASA', 'name' => 'Servicio Nacional de Sanidad Agraria', 'type' => 'organismo'],
            ['code' => 'MIGRACIONES', 'name' => 'Superintendencia Nacional de Migraciones', 'type' => 'organismo'],
            ['code' => 'PROINVERSION', 'name' => 'Agencia de Promoción de la Inversión Privada', 'type' => 'organismo'],
            ['code' => 'COFOPRI', 'name' => 'Organismo de Formalización de la Propiedad Informal', 'type' => 'organismo'],
            ['code' => 'AGRORURAL', 'name' => 'Programa de Desarrollo Productivo Agrario Rural', 'type' => 'organismo'],
            ['code' => 'INIA', 'name' => 'Instituto Nacional de Innovación Agraria', 'type' => 'organismo'],
            
            // Gobiernos Regionales (algunos ejemplos)
            ['code' => 'GORE-LIMA', 'name' => 'Gobierno Regional de Lima', 'type' => 'gobierno_regional'],
            ['code' => 'GORE-AREQUIPA', 'name' => 'Gobierno Regional de Arequipa', 'type' => 'gobierno_regional'],
            ['code' => 'GORE-CUSCO', 'name' => 'Gobierno Regional de Cusco', 'type' => 'gobierno_regional'],
            ['code' => 'GORE-PIURA', 'name' => 'Gobierno Regional de Piura', 'type' => 'gobierno_regional'],
            ['code' => 'GORE-LAMBAYEQUE', 'name' => 'Gobierno Regional de Lambayeque', 'type' => 'gobierno_regional'],
            ['code' => 'GORE-JUNIN', 'name' => 'Gobierno Regional de Junín', 'type' => 'gobierno_regional'],
            
            // Municipalidades importantes
            ['code' => 'MML', 'name' => 'Municipalidad Metropolitana de Lima', 'type' => 'municipalidad'],
            ['code' => 'MPA', 'name' => 'Municipalidad Provincial de Arequipa', 'type' => 'municipalidad'],
            ['code' => 'MPC', 'name' => 'Municipalidad Provincial del Cusco', 'type' => 'municipalidad'],
            ['code' => 'MPT', 'name' => 'Municipalidad Provincial de Trujillo', 'type' => 'municipalidad'],
        ];

        foreach ($entities as $entity) {
            Entity::create($entity);
        }
    }
}
