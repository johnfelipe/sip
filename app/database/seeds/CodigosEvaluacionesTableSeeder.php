<?php
class CodigosEvaluacionesTableSeeder extends Seeder {
public function run()
    {
        // !!! All existing users are deleted !!!
        DB::table('codigos_evaluaciones')->delete();

        CodigosEvaluaciones::create(array(
            'nombre'  => 'ENES',
            'mapa_tecnico' => 'enes_mapastecnicos'
        ));

        CodigosEvaluaciones::create(array(
            'nombre'  => 'Quiero Ser Maestro - Razonamiento',
            'mapa_tecnico' => 'raz_mapastecnicos'
        ));

         CodigosEvaluaciones::create(array(
            'nombre'  => 'Quiero Ser Maestro - Saberes Específicos',
            'mapa_tecnico' => 'sesp_mapastecnicos'
        ));

        CodigosEvaluaciones::create(array(
            'nombre'  => 'Ser Bachiller',
            'mapa_tecnico' => 'sbac_mapastecnicos'
        ));

        CodigosEvaluaciones::create(array(
            'nombre'  => 'Ser Estudiante',
            'mapa_tecnico' => 'sest_mapastecnicos'
        ));

        CodigosEvaluaciones::create(array(
            'nombre'  => 'Ser Estudiante en la Mitad del Mundo',
            'mapa_tecnico' => 'smm_mapastecnicos'
        ));       
    }
}