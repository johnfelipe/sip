<?php namespace Helpers;
use Illuminate\Support\Facades\DB as DB;

class Helper {

    public static function posicionTemp($idEvaluacion,$mapaTecnico){
    	DB::statement("CREATE TABLE posicionestemp (nivel integer, version integer, forma integer,posicion integer, iditem integer,
    		funcion character varying(100), id_campo character varying(10))");
    	$select = DB::select( DB::raw("SELECT n.nivel, v.version, f.forma FROM formas f
							    		LEFT JOIN niveles n ON f.nivel = n.nivel
							    		LEFT JOIN versiones v ON f.version = v.version
							        LEFT JOIN evaluaciones e ON v.id_evaluacion = e.id 
							        AND n.id_evaluacion = e.id AND f.id_evaluacion = e.id
							        WHERE e.id = :id_evaluacion"),
							        array('id_evaluacion' => $idEvaluacion,));
    	foreach($select as $result){
    		$nivel = (int)$result->nivel;
        $version = (int)$result->version;
        $forma = (int)$result->forma;
        $select1 = DB::select( DB::raw("SELECT id_item, funcion, f".$forma." as posicion, id_campo FROM $mapaTecnico 
							            	WHERE id_evaluacion = :id_evaluacion
							            	AND nivel = :nivel
							                AND f".$forma." IS NOT null ORDER BY f".$forma),
							            	array('id_evaluacion' => $idEvaluacion,
							            	'nivel' => $nivel,));
            foreach ($select1 as $result1) {
            	$idItem = (int)$result1->id_item;
              $funcion = $result1->funcion;
              $posicion = (int)$result1->posicion;
              $campo = $result1->id_campo;
              DB::statement("INSERT INTO posicionestemp VALUES ($nivel,$version,$forma,$posicion,$idItem,'$funcion','$campo')");
            }
    	}    	
     }

     public static function posicionTempNivel($idEvaluacion,$nivel,$mapaTecnico){
      DB::statement("CREATE TABLE posicionestemp (nivel integer, version integer, forma integer,posicion integer, iditem integer,
        funcion character varying(100), id_campo character varying(10))");
      $select = DB::select( DB::raw("SELECT n.nivel, v.version, f.forma FROM formas f
                      LEFT JOIN niveles n ON f.nivel = n.nivel
                      LEFT JOIN versiones v ON f.version = v.version
                      LEFT JOIN evaluaciones e ON v.id_evaluacion = e.id 
                      AND n.id_evaluacion = e.id AND f.id_evaluacion = e.id
                      WHERE e.id = :id_evaluacion AND n.nivel = :nivel"),
                      array('id_evaluacion' => $idEvaluacion,
                            'nivel' => $nivel,));
      foreach($select as $result){
        $nivel = (int)$result->nivel;
        $version = (int)$result->version;
        $forma = (int)$result->forma;
        $select1 = DB::select( DB::raw("SELECT id_item, funcion, f".$forma." as posicion, id_campo FROM $mapaTecnico 
                                        WHERE id_evaluacion = :id_evaluacion AND nivel = :nivel
                                        AND f".$forma." IS NOT null ORDER BY f".$forma),
                                        array('id_evaluacion' => $idEvaluacion,
                                              'nivel' => $nivel,));
        foreach ($select1 as $result1) {
          $idItem = (int)$result1->id_item;
          $funcion = $result1->funcion;
          $posicion = (int)$result1->posicion;
          $campo = $result1->id_campo;
          DB::statement("INSERT INTO posicionestemp VALUES ($nivel,$version,$forma,$posicion,$idItem,'$funcion','$campo')");
        }
      }           
     }
    }