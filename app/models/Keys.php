<?php

class Keys extends Eloquent {
	protected $guarded = array();
	protected $table = 'keys';
	public static $rules = array();

	public function evaluaciones(){
        return $this->hasMany('Evaluaciones', 'id_evaluacion');
    }
}
