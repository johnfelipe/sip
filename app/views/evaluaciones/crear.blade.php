@extends('layouts.master')
 
@section('sidebar')
     @parent
     Evaluaciones
@stop
 
@section('content')
        
        <h1>
  Nueva Evaluación   
  
</h1>  

        {{ Form::open(array('url' => 'evaluaciones/crear')) }}
        <!-- Set hidden form element with userid embedded -->       
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
            
            {{Form::submit('Guardar')}}
        {{ Form::close() }}
<br />
<br />
        {{ HTML::link('evaluaciones', 'volver'); }}
@stop