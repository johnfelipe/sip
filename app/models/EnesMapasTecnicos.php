<?php

class EnesMapasTecnicos extends Eloquent {
	protected $guarded = array();
	protected $table = 'enes_mapastecnicos';
	public static $rules = array();

	public function evaluaciones(){
        return $this->hasMany('Evaluaciones', 'id_evaluacion');
    }
}
