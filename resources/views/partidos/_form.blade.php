@csrf

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Equipo local</label>
        <select name="equipo_local_id" class="form-select @error('equipo_local_id') is-invalid @enderror" required>
            <option value="">Seleccione...</option>
            @foreach ($equipos as $equipo)
                <option value="{{ $equipo->id }}"
                    @selected(old('equipo_local_id', $partido->equipo_local_id ?? '') == $equipo->id)>
                    {{ $equipo->nombre }}
                </option>
            @endforeach
        </select>
        @error('equipo_local_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Equipo visitante</label>
        <select name="equipo_visitante_id" class="form-select @error('equipo_visitante_id') is-invalid @enderror" required>
            <option value="">Seleccione...</option>
            @foreach ($equipos as $equipo)
                <option value="{{ $equipo->id }}"
                    @selected(old('equipo_visitante_id', $partido->equipo_visitante_id ?? '') == $equipo->id)>
                    {{ $equipo->nombre }}
                </option>
            @endforeach
        </select>
        @error('equipo_visitante_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Fecha y hora</label>
        <input type="datetime-local" name="fecha"
               value="{{ old('fecha', isset($partido) ? $partido->fecha->format('Y-m-d\TH:i') : '') }}"
               class="form-control @error('fecha') is-invalid @enderror" required>
        @error('fecha') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-select @error('estado') is-invalid @enderror" required>
            @foreach (\App\Models\Partido::ESTADOS as $estado)
                <option value="{{ $estado }}"
                    @selected(old('estado', $partido->estado ?? 'programado') === $estado)>
                    {{ ucfirst($estado) }}
                </option>
            @endforeach
        </select>
        @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row mb-2">
    <div class="col-md-6 mb-3">
        <label class="form-label">Puntos local</label>
        <input type="number" name="puntos_local" min="0" max="300"
               value="{{ old('puntos_local', $partido->puntos_local ?? '') }}"
               class="form-control @error('puntos_local') is-invalid @enderror">
        @error('puntos_local') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Puntos visitante</label>
        <input type="number" name="puntos_visitante" min="0" max="300"
               value="{{ old('puntos_visitante', $partido->puntos_visitante ?? '') }}"
               class="form-control @error('puntos_visitante') is-invalid @enderror">
        @error('puntos_visitante') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<p class="text-muted small mb-4">Los puntos solo se guardan si el estado es <strong>Finalizado</strong>.</p>