@extends('layouts.app')

@section('title', 'Editar partido')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="mb-4">Editar partido</h3>

                <form method="POST" action="{{ route('partidos.update', $partido) }}">
                    @method('PUT')
                    @include('partidos._form')

                    <a href="{{ route('partidos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection