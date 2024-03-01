<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    protected $table = 'carreres';
    protected $fillable = [
        'nom',
        'descripció',
        'desnivell',
        'imatgeMapa',
        'maximParticipants',
        'habilitado',
        'km',
        'data',
        'hora',
        'puntSortida',
        'cartellPromoció',
        'preuAsseguradora',
        'preuPatrocini',
        'preuInscripció'
    ];

}
