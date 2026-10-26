@extends('layouts.app')

@section('title', 'Partidos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Partidos</h3>
    <a href="{{ route('partidos.create') }}" class="btn btn-primary">+ Nuevo partido</a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Fecha</th>
                    <th class="text-end">Local</th>
                    <th class="text-center">Marcador</th>
                    <th>Visitante</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($partidos as $partido)
                    <tr>
                        <td>{{ $partido->fecha->format('d/m/Y H:i') }}</td>
                        <td class="text-end">{{ $partido->local->nombre }}</td>
                        <td class="text-center">
                            @if ($partido->estado === 'finalizado')
                                <strong>{{ $partido->puntos_local }} - {{ $partido->puntos_visitante }}</strong>
                            @else
                                <span class="text-muted">vs</span>
                            @endif
                        </td>
                        <td>{{ $partido->visitante->nombre }}</td>
                        <td>
                            @if ($partido->estado === 'finalizado')
                                <span class="badge bg-success">Finalizado</span>
                            @else
                                <span class="badge bg-warning text-dark">Programado</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('partidos.edit', $partido) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                            <form method="POST" action="{{ route('partidos.destroy', $partido) }}" class="d-inline"
                                  onsubmit="return confirm('¿Eliminar este partido?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Aún no hay partidos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $partidos->links() }}
</div>
@endsection