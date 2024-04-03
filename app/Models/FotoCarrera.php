<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoCarrera extends Model
{
    use HasFactory;
    protected $table = 'foto_carreres';
    protected $fillable = [
        'idFoto',
        'idCarrera',
        'ruta',
    ];

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'idCarrera');
    }
}
