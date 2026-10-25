@extends('layouts.app')

@section('title', 'Equipos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Equipos</h3>
    <a href="{{ route('equipos.create') }}" class="btn btn-primary">+ Nuevo equipo</a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                    <th>Entrenador</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($equipos as $equipo)
                    <tr>
                        <td>{{ $equipo->id }}</td>
                        <td>{{ $equipo->nombre }}</td>
                        <td>{{ $equipo->ciudad }}</td>
                        <td>{{ $equipo->entrenador }}</td>
                        <td class="text-end">
                            <a href="{{ route('equipos.show', $equipo) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                            <a href="{{ route('equipos.edit', $equipo) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                            <form method="POST" action="{{ route('equipos.destroy', $equipo) }}" class="d-inline"
                                  onsubmit="return confirm('¿Eliminar el equipo {{ $equipo->nombre }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Aún no hay equipos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $equipos->links() }}
</div>
@endsection