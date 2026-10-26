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

        <hr>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Jugadores ({{ $jugadores->count() }})</h5>
    <a href="{{ route('equipos.jugadores.create', $equipo) }}" class="btn btn-sm btn-primary">+ Agregar jugador</a>
</div>

<div class="table-responsive mb-4">
    <table class="table table-sm table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Posición</th>
                <th>Altura</th>
                <th>Edad</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jugadores as $jugador)
                <tr>
                    <td><span class="badge bg-dark">{{ $jugador->numero_camiseta }}</span></td>
                    <td>{{ $jugador->nombre }}</td>
                    <td>{{ $jugador->posicion }}</td>
                    <td>{{ number_format($jugador->altura, 2) }} m</td>
                    <td>{{ $jugador->fecha_nacimiento->age }} años</td>
                    <td class="text-end">
                        <a href="{{ route('jugadores.edit', $jugador) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                        <form method="POST" action="{{ route('jugadores.destroy', $jugador) }}" class="d-inline"
                              onsubmit="return confirm('¿Eliminar a {{ $jugador->nombre }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-3">Este equipo aún no tiene jugadores.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

        <a href="{{ route('equipos.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('equipos.edit', $equipo) }}" class="btn btn-primary">Editar</a>
    </div>
</div>
@endsection