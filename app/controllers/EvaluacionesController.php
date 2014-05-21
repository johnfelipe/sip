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
                                                ->orderBy('id')
                                                ->orderBy('nombre')
                                                ->get();

        $evaluacionesSinMapa = Evaluaciones::where('estado', '=', '0')->lists('nombre', 'id', 'id_codigo_evaluacion');        
        $combobox = $evaluacionesSinMapa;
        $selected = array();        
      
        return View::make('evaluaciones.mapa', array('evaluaciones' => $evaluaciones), compact('combobox', 'selected'));        
    }

    public function subirMapaTecnico()
    { 
        $file = Input::file('file');
        $destinationPath = 'app/uploads/';
        $id_evaluacion = Input::get('nombre');
        $evaluacion = Evaluaciones::find($id_evaluacion);

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
              $csv = $this->readCSV("app/uploads/".$filename,$filename);              

              foreach ($csv as $listings) {
                if($evaluacion->id_codigo_evaluacion==1){
                  $item = new EnesMapasTecnicos;
                  $item->id_evaluacion = $id_evaluacion;
                  $item->nivel = $listings[0];
                  $item->id_item = $listings[1];
                  $item->campo = $listings[2];
                  $item->id_campo = $listings[3];
                  $item->funcion = $listings[4];
                  $item->respuesta_correcta = $listings[5];
                  $item->f55 = ($listings[6] == '' ? null : $listings[6]);
                  $item->f56 = ($listings[7] == '' ? null : $listings[7]);
                  $item->f57 = ($listings[8] == '' ? null : $listings[8]);
                  $item->f58 = ($listings[9] == '' ? null : $listings[9]);
                  $item->f59 = ($listings[10] == '' ? null : $listings[10]);
                  $item->f60 = ($listings[11] == '' ? null : $listings[11]);
                  $item->f61 = ($listings[12] == '' ? null : $listings[12]);
                  $item->f62 = ($listings[13] == '' ? null : $listings[13]);
                  $item->f63 = ($listings[14] == '' ? null : $listings[14]);
                  $item->f64 = ($listings[15] == '' ? null : $listings[15]);
                  $item->f65 = ($listings[16] == '' ? null : $listings[16]);
                  $item->f66 = ($listings[17] == '' ? null : $listings[17]);
                  $item->f67 = ($listings[18] == '' ? null : $listings[18]);
                  $item->f68 = ($listings[19] == '' ? null : $listings[19]);
                  $item->f69 = ($listings[20] == '' ? null : $listings[20]);
                  $item->f70 = ($listings[21] == '' ? null : $listings[21]);
                  $item->f71 = ($listings[22] == '' ? null : $listings[22]);
                  $item->f72 = ($listings[23] == '' ? null : $listings[23]);
                  $item->f73 = ($listings[24] == '' ? null : $listings[24]);
                  $item->f74 = ($listings[25] == '' ? null : $listings[25]);                   
                  }elseif($evaluacion->id_codigo_evaluacion==2){
                  $item = new RazonamientoMapasTecnicos;
                  $item->id_evaluacion = $id_evaluacion;
                  $item->nivel = $listings[0];
                  $item->id_item = $listings[1];
                  $item->campo = $listings[2];
                  $item->id_campo = $listings[3];
                  $item->funcion = $listings[4];
                  $item->respuesta_correcta = $listings[5];
                  $item->f1 = ($listings[6] == '' ? null : $listings[6]);
                  $item->f2 = ($listings[7] == '' ? null : $listings[7]);
                  $item->f3 = ($listings[8] == '' ? null : $listings[8]);
                  $item->f4 = ($listings[9] == '' ? null : $listings[9]);
                  $item->f5 = ($listings[10] == '' ? null : $listings[10]);
                  $item->f6 = ($listings[11] == '' ? null : $listings[11]);
                  }elseif($evaluacion->id_codigo_evaluacion==6){
                  $item = new MitadDelMundoMapasTecnicos;
                  $item->id_evaluacion = $id_evaluacion;
                  $item->nivel = $listings[0];
                  $item->id_item = $listings[1];
                  $item->campo = $listings[2];
                  $item->id_campo = $listings[3];
                  $item->funcion = $listings[4];
                  $item->respuesta_correcta = $listings[5];
                  $item->f1 = ($listings[6] == '' ? null : $listings[6]);
                  $item->f2 = ($listings[7] == '' ? null : $listings[7]);
                  }
                
                $item->save();                 
              }
              
              $evaluacion->estado = 1;
              $evaluacion->save();
              return Redirect::to('evaluaciones.mapa_tecnico')->with('success', 'Mapa Técnico cargado exitosamente'); // or do a redirect with some message that file was uploaded
              } else {
                return Redirect::to('evaluaciones.mapa_tecnico')->withErrors('Error en la carga ');
              }    
            }
    }

    public function readCSV($csvFile,$name) {
        chmod("app/uploads/".$name, 0777);
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
                  $posicion = (int)$resultado4->posicion;
                  $rc = $resultado4->respuesta_correcta;
                  $nivel = (int)$resultado4->nivel;
                  DB::statement( "UPDATE keys SET p".$posicion."='".$rc."' WHERE nivel=$nivel AND forma=$forma" , 
                        array());
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
        $nombre = $evaluacion->nombre."_".$id."_key.csv";        
        return CSV::fromArray($arr)->render($nombre);  //download as csv
    }

    public function mostrarCalificaciones()
    {
        $evaluaciones = Evaluaciones::where('estado','=', '3')
                                    ->orderBy('id')
                                    ->get();
        
        return View::make('calificaciones.lista', array('evaluaciones' => $evaluaciones));
        
    }

    public function viewSubirRespuestas()
    {
               
        $evaluaciones = DB::table('evaluaciones')->where('estado', '>=', '3')
                                                ->orderBy('estado')
                                                ->orderBy('nombre')
                                                ->get();

        $evaluacionesSinMapa = Evaluaciones::where('estado', '=', '2')->lists('nombre', 'id', 'id_codigo_evaluacion');        
        $combobox = $evaluacionesSinMapa;
        $selected = array();        
      
        return View::make('calificaciones.carga_archivo', array('evaluaciones' => $evaluaciones), compact('combobox', 'selected'));        
    }


    public function subirRespuestas()
    { 
        $file = Input::file('file');
        $destinationPath = 'app/uploads/';
        $id_evaluacion = Input::get('nombre');
        $evaluacion = Evaluaciones::find($id_evaluacion);
        $codigoEvaluacion = CodigosEvaluaciones::find($evaluacion->id_codigo_evaluacion);

        $filename = $id_evaluacion."_Respuestas_".$file->getClientOriginalName();
        $extension =$file->getClientOriginalExtension(); //if you need extension of the file

          if($extension=='csv'){
            $uploadSuccess = Input::file('file')->move($destinationPath, $filename);
            if( $uploadSuccess ) {              
              $evaluacionRespuesta = new EvaluacionesRespuestas;
              $evaluacionRespuesta->id_evaluacion = $id_evaluacion;
              $evaluacionRespuesta->respuestas_archivo = $filename;
              $evaluacionRespuesta->user_id = Auth::user()->id;
              $tablaRespuestas = $codigoEvaluacion->respuestas;
              $csv = $this->readCSV("app/uploads/".$filename,$filename);
              if($evaluacion->id_codigo_evaluacion==1){
                $p = "";
                for($i=1;$i<=120;$i++){
                      //$j = $i+3;
                      $p .= "p".$i.",";
                      //$item->$p = $listings[$j];
                    }
                $p = rtrim($p, ',');                
                #open file
                if(false !== ($handle = fopen("app/uploads/".$filename, 'r'))){
                  #for every line in the csv file
                  while(false !== ($line = fgetcsv($handle, 0, ',', '"'))){
                  $query = "INSERT INTO enes_respuestas (id_evaluacion, clip, nivel, version, forma, $p, created_at, updated_at)VALUES";
                  #append to the base sql string the record in sql format
                    $query .= sprintf(
                      "('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
                        '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
                        '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
                        '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
                        '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
                        '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
                        '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s','%s', '%s', '%s', '%s', '%s', '%s', '%s', now(), now()),",
                      $id_evaluacion,
                      $line[0],$line[1],$line[2],$line[3],$line[4],$line[5],$line[6],$line[7],$line[8],$line[9],$line[10],
                      $line[11],$line[12],$line[13],$line[14],$line[15],$line[16],$line[17],$line[18],$line[19],$line[20],
                      $line[21],$line[22],$line[23],$line[24],$line[25],$line[26],$line[27],$line[28],$line[29],$line[30],
                      $line[31],$line[32],$line[33],$line[34],$line[35],$line[36],$line[37],$line[38],$line[39],$line[40],                      
                      $line[41],$line[42],$line[43],$line[44],$line[45],$line[46],$line[47],$line[48],$line[49],$line[50],
                      $line[51],$line[52],$line[53],$line[54],$line[55],$line[56],$line[57],$line[58],$line[59],$line[60],
                      $line[61],$line[62],$line[63],$line[64],$line[65],$line[66],$line[67],$line[68],$line[69],$line[70],
                      $line[71],$line[72],$line[73],$line[74],$line[75],$line[76],$line[77],$line[78],$line[79],$line[80],
                      $line[81],$line[82],$line[83],$line[84],$line[85],$line[86],$line[87],$line[88],$line[89],$line[90],
                      $line[91],$line[92],$line[93],$line[94],$line[95],$line[96],$line[97],$line[98],$line[99],$line[100],
                      $line[101],$line[102],$line[103],$line[104],$line[105],$line[106],$line[107],$line[108],$line[109],$line[110],
                      $line[111],$line[112],$line[113],$line[114],$line[115],$line[116],$line[117],$line[118],$line[119],$line[120],
                      $line[121],$line[122],$line[123]
                      );
                  $query = rtrim($query, ',');
                  DB::statement( $query);
                  }
                }
              }else{
                foreach ($csv as $listings) {
                  $item = new Respuestas;
                  $item->id_evaluacion = $id_evaluacion;
                  $item->clip = $listings[0];
                  $item->nivel = $listings[1];
                  $item->version = $listings[2];
                  $item->forma = $listings[3];
                  $item->aciertos = $listings[4];
                  $item->indice = $listings[5];
                  $item->orden = $listings[6];
                  $item->respuesta = $listings[7];
                  $item->estado = $listings[8];               
                  $item->save();                 
                }
                DB::statement( "INSERT INTO $tablaRespuestas (id_evaluacion,clip,nivel,version,forma,created_at,updated_at)
                     SELECT DISTINCT id_evaluacion,clip, nivel,version,forma,now(),now() FROM respuestas WHERE id_evaluacion=:id_evaluacion" , 
                          array('id_evaluacion' => $id_evaluacion,));              
                $select = DB::select( DB::raw("SELECT MAX(orden) AS columnas FROM respuestas WHERE id_evaluacion=:id_evaluacion"), 
                    array('id_evaluacion' => $id_evaluacion,));
                $totalPreguntas = $select[0]->columnas;
                for($i=1;$i<=$totalPreguntas;$i++){
                  DB::statement( "UPDATE $tablaRespuestas SET p$i = respuestas.respuesta FROM respuestas
                          WHERE respuestas.clip = $tablaRespuestas.clip AND respuestas.orden=$i AND 
                          $tablaRespuestas.id_evaluacion = respuestas.id_evaluacion AND respuestas.id_evaluacion = :id_evaluacion" , 
                          array('id_evaluacion' => $id_evaluacion,));
                  DB::statement( "UPDATE $tablaRespuestas SET p$i=UPPER(p$i)" , 
                          array());
                }        
              }                
              

              $tablaRespuestasbk = $tablaRespuestas."bk";
              if($evaluacion->id_codigo_evaluacion==1)
                DB::statement( "INSERT INTO $tablaRespuestasbk
                                SELECT id,id_evaluacion,clip,nivel,version,forma,p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,p11,p12,p13,
                                p14,p15,p16,p17,p18,p19,p20,p21,p22,p23,p24,p25,p26,p27,p28,p29,p30,p31,p32,p33,p34,p35,p36,
                                p37,p38,p39,p40,p41,p42,p43,p44,p45,p46,p47,p48,p49,p50,p51,p52,p53,p54,p55,p56,p57,p58,p59,
                                p60,p61,p62,p63,p64,p65,p66,p67,p68,p69,p70,p71,p72,p73,p74,p75,p76,p77,p78,p79,p80,p81,p82,
                                p83,p84,p85,p86,p87,p88,p89,p90,p91,p92,p93,p94,p95,p96,p97,p98,p99,p100,p101,p102,p103,p104,
                                p105,p106,p107,p108,p109,p110,p111,p112,p113,p114,p115,p116,p117,p118,p119,p120,created_at,updated_at
                                FROM $tablaRespuestas WHERE id_evaluacion=:id_evaluacion" , 
                                array('id_evaluacion' => $id_evaluacion,));
              elseif($evaluacion->id_codigo_evaluacion==2 || $evaluacion->id_codigo_evaluacion==6)
                DB::statement( "INSERT INTO $tablaRespuestasbk
                                SELECT id,id_evaluacion,clip,nivel,version,forma,p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,p11,p12,p13,
                                p14,p15,p16,p17,p18,p19,p20,p21,p22,p23,p24,p25,p26,p27,p28,p29,p30,p31,p32,p33,p34,p35,p36,
                                p37,p38,p39,p40,p41,p42,p43,p44,p45,p46,p47,p48,p49,p50,p51,p52,p53,p54,p55,p56,p57,p58,p59,
                                p60,p61,p62,p63,p64,p65,p66,p67,p68,p69,p70,p71,p72,p73,p74,p75,p76,p77,p78,p79,p80,p81,p82,
                                p83,p84,p85,p86,p87,p88,created_at,updated_at
                                FROM $tablaRespuestas WHERE id_evaluacion=:id_evaluacion" , 
                                array('id_evaluacion' => $id_evaluacion,));
              $evaluacion->estado = 3;
              $evaluacionRespuesta->save();
              $evaluacion->save();
              return Redirect::to('calificacion.subir_respuestas')->with('success', 'Respuestas subidas exitosamente'); // or do a redirect with some message that file was uploaded
              } else {
                return Response::json('error', 400);
              }    
            }
    }

    public function calificar($id)
    {
      $evaluacion = Evaluaciones::find($id);
      $codigoEvaluacion = CodigosEvaluaciones::find($evaluacion->id_codigo_evaluacion);
      $tablaRespuestas = $codigoEvaluacion->respuestas;
      $mapaTecnico = $codigoEvaluacion->mapa_tecnico;

      $select = DB::select( DB::raw("SELECT MAX(preguntas) as total FROM niveles WHERE id_evaluacion=:id_evaluacion"), 
                  array('id_evaluacion' => $id,));
      $total = $select[0]->total;
      for($i=1;$i<=$total;$i++){
        DB::statement( "INSERT INTO resultados_temp (id_evaluacion,clip, nivel, version, forma, respuesta, correcta, created_at,updated_at)
                          SELECT '$id',a.clip, a.nivel, a.version, a.forma, a.p".$i.", b.p".$i.", now(), now()
                          FROM $tablaRespuestas a, keys b WHERE b.id_evaluacion = :id_evaluacion AND a.nivel = b.nivel AND
                          a.version = b.version AND a.forma = b.forma AND a.id_evaluacion = b.id_evaluacion" , 
                          array('id_evaluacion' => $id,));
        DB::statement("UPDATE resultados_temp SET posicion=1 WHERE respuesta=correcta AND id_evaluacion = :id_evaluacion" ,
                          array('id_evaluacion' => $id,));
        DB::statement("UPDATE resultados_temp SET posicion=0 WHERE respuesta<>correcta OR respuesta is null AND id_evaluacion = :id_evaluacion" ,
                          array('id_evaluacion' => $id,));
        DB::statement("UPDATE $tablaRespuestas SET p".$i." = resultados_temp.posicion FROM resultados_temp
                          WHERE $tablaRespuestas.clip = resultados_temp.clip AND $tablaRespuestas.id_evaluacion = :id_evaluacion" ,
                          array('id_evaluacion' => $id,));
        DB::statement("DELETE FROM resultados_temp");
      } 
      $evaluacion->estado = 4;
      $evaluacion->save();
      return Redirect::to('calificacion.subir_respuestas');
    }

    public function calculoIneval($id){

      $evaluacion = Evaluaciones::find($id);
      $codigoEvaluacion = CodigosEvaluaciones::find($evaluacion->id_codigo_evaluacion);
      $tablaRespuestas = $codigoEvaluacion->respuestas;
      $mapaTecnico = $codigoEvaluacion->mapa_tecnico;

      Helper::posicionTemp($id,$mapaTecnico);
      $select1 = DB::select( DB::raw("SELECT DISTINCT id_campo FROM $mapaTecnico WHERE id_evaluacion = :id_evaluacion 
                                      ORDER BY id_campo"), 
                                      array('id_evaluacion' => $id,));
      $columnasCP = "";
      $columnasSP = "";
      foreach ($select1 as $result1) {
        $columnasCP .="total_".strtolower($result1->id_campo)."_con_piloto+";
        $columnasSP .="total_".strtolower($result1->id_campo)."_sin_piloto+";
      }
      $select2 = DB::select( DB::raw("SELECT DISTINCT nivel, id_campo FROM $mapaTecnico WHERE id_evaluacion = :id_evaluacion 
                                      ORDER BY id_campo"), 
                                      array('id_evaluacion' => $id,));
      foreach ($select2 as $result2) {
        $nivel = (int)$result2->nivel;
        $select2 = DB::select( DB::raw("SELECT forma FROM formas f
                                      LEFT JOIN niveles n ON f.nivel = n.nivel
                                      LEFT JOIN evaluaciones e ON n.id_evaluacion = e.id
                                      WHERE e.id = :id_evaluacion AND n.nivel = :nivel AND f.id_evaluacion = e.id LIMIT 1"), 
                                      array('id_evaluacion' => $id,
                                            'nivel' => $nivel,));
        $forma = (int)$select2[0]->forma;
        $idCampo = $result2->id_campo;
        $select3 = DB::select( DB::raw("SELECT * FROM posicionestemp WHERE nivel=:nivel AND forma=:forma AND
                                  id_campo = :id_campo"), 
                                      array('nivel' => $nivel,
                                            'forma' => $forma,
                                            'id_campo' => $idCampo,));
        $camposPiloto = "";
        $camposSinPiloto = "";
        foreach ($select3 as $result3) {
          $camposPiloto .="CAST (p".$result3->posicion." AS INTEGER)+";
          if($result3->funcion!='Piloto')
            $camposSinPiloto .="CAST (p".$result3->posicion." AS INTEGER)+";
        }
        $camposPiloto = trim($camposPiloto, '+');
        $camposSinPiloto = trim($camposSinPiloto, '+');
        DB::statement("UPDATE $tablaRespuestas SET total_".strtolower($result2->id_campo)."_con_piloto = $camposPiloto 
                    WHERE nivel=:nivel AND id_evaluacion = :id_evaluacion" ,
                        array('id_evaluacion' => $id,                              
                              'nivel' => $nivel,));
        DB::statement("UPDATE $tablaRespuestas SET total_".strtolower($result2->id_campo)."_sin_piloto = $camposSinPiloto 
                    WHERE nivel=:nivel AND id_evaluacion = :id_evaluacion" ,
                        array('id_evaluacion' => $id,                              
                              'nivel' => $nivel,));
      }
      $columnasCP = trim($columnasCP, '+');
      $columnasSP = trim($columnasSP, '+');
      DB::statement("UPDATE $tablaRespuestas SET total_con_piloto = $columnasCP" ,
                        array());
      DB::statement("UPDATE $tablaRespuestas SET total_sin_piloto = $columnasSP" ,
                        array());
      DB::statement("DROP TABLE posicionestemp");

      $select4 = DB::select( DB::raw("SELECT nivel,preguntas,preguntas_operativas FROM niveles WHERE id_evaluacion=:id_evaluacion"), 
                  array('id_evaluacion' => $id,));
      foreach ($select4 as $result4) {
        $nivel = (int)$result4->nivel;
        $preguntas = (int)$result4->preguntas;
        $preguntasOperativas = (int)$result4->preguntas_operativas;

        DB::statement("UPDATE $tablaRespuestas SET inev_con_piloto = round((total_con_piloto*600/$preguntas)+400,0) 
                        WHERE nivel=:nivel AND id_evaluacion = :id_evaluacion" ,
                        array('nivel' => $nivel,
                              'id_evaluacion' => $id,));
        DB::statement("UPDATE $tablaRespuestas SET inev_sin_piloto = round((total_sin_piloto*600/$preguntasOperativas)+400,0) 
                        WHERE nivel=:nivel AND id_evaluacion = :id_evaluacion" ,
                        array('nivel' => $nivel,
                              'id_evaluacion' => $id,));
      }
        $evaluacion->estado = 5;
        $evaluacion->save();
        return Redirect::to('calificacion.subir_respuestas');
    }

    public function descargarCalificaciones($id)
    {
        $evaluacion = Evaluaciones::find($id);
        $codigoEvaluacion = CodigosEvaluaciones::find($evaluacion->id_codigo_evaluacion);
        $tablaRespuestas = $codigoEvaluacion->respuestas;        
        $arr = DB::table($tablaRespuestas)
              ->where('id_evaluacion', '=', $id)
              ->orderBY('nivel')
              ->orderBY('version')
              ->orderBY('forma')
              ->get();
        $nombre = $evaluacion->nombre."_".$id."_calificacion.csv";        
        return CSV::fromArray($arr)->render($nombre);  //download as csv
    }

    public function bilog()
    {
               
        $evaluaciones = DB::select( DB::raw("SELECT e.id, e.nombre, e.estado, n.nivel FROM evaluaciones e
                                      LEFT JOIN niveles n ON e.id = n.id_evaluacion                                      
                                      ORDER BY e.id, n.nivel"));         
        return View::make('calibraciones.archivoBilog', array('evaluaciones' => $evaluaciones));        
    }

    public function generarBilog($id,$nivel)
    {
               
      $selectArchivo = DB::select( DB::raw("SELECT * FROM evaluaciones_nivel_bilog e                                     
                                            WHERE id_evaluacion = :id_evaluacion AND nivel = :nivel") ,
                                            array('nivel' => $nivel,
                                                  'id_evaluacion' => $id,));
      if(count($selectArchivo)==0){
        $evaluacion = Evaluaciones::find($id);
        $codigoEvaluacion = CodigosEvaluaciones::find($evaluacion->id_codigo_evaluacion);      
        $mapaTecnico = $codigoEvaluacion->mapa_tecnico;
        $evaluacionBilog = new EvaluacionesBilog;
        Helper::posicionTemp($id,$mapaTecnico);
        DB::statement("CREATE TABLE temp (id serial, iditem integer, funcion character varying(50), nivel integer, 
                      idcampo character varying(10))");        
        DB::statement("INSERT INTO temp (iditem,funcion,nivel,idcampo) 
                        SELECT id_item, funcion, nivel, id_campo FROM $mapaTecnico 
                        WHERE id_evaluacion = :id AND nivel=:nivel ORDER BY id_item" ,
                        array('nivel' => $nivel,
                              'id' => $id,));      
        $nomEvaluacion = $evaluacion->nombre;
        switch ($nivel) {
          case 1:
            $nomNivel ="1er";
            break;
          case 2:
            $nomNivel = "2do";
            break;
          case 3:
            $nomNivel = "3ro";
            break;
          case 4:
            $nomNivel = "4to";
            break;
          case 5:
            $nomNivel = "5to";
            break;
        }
        $archivo = $id."_".trim($nomEvaluacion)."_".$nomNivel.".BLM";
        $archivo = str_replace(' ','',$archivo);
        $file = fopen($archivo,"w") or die("Problemas");
        fputs($file,"Calibración ".$nomEvaluacion.", ".$nomNivel." NIVEL COMPLETO\r\n");
        fputs($file,"COMMENT\r\n");
        fputs($file,">GLOBAL DFName = '".$nomNivel.".DAT',\r\n");
        fputs($file,"NPArm = 2,\r\n");
        $select = DB::select( DB::raw("SELECT nivel, COUNT(id_campo) AS totalcampo FROM $mapaTecnico 
                                        WHERE id_evaluacion = :id_evaluacion AND nivel = :nivel GROUP BY nivel, id_campo
                                        ORDER BY nivel"),
                                        array('id_evaluacion' => $id,
                                              'nivel' => $nivel,));
        $totalItems = 0;
        $totalCampos = 0;
        $NITems = "(";
        foreach($select as $result){
          $totalCampos++;
          $NITems .= $result->totalcampo.",";
          $totalItems += $result->totalcampo;        
        }
        $NITems .= ")";
        $NITems = str_replace(",)",")",$NITems);
        fputs($file,"NTEst = $totalCampos,\r\n");
        $select = DB::select( DB::raw("SELECT nivel, COUNT(id_campo) AS totalpilotoscampos FROM $mapaTecnico 
                                        WHERE id_evaluacion = :id_evaluacion AND nivel = :nivel AND funcion = 'Piloto' 
                                        GROUP BY nivel, id_campo ORDER BY nivel"),
                                        array('id_evaluacion' => $id,
                                              'nivel' => $nivel,));
        $totalCamposPiloto = 0;
        $NVAriant = "NVAriant=(";
        foreach($select as $result){
          $totalCamposPiloto++;
          $NVAriant .= $result->totalpilotoscampos.",";
        }
        $NVAriant .= ")";
        $NVAriant = str_replace(",)",")",$NVAriant);
        if(count($select)>0){
          fputs($file,"NVTEst = $totalCamposPiloto,\r\n");
        }
        fputs($file,"LOGistic,\r\n");
        fputs($file,"SAVe;\r\n");
        fputs($file,">SAVE PARm = '".$nomNivel."_SERMM.PAR',\r\n");
        fputs($file,"      SCOre = '".$nomNivel."_SERMM.SCO',\r\n");
        fputs($file,"      ISTat = '".$nomNivel."_SERMM.IST';\r\n");
        if(count($select)>0){
          fputs($file,">LENGTH NITems=".$NITems.",\r\n");
          fputs($file,"        ".$NVAriant.";\r\n");
        }else{
          fputs($file,">LENGTH NITems=".$NITems.";\r\n");
        }              
        fputs($file,">INPUT NTOtal = $totalItems,\r\n");
        fputs($file,"       NALt = 4,\r\n");
        if($evaluacion->id_codigo_evaluacion==6)
          fputs($file,"       NIDchar = 5,\r\n");
        if($evaluacion->id_codigo_evaluacion=1)
          fputs($file,"       NIDchar = 10,\r\n");
        $select = DB::select( DB::raw("SELECT COUNT(forma) as total FROM formas f, niveles n, evaluaciones e
                                      WHERE f.nivel=n.nivel AND n.id_evaluacion = e.id AND n.nivel = :nivel 
                                      AND f.id_evaluacion = e.id AND e.id = :id_evaluacion"),
                                        array('id_evaluacion' => $id,
                                              'nivel' => $nivel,));
        $totalFormas = (int)$select[0]->total;
        fputs($file,"       NFOrm = ".$totalFormas.",\r\n");
        fputs($file,"       KFName = '".$nomNivel.".KEY';\r\n");
        $select = DB::select( DB::raw("SELECT id, iditem, funcion FROM temp WHERE nivel=:nivel"),
                                        array('nivel' => $nivel,));
        $INAmes = "INAmes=(";
        $j=1;
        foreach($select as $result){
          $INAmes .= "'".(int)$result->iditem."',";
          if($j%9==0)
            $INAmes .= "\r\n";
          $j++;
        }
        $INAmes .= ")";
        $INAmes = str_replace(",)",")",$INAmes);
        fputs($file,">ITEMS ".$INAmes.";\r\n");
        $select = DB::select( DB::raw("SELECT DISTINCT campo, id_campo FROM $mapaTecnico 
                                        WHERE id_evaluacion = :id_evaluacion ORDER BY id_campo"),
                                        array('id_evaluacion' => $id,));
        foreach($select as $result){
          $idCampo = (int)$result->id_campo;
          $campo = $result->campo;
          $i=1;
          $INUmber = "(";
          $INUmberV = "(";
          $select1 = DB::select( DB::raw("SELECT id, funcion FROM temp 
                                        WHERE idcampo = :id_campo AND nivel=:nivel ORDER BY id "),
                                        array('nivel' => $nivel,                                        
                                              'id_campo' => $idCampo,));
          $s=1;
          $t=1;
          foreach($select1 as $result1){
            if($result1->funcion!='Piloto'){
              $INUmber .= (int)$resultadoItems['id'].",";
              $s++;
              if($s%15==0)
                $INUmber .= "\r\n";
            }
            if($resultadoItems['funcion']=='Piloto'){
              $INUmberV .= (int)$resultadoItems['id'].",";
              $t++;
              if($t%15==0)
                $INUmberV .= "\r\n";
            }
          }
          $INUmber .= ")";
          $INUmberV .= ")";
          $INUmber = str_replace(",)",")",$INUmber);
          $INUmberV = str_replace(",)",")",$INUmberV);
          fputs($file,">TEST".$i." TNAme = '".$campo."',\r\n");
          fputs($file,"INUmber = ".$INUmber.";\r\n");
          if($INUmberV!="()"){
            fputs($file,">TEST".$i."V TNAme = 'V".$campo."',\r\n");
            fputs($file,"INUmber = ".$INUmberV.";\r\n");
          }
          $i++;
        }
        $select2 = DB::select( DB::raw("SELECT preguntas FROM niveles 
                                        WHERE id_evaluacion=:id_evaluacion AND nivel=:nivel"),
                                        array('nivel' => $nivel,                                        
                                              'id_evaluacion' => $id,));
        $totalPreguntas = (int)$select2[0]->preguntas;
        $select3 = DB::select( DB::raw("SELECT DISTINCT forma FROM posicionestemp ORDER BY forma"),
                                        array());
        $i=1;
        foreach($select3 as $result3){
          $forma = (int)$result3->forma;
          $INUmbers = "(";
          $select4 = DB::select( DB::raw("SELECT id FROM temp t, posicionestemp p 
                                          WHERE t.iditem=p.iditem AND p.forma=:forma AND p.nivel=:nivel
                                          ORDER BY p.posicion"),
                                        array('nivel' => $nivel,                                        
                                              'forma' => $forma,));
          $j=1;
          foreach($select4 as $result4){
            $INUmbers .= (int)$result4->id.",";
            if($j%15==0)
              $INUmbers .= "\r\n";
            $j++;
          }
          $INUmbers .= ")";
          $INUmbers = str_replace(",)",")",$INUmbers);
          fputs($file,">FORM".$i." LENgth = $totalPreguntas,\r\n");
          fputs($file,"INUmbers = ".$INUmbers.";\r\n");
          $i++;
        }
        if($evaluacion->id_codigo_evaluacion==6)
          fputs($file,"(5A1, 4X, I2, ".$totalPreguntas."A1)\r\n");
        if($evaluacion->id_codigo_evaluacion==1)
          fputs($file,"(10A1, 1X, I2, ".$totalPreguntas."A1)\r\n");
        fputs($file,">CALIB PLOt = 1.0000,\r\n");
        fputs($file,"       ACCel = 1.0000;\r\n");
        fputs($file,">SCORE NQPt = ".$NITems.",\r\n");
        fputs($file,"       NOPrint;\r\n");
        fclose($file);
        DB::statement("DROP TABLE posicionestemp");
        DB::statement("DROP TABLE temp");
        $uploads_dir = '/uploads';
        rename ($archivo, "/var/www/html/sip_final/app/uploads/$archivo");
        $evaluacionBilog->id_evaluacion = $id;
        $evaluacionBilog->nivel = $nivel;
        $evaluacionBilog->archivo = $archivo;
        $evaluacionBilog->save();
        $file = "/var/www/html/sip_final/app/uploads/".$archivo;
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
      }else{
        $file = "/var/www/html/sip_final/app/uploads/".$selectArchivo[0]->archivo;
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;

      }
    }
}