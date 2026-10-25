@csrf

<div class="mb-3">
    <label class="form-label">Nombre del equipo</label>
    <input type="text" name="nombre" value="{{ old('nombre', $equipo->nombre ?? '') }}"
           class="form-control @error('nombre') is-invalid @enderror" required>
    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Ciudad</label>
    <input type="text" name="ciudad" value="{{ old('ciudad', $equipo->ciudad ?? '') }}"
           class="form-control @error('ciudad') is-invalid @enderror" required>
    @error('ciudad') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-4">
    <label class="form-label">Entrenador</label>
    <input type="text" name="entrenador" value="{{ old('entrenador', $equipo->entrenador ?? '') }}"
           class="form-control @error('entrenador') is-invalid @enderror" required>
    @error('entrenador') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>