<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Partido;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PartidoController extends Controller
{
    public function index()
    {
        $partidos = Partido::with(['local', 'visitante'])
            ->orderByDesc('fecha')
            ->paginate(10);

        return view('partidos.index', compact('partidos'));
    }

    public function create()
    {
        $equipos = Equipo::orderBy('nombre')->get();

        return view('partidos.create', compact('equipos'));
    }

    public function store(Request $request)
    {
        Partido::create($this->validar($request));

        return redirect()->route('partidos.index')
            ->with('success', 'Partido registrado correctamente.');
    }

    public function edit(Partido $partido)
    {
        $equipos = Equipo::orderBy('nombre')->get();

        return view('partidos.edit', compact('partido', 'equipos'));
    }

    public function update(Request $request, Partido $partido)
    {
        $partido->update($this->validar($request));

        return redirect()->route('partidos.index')
            ->with('success', 'Partido actualizado correctamente.');
    }

    public function destroy(Partido $partido)
    {
        $partido->delete();

        return redirect()->route('partidos.index')
            ->with('success', 'Partido eliminado correctamente.');
    }

    private function validar(Request $request): array
    {
        $finalizado = $request->input('estado') === 'finalizado';

        $data = $request->validate([
            'equipo_local_id'     => ['required', 'exists:equipos,id'],
            'equipo_visitante_id' => ['required', 'exists:equipos,id', 'different:equipo_local_id'],
            'fecha'               => ['required', 'date'],
            'estado'              => ['required', Rule::in(Partido::ESTADOS)],
            'puntos_local'        => [Rule::requiredIf($finalizado), 'nullable', 'integer', 'min:0', 'max:300'],
            'puntos_visitante'    => [
                Rule::requiredIf($finalizado), 'nullable', 'integer', 'min:0', 'max:300',
                Rule::when($finalizado, ['different:puntos_local']),
            ],
        ], [
            'equipo_visitante_id.different' => 'El equipo visitante debe ser distinto al local.',
            'puntos_local.required'         => 'Ingresa los puntos del equipo local.',
            'puntos_visitante.required'     => 'Ingresa los puntos del equipo visitante.',
            'puntos_visitante.different'    => 'En básquetbol no hay empates: los puntos deben ser distintos.',
        ]);

        if ($data['estado'] === 'programado') {
            $data['puntos_local'] = null;
            $data['puntos_visitante'] = null;
        }

        return $data;
    }
}