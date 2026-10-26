<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::orderBy('nombre')->paginate(10);
        return view('equipos.index', compact('equipos'));
    }

    public function create()
    {
        return view('equipos.create');
    }

    public function store(Request $request)
    {
        Equipo::create($this->validar($request));

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo creado correctamente.');
    }

public function show(Equipo $equipo)
{
    $jugadores = $equipo->jugadores()->orderBy('numero_camiseta')->get();

    return view('equipos.show', compact('equipo', 'jugadores'));
}

    public function edit(Equipo $equipo)
    {
        return view('equipos.edit', compact('equipo'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        $equipo->update($this->validar($request, $equipo));

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo actualizado correctamente.');
    }

    public function destroy(Equipo $equipo)
    {
        $equipo->delete();

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo eliminado correctamente.');
    }

    private function validar(Request $request, ?Equipo $equipo = null): array
    {
        return $request->validate([
            'nombre'     => ['required', 'string', 'max:100',
                             Rule::unique('equipos', 'nombre')->ignore($equipo?->id)],
            'ciudad'     => ['required', 'string', 'max:100'],
            'entrenador' => ['required', 'string', 'max:100'],
        ]);
    }
}