<?php

class Evaluaciones extends Eloquent {
	protected $guarded = array();
	protected $table = 'evaluaciones';
	protected $fillable = array('nombre', 'descripcion');

	public static $rules = array();

	public static function agregarEvaluacion($input){
        // función que recibe como parámetro la información del formulario para crear la Evaluacion
        
        $respuesta = array();
        
        // Declaramos reglas para validar que el nombre y apellido sean obligatorios y de longitud maxima 100
        $reglas =  array(
            'nombre'  => array('required'),  
            'descripcion' => array('required'),
        );
                
        $validator = Validator::make($input, $reglas);
        
        // verificamos que los datos cumplan la validación
        if ($validator->fails()){
            
            // si no cumple las reglas se van a devolver los errores al controlador
            $respuesta['mensaje'] = $validator;
            $respuesta['error']   = true;
        }else{
        
            // en caso de cumplir las reglas se crea el objeto Evaluacion
            $evaluacion = static::create($input);        
            
            // se retorna un mensaje de éxito al controlador
            $respuesta['mensaje'] = 'Evaluacion creada exitosamente!';
            $respuesta['error']   = false;
            $respuesta['data']    = $evaluacion;
        }    
        
        return $respuesta;
  }
}
