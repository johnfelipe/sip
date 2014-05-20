@extends('layouts.master')

 
@section('sidebar')
     @parent
     Calibraciones
@stop
 
@section('content')


<h1>
  Descarga de archivo Bilog
  
</h1>
<h3>Evaluaciones</h3>
<div class="list-group">
<table class="table table-striped" style="width: 900px">
    <tr>
        <th>ID Evaluación</th>
        <th>Nombre</th>        
        <th>Nivel</th>
        <th></th>
    </tr> 
	<ul>
  @foreach($evaluaciones as $evaluacion)
    @if($evaluacion->estado != 0)
        <tr>
            <td>{{ $evaluacion->id }}</td>
            <td>{{ $evaluacion->nombre  }}</td>
            <td>{{ $evaluacion->nivel  }}</td>
            <td><a href="{{{ URL::action('EvaluacionesController@generarBilog', array($evaluacion->id,$evaluacion->nivel) ) }}}">Descarga archivo</a></td>        
        </tr>
    @endif    
  @endforeach
	</ul>
</table>
</div>
@stop



  