<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use App\Models\Partido;

class EstadisticaController extends Controller
{
    public function dashboard()
    {
        $tabla = $this->tablaPosiciones();

        $ultimos = Partido::with(['local', 'visitante'])
            ->where('estado', 'finalizado')
            ->orderByDesc('fecha')
            ->take(5)
            ->get();

        $proximos = Partido::with(['local', 'visitante'])
            ->where('estado', 'programado')
            ->orderBy('fecha')
            ->take(5)
            ->get();

        $totales = [
            'equipos'     => Equipo::count(),
            'jugadores'   => Jugador::count(),
            'finalizados' => Partido::where('estado', 'finalizado')->count(),
            'programados' => Partido::where('estado', 'programado')->count(),
        ];

        $lider = $tabla->first();
        $mejorAtaque = $tabla->where('pj', '>', 0)->sortByDesc('promedio_pf')->first();

        return view('dashboard', compact('totales', 'ultimos', 'proximos', 'lider', 'mejorAtaque'));
    }

    public function posiciones()
    {
        $tabla = $this->tablaPosiciones();

        return view('estadisticas.posiciones', compact('tabla'));
    }

    private function tablaPosiciones()
    {
        $equipos = Equipo::with([
            'partidosLocal'     => fn ($q) => $q->where('estado', 'finalizado'),
            'partidosVisitante' => fn ($q) => $q->where('estado', 'finalizado'),
        ])->get();

        return $equipos->map(function ($equipo) {
            $pj = $g = $p = $pf = $pc = 0;

            foreach ($equipo->partidosLocal as $partido) {
                $pj++;
                $pf += $partido->puntos_local;
                $pc += $partido->puntos_visitante;
                $partido->puntos_local > $partido->puntos_visitante ? $g++ : $p++;
            }

            foreach ($equipo->partidosVisitante as $partido) {
                $pj++;
                $pf += $partido->puntos_visitante;
                $pc += $partido->puntos_local;
                $partido->puntos_visitante > $partido->puntos_local ? $g++ : $p++;
            }

            return (object) [
                'equipo'      => $equipo,
                'pj'          => $pj,
                'g'           => $g,
                'p'           => $p,
                'pf'          => $pf,
                'pc'          => $pc,
                'dif'         => $pf - $pc,
                'pts'         => $g * 2 + $p,
                'promedio_pf' => $pj > 0 ? round($pf / $pj, 1) : 0,
            ];
        })->sort(function ($a, $b) {
            return [$b->pts, $b->dif, $b->pf] <=> [$a->pts, $a->dif, $a->pf];
        })->values();
    }
}