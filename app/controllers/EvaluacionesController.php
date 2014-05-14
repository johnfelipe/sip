<?php
 
class EvaluacionesController extends BaseController {

	public function mostrarEvaluaciones()
    {
        $evaluaciones = Evaluaciones::all();
        $codigos_evaluaciones = CodigosEvaluaciones::all()->lists('nombre', 'id');
        $combobox = $codigos_evaluaciones;
        $selected = array();
        
        // Con el método all() le estamos pidiendo al modelo de Evaluacion
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('evaluaciones.lista', array('evaluaciones' => $evaluaciones), compact('combobox', 'selected'));
        
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
            return Redirect::to('evaluaciones');
        }
 
    }
 
     /**
     * Ver usuario con id
     */
    public function verEvaluacion($id)
    {
    // en este método podemos observar como se recibe un parámetro llamado id
    // este es el id de la evaluacion que se desea buscar y se debe declarar en la ruta como un parámetro
    
        $evaluacion = Evaluaciones::with('codigos_evaluaciones')->find($id);
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

    public function mapaTecnico()
    {
               
        $evaluaciones = DB::table('evaluaciones')->where('estado', '!=', '0')
                                                ->orderBy('estado')
                                                ->orderBy('nombre')
                                                ->get();

        $evaluacionesSinMapa = Evaluaciones::where('estado', '=', '0')->lists('nombre', 'id', 'id_codigo_evaluacion');        
        $combobox = $evaluacionesSinMapa;
        $selected = array();        
      
        return View::make('evaluaciones.mapa', array('evaluaciones' => $evaluaciones), compact('combobox', 'selected'));        
    }

    public function subirMapaTecnico()
    { 
        $file = Input::file('file'); // your file upload input field in the form should be named 'file'
        $destinationPath = 'uploads/';
        $id_evaluacion = Input::get('nombre');

        $evaluacion = Evaluaciones::find($id_evaluacion);
        $evaluacion->estado = 1;
        $evaluacion->save();

        $filename = $id_evaluacion."_".$file->getClientOriginalName();
        $extension =$file->getClientOriginalExtension(); //if you need extension of the file

          if($extension=='csv'){
            $uploadSuccess = Input::file('file')->move($destinationPath, $filename);
            if( $uploadSuccess ) {
              
              $evaluacionMapaTecnico = new EvaluacionesMapasTecnicos;
              $evaluacionMapaTecnico->id_evaluacion = $id_evaluacion;
              $evaluacionMapaTecnico->id_codigo_evaluacion = $evaluacion->id_codigo_evaluacion;
              $codigoEvaluacion = CodigosEvaluaciones::find($evaluacion->id_codigo_evaluacion);
              $evaluacionMapaTecnico->mapatecnico_tabla = $codigoEvaluacion->mapa_tecnico;
              $evaluacionMapaTecnico->mapatecnico_archivo = $filename;
              $evaluacionMapaTecnico->user_id = Auth::user()->id;
              $evaluacionMapaTecnico->save();

              //$name = $file->getClientOriginalName();

              $csv = $this->readCSV("uploads/".$filename,$filename);              

              foreach ($csv as $listings) {
                if($evaluacion->id_codigo_evaluacion==1){
                  $item = new EnesMapasTecnicos;
                  $item->id_evaluacion = $id_evaluacion;
                  $item->nivel = $listings[0];
                  $item->id_item = $listings[1];
                  $item->campo = $listings[2];
                  $item->funcion = $listings[3];
                  $item->respuesta_correcta = $listings[4];
                  $item->f55 = ($listings[5] == '' ? null : $listings[5]);
                  $item->f56 = ($listings[6] == '' ? null : $listings[6]);
                  $item->f57 = ($listings[7] == '' ? null : $listings[7]);
                  $item->f58 = ($listings[8] == '' ? null : $listings[8]);
                  $item->f59 = ($listings[9] == '' ? null : $listings[9]);
                  $item->f60 = ($listings[10] == '' ? null : $listings[10]);
                  $item->f61 = ($listings[11] == '' ? null : $listings[11]);
                  $item->f62 = ($listings[12] == '' ? null : $listings[12]);
                  $item->f63 = ($listings[13] == '' ? null : $listings[13]);
                  $item->f64 = ($listings[14] == '' ? null : $listings[14]);
                  $item->f65 = ($listings[15] == '' ? null : $listings[15]);
                  $item->f66 = ($listings[16] == '' ? null : $listings[16]);
                  $item->f67 = ($listings[17] == '' ? null : $listings[17]);
                  $item->f68 = ($listings[18] == '' ? null : $listings[18]);
                  $item->f69 = ($listings[19] == '' ? null : $listings[19]);
                  $item->f70 = ($listings[20] == '' ? null : $listings[20]);
                  $item->f71 = ($listings[21] == '' ? null : $listings[21]);
                  $item->f72 = ($listings[22] == '' ? null : $listings[22]);
                  $item->f73 = ($listings[23] == '' ? null : $listings[23]);
                  $item->f74 = ($listings[24] == '' ? null : $listings[24]);                   
                  }elseif($evaluacion->id_codigo_evaluacion==2){
                  $item = new RazonamientoMapasTecnicos;
                  $item->id_evaluacion = $id_evaluacion;
                  $item->nivel = $listings[0];
                  $item->id_item = $listings[1];
                  $item->campo = $listings[2];
                  $item->funcion = $listings[3];
                  $item->respuesta_correcta = $listings[4];
                  $item->f1 = ($listings[5] == '' ? null : $listings[5]);
                  $item->f2 = ($listings[6] == '' ? null : $listings[6]);
                  $item->f3 = ($listings[7] == '' ? null : $listings[7]);
                  $item->f4 = ($listings[8] == '' ? null : $listings[8]);
                  $item->f5 = ($listings[9] == '' ? null : $listings[9]);
                  $item->f6 = ($listings[10] == '' ? null : $listings[10]);
                  }elseif($evaluacion->id_codigo_evaluacion==6){
                  $item = new MitadDelMundoMapasTecnicos;
                  $item->id_evaluacion = $id_evaluacion;
                  $item->nivel = $listings[0];
                  $item->id_item = $listings[1];
                  $item->campo = $listings[2];
                  $item->funcion = $listings[3];
                  $item->respuesta_correcta = $listings[4];
                  $item->f1 = ($listings[5] == '' ? null : $listings[5]);
                  $item->f2 = ($listings[6] == '' ? null : $listings[6]);
                  }
                $item->save();                 
              }

              return Redirect::to('evaluaciones.mapa_tecnico'); // or do a redirect with some message that file was uploaded
              } else {
                return Response::json('error', 400);
              }    
            }
    }

    public function readCSV($csvFile,$name) {
        chmod("uploads/".$name, 0777);
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 1024);
        }
        fclose($file_handle);
        return $line_of_text;
    }

    public function generarKey($id)
    {
        $evaluacion = Evaluaciones::find($id);

        $select_mapaTecnico = DB::table('evaluaciones_mapastecnicos')
                        ->select('mapatecnico_tabla')
                        ->where('evaluaciones_mapastecnicos.id_evaluacion', '=', $id)
                        ->first();
        $mapaTecnico = $select_mapaTecnico->mapatecnico_tabla;
        $select = DB::select( DB::raw("SELECT e.id, v.version FROM evaluaciones e
                      LEFT JOIN versiones v ON e.id = v.id_evaluacion
                      WHERE e.id = :id_evaluacion"), 
                      array('id_evaluacion' => $id,
                      ));       
        foreach($select as $resultado){
          $version = (int)$resultado->version;
          $select1 = DB::select( DB::raw("SELECT e.id, n.nivel, v.version, f.forma 
                        FROM formas f, evaluaciones e, niveles n, versiones v
                        WHERE e.id = :id_evaluacion AND f.nivel = n.nivel AND f.version = v.version AND f.id_evaluacion = e.id
                        AND n.id_evaluacion = e.id AND v.id_evaluacion = e.id AND v.version = :version"), 
                  array('id_evaluacion' => $id,
                        'version' => $version,));
          foreach($select1 as $resultado1){
            $idEvaluacion = (int)$resultado1->id;
            $nivel = (int)$resultado1->nivel;
            $version = (int)$resultado1->version;
            $forma = (int)$resultado1->forma;            
            DB::statement( 'INSERT INTO keys (id_evaluacion, nivel, version, forma, created_at, updated_at) 
                VALUES (:id_evaluacion,:nivel,:version,:forma,now(),now())' , 
                  array('id_evaluacion' => $idEvaluacion,
                        'nivel' => $nivel,
                        'version' => $version,
                        'forma' => $forma,));
            }
            $select2 = DB::select( DB::raw("SELECT nivel FROM niveles WHERE id_evaluacion=:id_evaluacion"), 
                  array('id_evaluacion' => $id,
                    ));
            foreach ($select2 as $resultado2) {
              $nivel = (int)$resultado2->nivel;
              $select3 = DB::select( DB::raw("SELECT e.id, n.nivel, v.version, f.forma 
                        FROM formas f, evaluaciones e, niveles n, versiones v
                        WHERE e.id = :id_evaluacion AND f.nivel = n.nivel AND f.version = v.version AND f.id_evaluacion = e.id
                        AND n.id_evaluacion = e.id AND v.id_evaluacion = e.id AND n.nivel = :nivel"), 
                        array('id_evaluacion' => $id,
                        'nivel' => $nivel,));
              foreach ($select3 as $resultado3) {                
                $forma = (int)$resultado3->forma;
                $select4 = DB::select( DB::raw("SELECT f".$forma. " as posicion, respuesta_correcta, nivel
                                  FROM ".$mapaTecnico." WHERE nivel=".$nivel." AND f".$forma." IS NOT NULL 
                                  ORDER BY f".$forma), 
                            array());
                foreach ($select4 as $resultado4) {
                  //print $resultado4->posicion."-".$resultado4->respuesta_correcta."-".$resultado4->nivel."<br>";
                  $posicion = (int)$resultado4->posicion;
                  $rc = $resultado4->respuesta_correcta;
                  $nivel = (int)$resultado4->nivel;
                  DB::statement( "UPDATE keys SET p".$posicion."='".$rc."' WHERE nivel=$nivel AND forma=$forma" , 
                        array());
                  //print $posicion."-".$rc."-".$nivel."<br>";
                }
              }
            }
        }

      $evaluacion->estado = 2;
      $evaluacion->save();

      return Redirect::to('evaluaciones.mapa_tecnico');
            

    }

    public function descargarKey($id)
    {
        $evaluacion = Evaluaciones::find($id);
        $arr = DB::table('keys')
              ->where('id_evaluacion', '=', $id)
              ->orderBY('nivel')
              ->orderBY('version')
              ->orderBY('forma')
              ->get();
        $nombre = $evaluacion->nombre."_key.csv";        
        return CSV::fromArray($arr)->render($nombre);  //download as csv
    }
}