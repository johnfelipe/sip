@extends('layouts.master')
 
@section('sidebar')
     @parent
     Evaluaciones
@stop
 
@section('content')

<h3>
  Subir Mapa Técnico      
</h3>
<div class="row mapa">
	{{ Form::open(array('action' => 'EvaluacionesController@subirMapaTecnico', 'file' => true, 'enctype' => 'multipart/form-data')) }}


	<div class="form-group">
    	{{Form::label('evaluacion', 'Escoja la evaluación para la cual desea subir el Mapa Técnico')}}
      {{Form::select('nombre', $combobox, $selected) }}
    </div>
    <div class="form-group">
    	{{ Form::file('file') }} <br><br>
    	
    	{{ Form::submit('Subir', array('name'=>'mapa',
    									'class'=>'btn btn-success')) }}
    </div>	
</div>
<h3>Evaluaciones con Mapa Técnico</h3>
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
        @if($evaluacion->estado == 1)                            
        	<td>{{ HTML::link( 'evaluaciones/generar_mapa_tecnico/'.$evaluacion->id , 'Generar KEY' ) }}</td>
        @elseif($evaluacion->estado != 0 AND $evaluacion->estado != 1)
        	<td>{{ HTML::link( 'evaluaciones/descargar_mapa_tecnico/'.$evaluacion->id , 'Descargar KEY a excel' ) }}</td>
        @endif
    </tr>       
  @endforeach
	</ul>
</table>
</div>
{{ Form::close() }}      


@stop