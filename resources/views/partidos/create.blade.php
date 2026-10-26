@extends('layouts.app')

@section('title', 'Nuevo partido')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="mb-4">Nuevo partido</h3>

                @if ($equipos->count() < 2)
                    <div class="alert alert-warning">
                        Necesitas al menos 2 equipos registrados para crear un partido.
                        <a href="{{ route('equipos.create') }}">Crear equipo</a>
                    </div>
                @endif

                <form method="POST" action="{{ route('partidos.store') }}">
                    @include('partidos._form')

                    <a href="{{ route('partidos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection