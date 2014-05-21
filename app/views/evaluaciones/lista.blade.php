@extends('layouts.master')

 
@section('sidebar')
     @parent
     Evaluaciones
@stop
 
@section('content')


<h1>
  Gestión de Evaluaciones
  
</h1>
<div class="row evaluaciones">
	<h3>Nueva Evaluación</h3>
	{{ Form::open(array('url' => 'evaluaciones')) }}
    <?php $id = Auth::user()->id; ?>
    {{ Form::hidden('user_id', $id) }}


	@if (Session::get('mensaje'))
		<div class="alert alert-success">{{Session::get('mensaje')}}</div>
	@endif
	<div class="form-group">
    	{{Form::label('nombre', 'Nombre')}}
        {{Form::text('nombre', Input::old('nombre'), array('class'=>'form-control'))}}
    </div>
    @if( $errors->has('nombre') )
    <div class="alert alert-danger">
    	@foreach($errors->get('nombre') as $error)
        	* {{ $error }}</br>
        @endforeach
    </div>
    @endif
    <div class="form-group">
    	{{Form::label('descripcion', 'Descipcion')}}
        {{Form::text('descripcion', Input::old('descripcion'), array('class'=>'form-control'))}}
    </div>
    @if( $errors->has('descripcion') )
    	<div class="alert alert-danger">
        @foreach($errors->get('descripcion') as $error)
        	* {{ $error }}</br>
       	@endforeach
    	</div>
    @endif
    <div class="form-group">
    	{{Form::label('tipo_de_evaluacion', 'Tipo de Evaluación')}}
        {{Form::select('id_codigo_evaluacion', $combobox, $selected) }}
    </div>
	{{Form::submit('Guardar', array('class'=>'btn btn-success'))}}
	{{ Form::close() }}
</div>
<h3>Evaluaciones</h3>
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
        <td>{{ HTML::link( 'evaluaciones/'.$evaluacion->id , $evaluacion->nombre ) }}</td> 
        @if($evaluacion->estado == 0)       
            <td><a href="{{{ URL::to('evaluaciones/borrar/'.$evaluacion->id) }}}">Eliminar</a></td>
        @else
            <td></td>
        @endif
    </tr>    
  @endforeach
	</ul>
</table>
</div>
@stop



  