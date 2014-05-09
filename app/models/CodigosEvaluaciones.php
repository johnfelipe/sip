<?php

class CodigosEvaluaciones extends Eloquent {
	protected $guarded = array();
	protected $table = 'codigos_evaluaciones';
	public static $rules = array();

	public function evaluaciones(){
        return $this->hasMany('Evaluaciones', 'id_codigo_evaluacion');
    }
}
