@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h3 class="mb-4">Bienvenido, {{ auth()->user()->name }} 👋</h3>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                <div class="display-6">{{ $totales['equipos'] }}</div>
                <div class="text-muted">Equipos</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                <div class="display-6">{{ $totales['jugadores'] }}</div>
                <div class="text-muted">Jugadores</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                <div class="display-6">{{ $totales['finalizados'] }}</div>
                <div class="text-muted">Partidos jugados</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                <div class="display-6">{{ $totales['programados'] }}</div>
                <div class="text-muted">Por jugar</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted">Líder de la liga</h6>
                @if ($lider && $lider->pj > 0)
                    <h4 class="mb-1">🏆 {{ $lider->equipo->nombre }}</h4>
                    <p class="mb-0 text-muted">{{ $lider->g }} ganados, {{ $lider->p }} perdidos · {{ $lider->pts }} pts</p>
                @else
                    <p class="text-muted mb-0">Aún no hay partidos finalizados.</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted">Mejor ataque</h6>
                @if ($mejorAtaque)
                    <h4 class="mb-1">🔥 {{ $mejorAtaque->equipo->nombre }}</h4>
                    <p class="mb-0 text-muted">{{ $mejorAtaque->promedio_pf }} puntos por partido</p>
                @else
                    <p class="text-muted mb-0">Aún no hay partidos finalizados.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white"><strong>Últimos resultados</strong></div>
            <ul class="list-group list-group-flush">
                @forelse ($ultimos as $partido)
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{ $partido->local->nombre }} vs {{ $partido->visitante->nombre }}</span>
                        <strong>{{ $partido->puntos_local }} - {{ $partido->puntos_visitante }}</strong>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Sin resultados todavía.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white"><strong>Próximos partidos</strong></div>
            <ul class="list-group list-group-flush">
                @forelse ($proximos as $partido)
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{ $partido->local->nombre }} vs {{ $partido->visitante->nombre }}</span>
                        <span class="text-muted">{{ $partido->fecha->format('d/m H:i') }}</span>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No hay partidos programados.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('posiciones') }}" class="btn btn-primary">Ver tabla de posiciones</a>
</div>
@endsection