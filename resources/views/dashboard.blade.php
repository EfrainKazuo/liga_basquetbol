@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h3>Bienvenido, {{ auth()->user()->name }} 👋</h3>
        <p class="text-muted mb-0">Panel de gestión de la liga. Aquí irán los equipos, jugadores, partidos y estadísticas.</p>
    </div>
</div>
@endsection