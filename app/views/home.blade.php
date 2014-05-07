@extends('layouts.master')

@section('title')
@parent
:: Home
@stop

@section('content')
@if (!Auth::check())
<h1>Bienvenido</h1>
<p>Por favor ingrese su usuario y contraseña desde la pestaña "Login"</p>
@endif
@stop