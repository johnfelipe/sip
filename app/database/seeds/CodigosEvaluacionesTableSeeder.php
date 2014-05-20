<?php
class CodigosEvaluacionesTableSeeder extends Seeder {
public function run()
    {
        // !!! All existing users are deleted !!!
        DB::table('codigos_evaluaciones')->delete();

        CodigosEvaluaciones::create(array(
            'nombre'  => 'ENES',
            'mapa_tecnico' => 'enes_mapastecnicos',
            'respuestas' => 'enes_respuestas'
        ));

        CodigosEvaluaciones::create(array(
            'nombre'  => 'Quiero Ser Maestro - Razonamiento',
            'mapa_tecnico' => 'raz_mapastecnicos',
            'respuestas' => 'raz_respuestas'
        ));

         CodigosEvaluaciones::create(array(
            'nombre'  => 'Quiero Ser Maestro - Saberes Específicos',
            'mapa_tecnico' => 'sesp_mapastecnicos',
            'respuestas' => 'sesp_respuestas'
        ));

        CodigosEvaluaciones::create(array(
            'nombre'  => 'Ser Bachiller',
            'mapa_tecnico' => 'sbac_mapastecnicos',
            'respuestas' => 'sbac_respuestas'
        ));

        CodigosEvaluaciones::create(array(
            'nombre'  => 'Ser Estudiante',
            'mapa_tecnico' => 'sest_mapastecnicos',
            'respuestas' => 'sest_respuestas'
        ));

        CodigosEvaluaciones::create(array(
            'nombre'  => 'Ser Estudiante en la Mitad del Mundo',
            'mapa_tecnico' => 'smm_mapastecnicos',
            'respuestas' => 'smm_respuestas'
        ));       
    }
}