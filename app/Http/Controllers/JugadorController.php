<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JugadorController extends Controller
{
    public function create(Equipo $equipo)
    {
        return view('jugadores.create', compact('equipo'));
    }

    public function store(Request $request, Equipo $equipo)
    {
        $equipo->jugadores()->create($this->validar($request, $equipo));

        return redirect()->route('equipos.show', $equipo)
            ->with('success', 'Jugador agregado correctamente.');
    }

    public function edit(Jugador $jugador)
    {
        $equipo = $jugador->equipo;

        return view('jugadores.edit', compact('jugador', 'equipo'));
    }

    public function update(Request $request, Jugador $jugador)
    {
        $jugador->update($this->validar($request, $jugador->equipo, $jugador));

        return redirect()->route('equipos.show', $jugador->equipo)
            ->with('success', 'Jugador actualizado correctamente.');
    }

    public function destroy(Jugador $jugador)
    {
        $equipo = $jugador->equipo;
        $jugador->delete();

        return redirect()->route('equipos.show', $equipo)
            ->with('success', 'Jugador eliminado correctamente.');
    }

    private function validar(Request $request, Equipo $equipo, ?Jugador $jugador = null): array
    {
        return $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'numero_camiseta' => [
                'required', 'integer', 'min:0', 'max:99',
                Rule::unique('jugadores', 'numero_camiseta')
                    ->where('equipo_id', $equipo->id)
                    ->ignore($jugador?->id),
            ],
            'posicion' => ['required', Rule::in(Jugador::POSICIONES)],
            'altura' => ['required', 'numeric', 'between:1.40,2.50'],
            'fecha_nacimiento' => ['required', 'date', 'before:today'],
        ]);
    }
}