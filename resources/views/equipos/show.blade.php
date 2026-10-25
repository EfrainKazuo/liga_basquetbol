@extends('layouts.app')

@section('title', $equipo->nombre)

@section('content')
<div class="card shadow-sm">
    <div class="card-body p-4">
        <h3>{{ $equipo->nombre }}</h3>
        <dl class="row mb-4">
            <dt class="col-sm-3">Ciudad</dt>
            <dd class="col-sm-9">{{ $equipo->ciudad }}</dd>

            <dt class="col-sm-3">Entrenador</dt>
            <dd class="col-sm-9">{{ $equipo->entrenador }}</dd>

            <dt class="col-sm-3">Registrado</dt>
            <dd class="col-sm-9">{{ $equipo->created_at->format('d/m/Y H:i') }}</dd>
        </dl>

        <p class="text-muted">Aquí se mostrarán los jugadores del equipo (Fase 3).</p>

        <a href="{{ route('equipos.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('equipos.edit', $equipo) }}" class="btn btn-primary">Editar</a>
    </div>
</div>
@endsection