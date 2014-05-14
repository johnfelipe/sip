<?php

class MitadDelMundoMapasTecnicos extends Eloquent {
	protected $guarded = array();
	protected $table = 'smm_mapastecnicos';
	public static $rules = array();

	public function evaluaciones(){
        return $this->hasMany('Evaluaciones', 'id_evaluacion');
    }
}
