<?php
class CodigosEvaluacionesTableSeeder extends Seeder {
public function run()
    {
        // !!! All existing users are deleted !!!
        DB::table('codigos_evaluaciones')->delete();

        CodigosEvaluaciones::create(array(
            'nombre'  => 'ENES'
        ));

        CodigosEvaluaciones::create(array(
            'nombre'  => 'Quiero Ser Maestro - Razonamiento'
        ));

         CodigosEvaluaciones::create(array(
            'nombre'  => 'Quiero Ser Maestro - Saberes Específicos'
        ));

        CodigosEvaluaciones::create(array(
            'nombre'  => 'Ser Bachiller'
        ));

        CodigosEvaluaciones::create(array(
            'nombre'  => 'Ser Estudiante'
        ));

        CodigosEvaluaciones::create(array(
            'nombre'  => 'Ser Estudiante en la Mitad del Mundo'            
        ));       
    }
}