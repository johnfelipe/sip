@extends('layouts.master')
 
@section('sidebar')
     @parent
     Información de evaluación
@stop
 
@section('content')
        
        <h1>
  Evaluación {{$evaluacion->nombre}}
      
</h1>
        
        {{ $evaluacion->descripcion }}
        
<br />
        {{ $evaluacion->created_at}}
<br />
<br />

        {{ HTML::link('evaluaciones', 'Volver'); }}
@stop