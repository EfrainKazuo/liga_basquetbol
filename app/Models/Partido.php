<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    public const ESTADOS = ['programado', 'finalizado'];

    protected $fillable = [
        'equipo_local_id',
        'equipo_visitante_id',
        'fecha',
        'puntos_local',
        'puntos_visitante',
        'estado',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function local()
    {
        return $this->belongsTo(Equipo::class, 'equipo_local_id');
    }

    public function visitante()
    {
        return $this->belongsTo(Equipo::class, 'equipo_visitante_id');
    }
}