@csrf

<div class="mb-3">
    <label class="form-label">Nombre del jugador</label>
    <input type="text" name="nombre" value="{{ old('nombre', $jugador->nombre ?? '') }}"
           class="form-control @error('nombre') is-invalid @enderror" required>
    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Número de camiseta</label>
        <input type="number" name="numero_camiseta" min="0" max="99"
               value="{{ old('numero_camiseta', $jugador->numero_camiseta ?? '') }}"
               class="form-control @error('numero_camiseta') is-invalid @enderror" required>
        @error('numero_camiseta') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Posición</label>
        <select name="posicion" class="form-select @error('posicion') is-invalid @enderror" required>
            <option value="">Seleccione...</option>
            @foreach (\App\Models\Jugador::POSICIONES as $pos)
                <option value="{{ $pos }}" @selected(old('posicion', $jugador->posicion ?? '') === $pos)>
                    {{ $pos }}
                </option>
            @endforeach
        </select>
        @error('posicion') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6 mb-3 mb-md-0">
        <label class="form-label">Altura (m)</label>
        <input type="number" name="altura" step="0.01" min="1.40" max="2.50"
               value="{{ old('altura', $jugador->altura ?? '') }}"
               class="form-control @error('altura') is-invalid @enderror" required>
        @error('altura') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Fecha de nacimiento</label>
        <input type="date" name="fecha_nacimiento"
               value="{{ old('fecha_nacimiento', isset($jugador) ? $jugador->fecha_nacimiento->format('Y-m-d') : '') }}"
               class="form-control @error('fecha_nacimiento') is-invalid @enderror" required>
        @error('fecha_nacimiento') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>