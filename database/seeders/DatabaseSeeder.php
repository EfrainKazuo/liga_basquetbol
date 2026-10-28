<?php

namespace Database\Seeders;

use App\Models\Equipo;
use App\Models\Partido;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario de prueba
        User::firstOrCreate(
            ['email' => 'admin@liga.test'],
            ['name' => 'Administrador', 'password' => Hash::make('password123')]
        );

        // Equipos
        $datos = [
            ['nombre' => 'Halcones',  'ciudad' => 'Lima',     'entrenador' => 'Carlos Mendoza'],
            ['nombre' => 'Tigres',    'ciudad' => 'Cusco',    'entrenador' => 'Roberto Quispe'],
            ['nombre' => 'Cóndores',  'ciudad' => 'Arequipa', 'entrenador' => 'Luis Paredes'],
            ['nombre' => 'Jaguares',  'ciudad' => 'Trujillo', 'entrenador' => 'Miguel Torres'],
        ];

        $equipos = collect($datos)->map(
            fn ($d) => Equipo::firstOrCreate(['nombre' => $d['nombre']], $d)
        );

        // Jugadores (5 por equipo)
        $nombres = [
            'Luis Ramos', 'Diego Torres', 'Andrés Vega', 'Marco Rojas', 'Julio Salas',
            'Pedro Flores', 'Iván Castro', 'Hugo Medina', 'Raúl Soto', 'Café Núñez',
            'Sergio León', 'Óscar Peña', 'Daniel Ríos', 'Felipe Cruz', 'Jorge Ortiz',
            'Mateo Ruiz', 'Bruno Silva', 'Nicolás Vera', 'Tomás Gil', 'Adrián Mora',
        ];
        $numeros   = [4, 7, 10, 23, 33];
        $posiciones = ['Base', 'Escolta', 'Alero', 'Ala-pívot', 'Pívot'];

        foreach ($equipos as $i => $equipo) {
            foreach (array_slice($nombres, $i * 5, 5) as $j => $nombre) {
                $equipo->jugadores()->firstOrCreate(
                    ['numero_camiseta' => $numeros[$j]],
                    [
                        'nombre'           => $nombre,
                        'posicion'         => $posiciones[$j],
                        'altura'           => 1.75 + $j * 0.06,
                        'fecha_nacimiento' => now()->subYears(20 + $j * 2)->toDateString(),
                    ]
                );
            }
        }

        // Partidos (solo si todavía no hay ninguno)
        if (Partido::count() === 0) {
            $finalizados = [
                [0, 1, 85, 78, 20],
                [2, 3, 92, 88, 18],
                [0, 2, 70, 75, 14],
                [1, 3, 81, 79, 12],
                [0, 3, 90, 84, 8],
                [1, 2, 77, 83, 5],
            ];

            foreach ($finalizados as [$local, $visitante, $pl, $pv, $dias]) {
                Partido::create([
                    'equipo_local_id'     => $equipos[$local]->id,
                    'equipo_visitante_id' => $equipos[$visitante]->id,
                    'fecha'               => now()->subDays($dias)->setTime(19, 0),
                    'puntos_local'        => $pl,
                    'puntos_visitante'    => $pv,
                    'estado'              => 'finalizado',
                ]);
            }

            $programados = [[0, 1, 3], [2, 3, 6]];

            foreach ($programados as [$local, $visitante, $dias]) {
                Partido::create([
                    'equipo_local_id'     => $equipos[$local]->id,
                    'equipo_visitante_id' => $equipos[$visitante]->id,
                    'fecha'               => now()->addDays($dias)->setTime(19, 0),
                    'estado'              => 'programado',
                ]);
            }
        }
    }
}