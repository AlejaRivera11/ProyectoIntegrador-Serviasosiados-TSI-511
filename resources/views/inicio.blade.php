@extends('layouts.plantilla')

@section('titulomain', 'Inicio')

@section('contenido')

    <div class="inicio-container">

        <div class="inicio-logo-wrap">
            <img src="{{ asset('img/Logo2.png') }}" alt="Logo Serviasociados" class="inicio-logo">
        </div>

        <h1 class="inicio-titulo">SERVIASOCIADOS</h1>

        <p class="inicio-subtitulo">Experiencia y Responsabilidad</p>

        <div class="inicio-linea"></div>

        <p class="inicio-bienvenida">
            Bienvenido,
            <strong>{{ auth()->user()?->cliente?->nombre_cliente ??
                (ucfirst(auth()->user()?->getRoleNames()->first()) ?? 'Usuario') }}</strong>
        </p>

    </div>

@endsection
