@extends('layouts.master')
 
@section('sidebar')
     @parent
     Evaluaciones
@stop
 
@section('content')

        <h1>
  Evaluación {{$evaluacion->nombre}}
      
</h1>
        
        {{ $evaluacion->descripcion }}        
<br />
        {{ $evaluacion->codigos_evaluaciones->nombre }}
<br />
		{{ $evaluacion->created_at }}
<br />
<br />

        {{ HTML::link('evaluaciones', 'Volver'); }}
@stop