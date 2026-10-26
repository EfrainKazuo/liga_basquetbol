@extends('layouts.app')

@section('title', 'Tabla de posiciones')

@section('content')
<h3 class="mb-3">Tabla de posiciones</h3>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Equipo</th>
                    <th class="text-center">PJ</th>
                    <th class="text-center">G</th>
                    <th class="text-center">P</th>
                    <th class="text-center">PF</th>
                    <th class="text-center">PC</th>
                    <th class="text-center">Dif</th>
                    <th class="text-center">Pts</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tabla as $fila)
                    <tr>
                        <td>
                            @if ($loop->first && $fila->pj > 0)
                                🏆
                            @else
                                {{ $loop->iteration }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('equipos.show', $fila->equipo) }}" class="text-decoration-none">
                                {{ $fila->equipo->nombre }}
                            </a>
                        </td>
                        <td class="text-center">{{ $fila->pj }}</td>
                        <td class="text-center">{{ $fila->g }}</td>
                        <td class="text-center">{{ $fila->p }}</td>
                        <td class="text-center">{{ $fila->pf }}</td>
                        <td class="text-center">{{ $fila->pc }}</td>
                        <td class="text-center {{ $fila->dif > 0 ? 'text-success' : ($fila->dif < 0 ? 'text-danger' : '') }}">
                            {{ $fila->dif > 0 ? '+' : '' }}{{ $fila->dif }}
                        </td>
                        <td class="text-center"><strong>{{ $fila->pts }}</strong></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">Aún no hay equipos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<p class="text-muted small mt-3 mb-0">
    PJ: partidos jugados · G: ganados · P: perdidos · PF: puntos a favor · PC: puntos en contra ·
    Dif: diferencia · Pts: victoria = 2, derrota = 1. Solo cuentan partidos finalizados.
</p>
@endsection