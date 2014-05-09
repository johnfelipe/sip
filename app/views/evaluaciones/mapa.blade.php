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
	{{ Form::open(array('url' => 'evaluaciones.mapa_tecnico', 'files' => true)) }}

	<div class="form-group">
    	{{Form::label('evaluacion', 'Escoja la evaluación para la cual desea generar el Mapa Técnico')}}
        {{Form::select('nombre', $combobox, $selected) }}
    </div>
    <div class="form-group">
    	{{ Form::file('file') }} <br><br>
    	
    	{{ Form::submit('Generar', array('class'=>'btn btn-success')) }}
    </div>
	{{ Form::close() }}
</div>
<h3>Evaluaciones con Mapa Técnico</h3>
<div class="list-group">
<table class="table table-striped" style="width: 900px">
    <tr>
        <th>Nombre</th>               
    </tr> 
	<ul>
  @foreach($evaluaciones as $evaluacion)
  <tr>
        <td>{{ $evaluacion->nombre  }}</td>                            
    </tr>    
  @endforeach
	</ul>
</table>
</div>      


@stop