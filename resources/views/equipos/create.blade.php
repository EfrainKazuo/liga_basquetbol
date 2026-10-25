@extends('layouts.app')

@section('title', 'Nuevo equipo')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="mb-4">Nuevo equipo</h3>

                <form method="POST" action="{{ route('equipos.store') }}">
                    @include('equipos._form')

                    <a href="{{ route('equipos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection