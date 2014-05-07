@extends('layouts.master')
 
@section('sidebar')
     @parent
     Lista de evaluaciones
@stop
 
@section('content')
<h1>
  Gestión de Evaluaciones
  
</h1>
<div class="row evaluaciones">
	<h3>Nueva Evaluación</h3>
	{{ Form::open(array('url' => 'evaluaciones')) }}
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
        <select class="form-control">
    		<option value="one">One</option>
		</select>
    </div>
	{{Form::submit('Guardar', array('class'=>'btn btn-success'))}}
	{{ Form::close() }}
</div>
<h3>Evaluaciones</h3>
<div class="list-group"> 
<ul>
  @foreach($evaluaciones as $evaluacion)  
    <li>
      {{ HTML::link( 'evaluaciones/'.$evaluacion->id , $evaluacion->nombre ) }}
      {{ HTML::link('evaluaciones/borrar/'.$evaluacion->id, 'Eliminar') }} 
    </li>    
  @endforeach
</ul>
@stop