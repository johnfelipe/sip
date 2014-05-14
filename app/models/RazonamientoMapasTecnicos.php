<?php

class RazonamientoMapasTecnicos extends Eloquent {
	protected $guarded = array();
	protected $table = 'raz_mapastecnicos';
	public static $rules = array();

	public function evaluaciones(){
        return $this->hasMany('Evaluaciones', 'id_evaluacion');
    }
}
