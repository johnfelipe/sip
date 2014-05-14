<?php

class EvaluacionesMapasTecnicos extends Eloquent {
	protected $guarded = array();
	protected $table = 'evaluaciones_mapastecnicos';
	public static $rules = array();

	public function evaluaciones(){
        return $this->hasMany('Evaluaciones', 'id_evaluacion');
    }

    public function codigos_evaluaciones(){
        return $this->hasMany('CodigosEvaluaciones', 'id_codigo_evaluacion');
    }
}
