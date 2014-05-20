@extends('layouts.master')
 
@section('sidebar')
     @parent
     Calificaciones
@stop
 
@section('content')

<h3>
  Subir Archivo de Respuestas      
</h3>
<div class="row mapa">
	{{ Form::open(array('action' => 'EvaluacionesController@subirRespuestas', 'file' => true, 'enctype' => 'multipart/form-data')) }}


	<div class="form-group">
    	{{Form::label('evaluacion', 'Escoja la evaluación para la cual desea subir el archivo con las respuestas de los sustantantes')}}
      {{Form::select('nombre', $combobox, $selected) }}
    </div>
    <div class="form-group">
    	{{ Form::file('file') }} <br><br>
    	
    	{{ Form::submit('Subir', array('name'=>'mapa',
    									'class'=>'btn btn-success')) }}
    </div>	
</div>
<h3>Evaluaciones con respuestas de sustentantes</h3>
<div class="list-group">
<table class="table table-striped" style="width: 900px">
    <tr>
        <th>ID Evaluación</th>
        <th>Nombre</th>
        <th></th>               
    </tr> 
	<ul>
  @foreach($evaluaciones as $evaluacion)   
  <tr>
        <td>{{ $evaluacion->id }}</td>
        <td>{{ $evaluacion->nombre  }}</td>
        @if($evaluacion->estado == 3)                            
        	<td>{{ HTML::link( 'calificacion/calificar/'.$evaluacion->id , 'Calificar' ) }}</td>
        @elseif($evaluacion->estado == 4)
          <td>{{ HTML::link( 'calificacion/calculoIneval/'.$evaluacion->id , 'Indice INEVAL' ) }}</td>
        @elseif($evaluacion->estado == 5 and $evaluacion->id_codigo_evaluacion!=1)
        	<td>{{ HTML::link( 'calificacion/descargar_calificaciones/'.$evaluacion->id , 'Descargar Calificaciones' ) }}</td>
        @elseif($evaluacion->estado == 5 and $evaluacion->id_codigo_evaluacion==1)
        <td>FINALIZADO</td>          
        @endif
    </tr>       
  @endforeach
	</ul>
</table>
</div>
{{ Form::close() }}      


@stop