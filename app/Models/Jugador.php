<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    protected $table = 'jugadores';

    public const POSICIONES = ['Base', 'Escolta', 'Alero', 'Ala-pívot', 'Pívot'];

    protected $fillable = [
        'nombre', 'numero_camiseta', 'posicion', 'altura', 'fecha_nacimiento',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}