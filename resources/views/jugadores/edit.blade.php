@extends('layouts.app')

@section('title', 'Editar jugador')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="mb-1">Editar jugador</h3>
                <p class="text-muted mb-4">Equipo: <strong>{{ $equipo->nombre }}</strong></p>

                <form method="POST" action="{{ route('jugadores.update', $jugador) }}">
                    @method('PUT')
                    @include('jugadores._form')

                    <a href="{{ route('equipos.show', $equipo) }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection