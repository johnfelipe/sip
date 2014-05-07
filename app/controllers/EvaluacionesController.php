<?php
 
class EvaluacionesController extends BaseController {

	public function mostrarEvaluaciones()
    {
        $evaluaciones = Evaluaciones::all();
        
        // Con el método all() le estamos pidiendo al modelo de Evaluacion
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('evaluaciones.lista', array('evaluaciones' => $evaluaciones));
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos las evaluaciones
    }

    /**
     * Crear la nueva evaluacion
     */
    public function crearEvaluacion()
    {
    //Evaluaciones::create(Input::all());
    // el método create nos permite crear una nueva evaluacion en la base de datos, este método es proporcionado por Laravel
    // create recibe como parámetro un arreglo con datos de un modelo y los inserta automáticamente en la base de datos
    // en este caso el arreglo es la información que viene desde un formulario y la obtenemos con el metido Input::all()
 
    //return Redirect::to('evaluaciones');
    // el método redirect nos devuelve a la ruta de mostrar la lista de las evaluaciones


        // llamamos a la función de agregar vendedor en el modelo y le pasamos los datos del formulario
        $respuesta = Evaluaciones::agregarEvaluacion(Input::all());
        
        // Dependiendo de la respuesta del modelo
        // retornamos los mensajes de error con los datos viejos del formulario
        // o un mensaje de éxito de la operación
        if ($respuesta['error'] == true){
            return Redirect::to('evaluaciones')->withErrors($respuesta['mensaje'] )->withInput();
        }else{
            return Redirect::to('evaluaciones')->with('mensaje', $respuesta['mensaje']);
        }
 
    }
 
     /**
     * Ver usuario con id
     */
    public function verEvaluacion($id)
    {
    // en este método podemos observar como se recibe un parámetro llamado id
    // este es el id de la evaluacion que se desea buscar y se debe declarar en la ruta como un parámetro
    
        $evaluacion = Evaluaciones::find($id);
        // para buscar a la evaluacion utilizamos el metido find que nos proporciona Laravel
        // este método devuelve un objeto con toda la información que contiene una evaluacion
    
    return View::make('evaluaciones.ver', array('evaluacion' => $evaluacion));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function eliminarEvaluacion($id)
    {
        $evaluacion = Evaluaciones::find($id);
        $evaluacion->delete();
        return Redirect::to('evaluaciones');
    }

}