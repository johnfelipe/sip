<!DOCTYPE html>
<html>
    <head>
        <title>
            @section('title')
            INEVAL - SIP
            @show
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <!-- CSS are placed here -->
        {{ HTML::style('bootstrap/css/bootstrap.css') }}
        {{ HTML::style('bootstrap/css/bootstrap-responsive.css') }}
        {{ HTML::style('css/app.css') }}

        <!-- js are placed here -->
        {{ HTML::script('/js/jquery/jquery-1.11.0.min.js') }}

        <style>
        @section('styles')
            body {
                padding-top: 60px;
            }
        @show
        </style>
    </head>

    <body>
        <!-- Navbar -->        
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <a class="brand" href="#">SISTEMA DE INFORMACION PSICOMETRICA</a>

                    <!-- Everything you want hidden at 940px or less, place within here -->
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li><a href="{{{ URL::to('') }}}">Home</a></li>
                            @if (Auth::check())
                            <li class="dropdown">
                                <a class="dropdown-toggle text-white"  data-toggle="dropdown">Evaluaciones<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{{ URL::to('evaluaciones') }}}">Gestión de Evaluaciones</a></li>                                        
                                        <li><a href="{{{ URL::to('evaluaciones.mapa_tecnico') }}}">Subir Mapa Técnico</a></li>
                                    </ul>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle text-white"  data-toggle="dropdown">Calificación<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{{ URL::to('calificacion') }}}">Subir Respuestas</a></li>
                                        <li><a href="{{{ URL::to('calificacion') }}}">Cargar Archivo Externo</a></li>
                                        <li><a href="{{{ URL::to('calificacion') }}}">Calificar</a></li>                                                                                
                                    </ul>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle text-white"  data-toggle="dropdown">Calibración<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{{ URL::to('calibracion') }}}">Generar Archivo BILOG</a></li>
                                        <li><a href="{{{ URL::to('calibracion') }}}">Calibrar</a></li>                               
                                    </ul>
                            </li>                                                        
                            <li><a href="{{{ URL::to('reportes') }}}">Reportes</a></li>
                            @endif                            
                        </ul> 
                    </div>

                    <div class="nav pull-right">
                        <ul class="nav">
                            @if ( Auth::guest() )
                                <li>{{ HTML::link('login', 'Login') }}</li>
                            @else
                                <li>{{ HTML::link('logout', 'Logout') }}</li>
                            @endif
                        </ul>
                    </div> 
                </div>
            </div>
        </div> 

        <!-- Container -->
        <div class="wrapper">
            <div class="container">

                <!-- Success-Messages -->
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4>Success</h4>
                        {{{ $message }}}
                    </div>
                @endif

                <!-- Content -->
                @yield('content')           

            </div>
            <div class="push"><!--//--></div>
        </div>
        <footer>
            <div class="container">
                <p>INSTITUTO DE EVALUACION EDUCATIVA - INEVAL</p>                
            </div>
        </footer>

        <!-- Scripts are placed here -->
        {{ HTML::script('/bootstrap/js/bootstrap.min.js') }}

    </body>
</html>